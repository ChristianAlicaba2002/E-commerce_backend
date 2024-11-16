<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Application\Product\SpecialProducts;
use Illuminate\Support\Facades\DB;
use App\Models\SpecialProduct;

use function Laravel\Prompts\error;

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
        $SpecialProducts = $this->SpecialProducts->findAll();

        $products = array_map(
            fn($SpecialProducts) => $SpecialProducts->toArray(),
            $SpecialProducts
        );
        return response()->json(compact('products'), 200);
    }
    
    /**
     * Add a special product.
     * **/


    public function addSpecialProducts(Request $request)
    {
        $Incommingcredentials = $request->all();
    
        $validator = Validator::make($Incommingcredentials, [
            'name' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Check if product with same name exists
                    $exists = DB::table('special_product')->where('name', $value)->exists();
                    if ($exists) {
                        $fail('This product name is  already exists.');
                    }
                }
            ],
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|in:Pizza,Drink,Dessert',
            'image' => 'nullable|image',
        ]);
    
       
        if ($validator->fails()) {
            return redirect('/SpecialProductPage')->with('error', 'Error adding product: ' . $validator->errors());
        }


    
        $id = $this->generateUniqueProductID();
    
        $data = [];
    
        if($request->file(key:'image')){
            $image = $request->file(key:'image');
            $destinationPath = 'images';

            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'default.jpg';
        }

        $price = floatval($request->price);

        $this->SpecialProducts->create(
            $id,
            $request->name,
            $price,
            $data['image'],
            $request->description,
            $request->category,
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString()
        );
        return redirect('/SpecialProductPage')->with('success', 'Product Added Successfully');
    }
    
    public function filterByCategory($category)
    {
        try {
            $products = $this->SpecialProducts->filterByCategory($category);
            return response()->json([
                'success' => true,
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products'
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
            ];

            return response()->json([
                'success' => true,
                'counts' => $counts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch category counts'
            ], 500);
        }
    }







    /**
     * Generate a uniqueProductId.
     * **/
    private function generateUniqueProductID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(6);
        } while ($this->SpecialProducts->findByProductID($id) !== null);
    
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

    public function time(){
        return Carbon::now()->toDateTimeString();
    }

    /**
     * Update a special product.
     * **/
    public function updateSpecialProduct(Request $request, $id)
    {
        $product = $this->SpecialProducts->findByID($id);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        try {
            $request->validate([
                'name' => 'required|string',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'image' => 'nullable|image'
            ]);
    
            $product->setName(trim(strip_tags($request->name)));
            $product->setPrice(number_format((float)$request->price, 2, '.', ''));
            $product->setDescription(trim(strip_tags($request->description)));
    
            if ($request->hasFile('image')) {
                if ($product->getImage() && $product->getImage() !== 'default.jpg' && 
                    file_exists(public_path('images/' . $product->getImage()))) {
                    unlink(public_path('images/' . $product->getImage()));
                }
                
                // Storing new image
                $image = $request->file('image');
                $imageName = 'special_product_' . time() . '_' . $id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $product->setImage($imageName);
            }

            $product->setCreated_at(now());
            $product->setUpdated_at(now());
  
            $this->SpecialProducts->update($id, $product->getName(), $product->getPrice(), $product->getImage(), $product->getDescription(), $product->getCategory(), $product->getCreated_at(), $product->getUpdated_at());
            return redirect('/AllSpecialProducts')->with('success', 'Product Updated Successfully');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

     
    // public function updateSpecialProduct(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'string',
    //         'price' => 'numeric',
    //         'description' => 'string',
    //         'image' => 'nullable|image',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Invalid Products.',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }
    
    //     // $product = $this->SpecialProducts->findByProductID($id);
    //     $product = $this->SpecialProducts->findByID($id);

    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], 404);
    //     }
        
    //     $imageToUpdate = $product->getImage($id);

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $destinationPath = 'images';
            
    //         $imageName = 'special_product_' . time() . '_' . $id . '.' . $image->getClientOriginalExtension();
            
    //         $image->move($destinationPath, $imageName);
            
    //         if ($imageToUpdate && $imageToUpdate !== 'default.jpg') {
    //             $oldImagePath = public_path($destinationPath . '/' . $imageToUpdate);
    //             if (file_exists($oldImagePath)) {
    //                 unlink($oldImagePath);
    //             }
    //         }
            
    //         $imageToUpdate = $imageName;
    //     }

    //     $price = floatval($request->price);
        
    //     $this->SpecialProducts->update(
    //         $id,
    //         $request->name,
    //         $price,
    //         $imageToUpdate,
    //         $request->description,
    //         Carbon::now()->toDateTimeString(),
    //         Carbon::now()->toDateTimeString()
    //     );


    //     return redirect('/AllSpecialProducts')->with('success', 'Product Updated Successfully');
    // }
    

    public function deleteEachProduct($id)
    {
        DB::table('special_product')->where('id', $id)->delete();
        return redirect('/AllSpecialProducts')->with('success', 'Product deleted successfully');
    }
    
}
