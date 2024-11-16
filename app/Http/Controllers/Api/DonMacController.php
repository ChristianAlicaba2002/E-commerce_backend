<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\Product\ProductModel;
use Illuminate\Http\Request;
use App\Application\Product\RegisterProducts;
use App\Domain\Products\ProductRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
             fn($DonMacProducts) => $DonMacProducts->toArray(),
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
            }
        ],
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

      
 
         if ($validator->fails()) {
             return redirect('/DonMacPage')->with('error', 'Error adding product: ' . $validator->errors());
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

        $this->registerProducts->create(
            $id,
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

    public function deleteEachProduct($id)
    {
        DB::table('don_mac')->where('id', $id)->delete();
        return redirect('/DonMacAllProducts')->with('success', 'Product deleted successfully');
    }

     /**
     * Update the special product.
     * **/
    public function updateDonMacProduct(Request $request, $id)
    {
        
    }
    
    
}
