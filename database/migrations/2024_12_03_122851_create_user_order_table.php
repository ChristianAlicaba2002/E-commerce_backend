<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_order', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('phoneNumber');
            $table->string('address');
            $table->string('message');
            $table->string('product_id');
            $table->string('name');
            $table->string('description');
            $table->string('quantity');
            $table->string('payment');
            $table->integer('total_price');
            $table->string('status');
            $table->string('tracking_number');
            $table->string('branch_id')->constrained();
            $table->string('branch_name')->constrained();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_order');
    }
};
