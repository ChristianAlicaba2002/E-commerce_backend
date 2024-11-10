<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\Product\ProductModel;
use Illuminate\Http\Request;
use App\Application\Product\RegisterProducts;
use App\Domain\Products\ProductRepository;
use Illuminate\Support\Carbon;
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
        $productModel = $this->registerProducts->findAll();

        $products = array_map(
            fn($productModel) => $productModel->toArray(),
            $productModel
        );
        return response()->json(compact('products'), 200);
    }


    public function addDonMacProducts(Request $request)
    {
        $Incommingcredentials = $request->all();
    
        $validator = Validator::make($Incommingcredentials, [
            'name' => 'required|string',
            'price' => 'required|numeric',
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
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString()
        );
        
        // return response()->json(['data' => $Incommingcredentials], 200);
        return redirect('/DonMacPage')->with('success', 'Product added successfully');
 
    }
    
    private function generateUniqueProductID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(15);
        } while ($this->registerProducts->findByProductID($id !== null));

        return $id;
    }

    private function generateRandomAlphanumericID(int $length = 15): string
    {   
        // $result = bin2hex( random_bytes( $length / 2));
        $result = substr( bin2hex( random_bytes($length  / 2)) , 0 , $length);       
        return $result ;

    }
    
}
