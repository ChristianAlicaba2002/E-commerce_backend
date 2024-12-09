<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\User\UserOrderModel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserOrderController extends Controller
{
    //
    public function up(): void
    {
        Schema::table('user_order', function (Blueprint $table) {
            $table->string('status')->default('Recieved');
            $table->string('tracking_number')->unique();
        });
    }

    public function down(): void
    {
        Schema::table('user_order', function (Blueprint $table) {
            $table->dropColumn(['status', 'tracking_number']);
        });
    }

    public function store(Request $request)
    {
        $trackingNumber = 'TRK-'.strtoupper(uniqid());

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
            'status' => 'Recieved',
            'tracking_number' => $trackingNumber,
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'tracking_number' => $trackingNumber,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $order = UserOrderModel::where('tracking_number', $request->tracking_number)->first();

        if (! $order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function GetUserOrder()
    {
        $trackingNumber = DB::table('user_order')->get('tracking_number');

        return response()->json(compact('trackingNumber'));
    }

    public function GetUserOrderApi()
    {
        $orders = DB::table('user_order')->get();

        return response()->json(compact('orders'));
    }
}
