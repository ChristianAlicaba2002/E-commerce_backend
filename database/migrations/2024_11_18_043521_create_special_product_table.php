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
        Schema::create('special_product', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 15)->unique();
            $table->string('name')->unique();
            $table->float('price');
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->string('branch_id')->constrained();
            $table->string('branch_name')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_product');
    }
};
