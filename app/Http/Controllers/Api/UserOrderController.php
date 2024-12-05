<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\Product\UserOrderModel;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    //
    public function store(Request $request)
    {
        UserOrderModel::create([
            'fullname' => $request->fullname,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'message' => $request->message,
            'product_id' => $request->product_id,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'payment' => $request->payment,
            'total_price' => $request->total_price,
        ]);

        return response()->json(['message' => 'Order created successfully']);
    }
}
