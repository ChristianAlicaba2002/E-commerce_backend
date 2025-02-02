<?php

namespace App\Http\Controllers\Api;

use App\Application\Product\SpecialProducts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SpecialProductController extends Controller
{
    private SpecialProducts $SpecialProducts;

    public function __construct(SpecialProducts $SpecialProducts)
    {
        $this->SpecialProducts = $SpecialProducts;
    }

    /**
     * Get all products.
     * **/
    public function getAllSpecialProduct()
    {
        $products = DB::table('products')->get();

        return response()->json(compact('products'), 200);
    }

    /**
     * Add a special product.
     * **/
    public function addSpecialProducts(Request $request)
    {
        $Incommingcredentials = $request->all();

        $validator = Validator::make($Incommingcredentials, [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image',
            'branch_id' => 'required|string',
            'branch_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('/AllSpecialProducts')->with('error', 'All fields are required');
        }

        if (DB::table('products')->where('name', $request->name)->exists()) {
            return redirect('/AllSpecialProducts')->with('error', 'Product name already exists');
        }

        $product_id = $this->generateUniqueProductID();

        $data = [];

        if ($request->file(key: 'image')) {
            $image = $request->file(key: 'image');
            $destinationPath = 'images';

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'default.jpg';
        }

        $price = floatval($request->price);

        $this->SpecialProducts->create(
            $product_id,
            $request->name,
            $price,
            $data['image'],
            $request->description,
            $request->category,
            $request->branch_id,
            $request->branch_name,
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString()
        );

        return redirect('/AllSpecialProducts')->with('success', 'Product Added Successfully');
    }

    public function filterByCategory($category)
    {
        try {
            $products = $this->SpecialProducts->filterByCategory($category);

            return response()->json([
                'success' => true,
                'products' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products',
            ], 500);
        }
    }

    public function getCategoryCounts()
    {
        try {
            $counts = [
                'Pizza' => count($this->SpecialProducts->filterByCategory('Pizza')),
                'Drinks' => count($this->SpecialProducts->filterByCategory('Drinks')),
                'Dessert' => count($this->SpecialProducts->filterByCategory('Dessert')),
                'Combo' => count($this->SpecialProducts->filterByCategory('Combo')),
            ];

            return response()->json([
                'success' => true,
                'counts' => $counts,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch category counts',
            ], 500);
        }
    }

    // Generate a uniqueProductId
    private function generateUniqueProductID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(6);
            // Check if the generated ID already exists
            $exists = $this->SpecialProducts->findByID($id);
        } while ($exists !== null); // Ensure the ID is unique

        return $id;
    }

    //  Generate a randomnumericId.
    private function generateRandomAlphanumericID(int $length = 10): string
    {
        $result = substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length);

        return $result;
    }

    public function time()
    {
        return Carbon::now()->toDateTimeString();
    }

    public function updateSpecialProduct(Request $request, $product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        if (! $product) {
            return redirect('/AllSpecialProducts')->with('error', 'product not found');
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

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName; // Store the image name in the data array
        } else {
            $data['image'] = $product->image ?? 'default.jpg';
            $imageName = $data['image']; // Ensure $imageName is defined
        }

        $price = floatval($request->price);

        $this->SpecialProducts->update(
            $product->id,
            $request->name,
            $price,
            $imageName,
            $request->description,
            $product->category,
            $product->branch_id,
            $product->branch_name,
            $product->created_at,
            Carbon::now()->toDateTimeString() // Changed to toDateTimeString() for consistency
        );

        return redirect('/AllSpecialProducts')->with('success', 'Product updated successfully');
    }

    public function archiveEachProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (! $product) {
            return redirect('/AllSpecialProducts')->with('error', 'Product not found');
        }

        DB::table('products')->where('id', $id)->delete();

        DB::table('deleted_products')->insert([
            'product_id' => $product->product_id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'category' => $product->category,
            'image' => $product->image,
            'branch_id' => $product->branch_id,
            'branch_name' => $product->branch_name,
            'created_at' => $product->created_at,
            'updated_at' => Carbon::now()->toDateTimeLocalString(), // Ensure only month, day, and year are included // Updated to include only month, day, and year
        ]);

        return redirect('/AllSpecialProducts')->with('success', 'Product archive successfully');
    }

    public function RestoringSpecialProduct($id)
    {
        $product = DB::table('deleted_products')->where('id', $id)->first();

        if (! $product) {
            return redirect('/DeletedSpecialProducts')->with('error', 'Product not found');
        }

        DB::table('deleted_products')->where('id', $id)->delete();

        DB::table('products')->insert([
            'product_id' => $product->product_id, // Use the correct property
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'category' => $product->category,
            'image' => $product->image,
            'branch_id' => $product->branch_id,
            'branch_name' => $product->branch_name,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ]);

        return redirect('/DeletedSpecialProducts')->with('success', 'Product restore successfully');
    }

    public function deletedEachProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (! $product) {
            return redirect('/AllSpecialProducts')->with('error', 'Product not found');
        }

        DB::table('products')->where('id', $id)->delete();

        return redirect('/AllSpecialProducts')->with('success', 'Product deleted successfully');
    }
}
