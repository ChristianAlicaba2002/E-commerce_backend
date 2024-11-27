<?php

namespace App\Domain\Products;

interface SpecialRepository
{
    public function create(SpecialProduct $specialProduct): void;

    public function update(SpecialProduct $specialProduct): void;

    public function delete(string $product_id): void;

    // public function restore(SpecialProduct $specialProduct): void;

    public function findByID(string $product_id): ?SpecialProduct;

    public function findAll(): array;

    public function findByProductID(string $product_id): ?SpecialProduct;

    public function searchProduct(string $search): array;

    public function filterByCategory(string $category): array;
}
