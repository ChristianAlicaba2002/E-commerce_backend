<?php

namespace App\Domain\Products;
use App\Domain\Products\SpecialProduct;

interface SpecialRepository
{
    public function create(SpecialProduct $specialProduct): void;
    public function update(SpecialProduct $specialProduct): void;
    public function delete(string $id): void;
    public function findByID(string $id): ?SpecialProduct;
    public function findAll(): array;
    public function findByProductID(string $id): ?SpecialProduct;
    public function searchProduct(string $search): array;
    public function filterByCategory(string $category): array;
}