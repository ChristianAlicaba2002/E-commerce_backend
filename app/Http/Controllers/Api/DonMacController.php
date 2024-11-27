<?php

namespace App\Http\Controllers\Api;

use App\Application\Product\RegisterProducts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DonMacController extends Controller
{
    private RegisterProducts $registerProducts;

    public function __construct(RegisterProducts $registerProducts)
    {
        $this->registerProducts = $registerProducts;
    }

    /**
     * Get all products.
     * **/
    public function getAllDonMacProduct()
    {
        $DonMacProducts = $this->registerProducts->findAll();

        $products = array_map(
            fn ($DonMacProducts) => $DonMacProducts->toArray(),
            $DonMacProducts
        );

        return response()->json(compact('products'), 200);
    }

    public function addDonMacProducts(Request $request)
    {
        $Incommingcredentials = $request->all();

        $validator = Validator::make($Incommingcredentials, [
            'name' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Check if product with same name exists
                    $exists = DB::table('don_mac')->where('name', $value)->exists();
                    if ($exists) {
                        $fail('This product name is  already exists.');
                    }
                },
            ],
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect('/DonMacPage')->with('error', 'Error adding product: '.$validator->errors());
        }

        $product_id = $this->generateUniqueProductID();

        $data = [];

        if ($request->file(key: 'image')) {
            $image = $request->file(key: 'image');
            $destinationPath = 'images';

            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'default.jpg';
        }
        $price = floatval($request->price);

        $this->registerProducts->create(
            $product_id,
            $request->name,
            $price,
            $data['image'],
            $request->description,
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString()
        );

        // return response()->json(['data' => $Incommingcredentials], 200);
        return redirect('/DonMacPage')->with('success', 'Product added successfully');

    }

    /**
     * Generate a uniqueProductId.
     * **/
    private function generateUniqueProductID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(6);
        } while ($this->registerProducts->findByProductID($id) !== null); // Fixed comparison operator position

        return $id;
    }

    /**
     * Generate a randomnumericId.
     * **/
    private function generateRandomAlphanumericID(int $length = 10): string
    {
        $result = substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length);

        return $result;
    }

    /**
     * Update the special product.
     * **/
    public function updateDonMacchiatosProduct(Request $request, $product_id)
    {
        $product = DB::table('don_mac')->where('id', $product_id)->first();
        if (! $product) {
            return redirect('/DonMacAllProducts')->with('error', 'product not found');
        }

        Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|nullable',
        ]);

        $data = [];

        if ($request->file(key: 'image')) {
            $image = $request->file(key: 'image');
            $destinationPath = 'images';

            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName; // Store the image name in the data array
        } else {
            $data['image'] = $product->image ?? 'default.jpg';
            $imageName = $data['image']; // Ensure $imageName is defined
        }

        $price = floatval($request->price);

        $this->registerProducts->update(
            $product->id,
            $request->name,
            $price,
            $request->description,
            $imageName,
            $product->created_at,
            Carbon::now()->toDateTimeString() // Changed to toDateTimeString() for consistency
        );

        return redirect('/DonMacAllProducts')->with('success', 'Product updated successfully');
    }

    public function deleteEachDonmacProduct($id)
    {
        $product = DB::table('don_mac')->where('id', $id)->first();
        if (! $product) {
            return redirect('/DonMacAllProducts')->with('error', 'Product not found');
        }

        DB::table('don_mac')->where('id', $id)->delete();

        DB::table('deleted_donmac')->insert([
            'product_id' => $product->product_id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'image' => $product->image,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ]);

        return redirect('/DonMacAllProducts')->with('success', 'Product deleted successfully');
    }

    public function restoringDonmacData($id)
    {
        $products = DB::table('deleted_donmac')->where('id', $id)->first();

        if (! $products) {
            return redirect('/DeletedDonMacProducts')->with('error', 'Product not found');
        }

        DB::table('deleted_donmac')->where('id', $id)->delete();

        DB::table('don_mac')->insert([
            'product_id' => $products->product_id,
            'name' => $products->name,
            'price' => $products->price,
            'description' => $products->description,
            'image' => $products->image,
            'created_at' => $products->created_at,
            'updated_at' => $products->updated_at,
        ]);

        return redirect('/DeletedDonMacProducts')->with('success', 'Product restore successfully');
    }
}
