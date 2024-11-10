<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Application\Product\SpecialProducts;
use App\Domain\Products\SpecialRepository;

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


    public function displaySpecialProduct()
    {
        $SpecialProducts = $this->SpecialProducts->findAll();

        $products = count($SpecialProducts);
        return view('components.SpecialProductPage', compact(' $products'));
    }




    public function addSpecialProducts(Request $request)
    {
        $Incommingcredentials = $request->all();
    
        $validator = Validator::make($Incommingcredentials, [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid Products.'], 422);
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
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString()
        );
        
        // return response()->json(['data' => $Incommingcredentials], 200);
        return redirect('/SpecialProductPage')->with('success', 'Product Added Successfully');
       
       
    }
    
    private function generateUniqueProductID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(15);
        } while ($this->SpecialProducts->findByProductID($id !== null));

        return $id;
    }

    private function generateRandomAlphanumericID(int $length = 15): string
    {   
        // $result = bin2hex( random_bytes( $length / 2));
        $result = substr( bin2hex( random_bytes($length  / 2)) , 0 , $length);       
        return $result ;

    }

    public function index()
    {
        $SpecialProducts = $this->SpecialProducts->findAll();
        return view('components.SpecialProductPage', compact('SpecialProducts'));
    }
    
}
