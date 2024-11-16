<?php

namespace App\Domain\Products;

use App\Domain\Products\Product;

interface ProductRepository
{
    public function create(Product $product): void;
    public function update(Product $product): void;
    public function delete(string $id): void;   
    public function findByID(string $id): ?Product;
    public function findByProductID(string $id): ?Product;
    public function findAll(): array;
    public function searchProduct(string $search):array;
}
