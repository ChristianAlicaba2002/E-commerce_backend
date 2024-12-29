<?php

namespace App\Http\Controllers\Api;

use App\Application\Product\RegisterProducts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',

        ]);

        if ($validator->fails()) {
            return redirect('/DonMacAllProducts')->with('error', 'All fields are required');
        }

        if (DB::table('don_mac')->where('name', $request->name)->where('branch_id', Auth::guard('branches')->user()->branch_id)->exists()) {
            return redirect('/DonMacAllProducts')->with('error', 'Product name already exists');
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
            $request->branch_id,
            $request->branch_name,
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString()
        );

        // return response()->json(['data' => $Incommingcredentials], 200);
        return redirect('/DonMacAllProducts')->with('success', 'Product added successfully');

    }

    // Generate a uniqueProductId
    private function generateUniqueProductID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(6);
        } while ($this->registerProducts->findByProductID($id) !== null); // Fixed comparison operator position

        return $id;
    }

    //  Generate a randomnumericId.
    private function generateRandomAlphanumericID(int $length = 10): string
    {
        $result = substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length);

        return $result;
    }

    //Update the special product.
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
            'image' => 'nullable|image',
            'branch_id' => 'required|string',
            'branch_name' => 'required|string',

        ]);

        $data = [];

        if ($request->file(key: 'image')) {
            $image = $request->file(key: 'image');
            $destinationPath = 'images';

            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = $product->image ?? 'default.jpg';
            $imageName = $data['image'];
        }

        $price = floatval($request->price);
        $stock = floatval($request->stock);

        $this->registerProducts->update(
            $product->id,
            $request->name,
            $price,
            $request->description,
            $imageName,
            $request->branch_id,
            $request->branch_name,
            $product->created_at,
            Carbon::now()->toDateTimeString()
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
            'branch_id' => $product->branch_id,
            'branch_name' => $product->branch_name,
            'created_at' => $product->created_at,
            'updated_at' => Carbon::now()->toDateTimeLocalString(),
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
            'branch_id' => $products->branch_id,
            'branch_name' => $products->branch_name,
            'created_at' => $products->created_at,
            'updated_at' => Carbon::now()->toDateTimeLocalString(),
        ]);

        return redirect('/DeletedDonMacProducts')->with('success', 'Product restore successfully');
    }
}
