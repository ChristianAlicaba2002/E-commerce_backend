<?php

namespace App\Domain\Products;

interface ProductRepository
{
    public function create(Product $product): void;

    public function update(Product $product): void;

    public function delete(string $product_id): void;

    public function findByID(string $product_id): ?Product;

    public function findAll(): array;

    public function findByProductID(string $product_id): ?Product;

    // public function searchProduct(string $search): array;

    public function filterByCategory(string $category): array;
}
