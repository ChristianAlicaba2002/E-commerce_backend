<?php

namespace App\Application\Product;

use App\Domain\Products\Product;
use App\Domain\Products\ProductRepository;
use App\Infrastructure\Persistence\Eloquent\Product\ProductModel;

class SpecialProducts
{
    private ProductRepository $ProductRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function findAll()
    {
        return $this->ProductRepository->findAll();
    }

    public function create(string $product_id, string $name, $price, string $image, string $description, string $category, string $branch_id, string $branch_name, string $created_at, string $updated_at)
    {

        $price = is_null($price) ? null : (float) $price;

        $data = new Product(
            $product_id,
            $name,
            $price,
            $image,
            $description,
            $category,
            $branch_id,
            $branch_name,
            $created_at,
            $updated_at
        );

        return $this->ProductRepository->create($data);
    }

    public function update(string $product_id, string $name, $price, ?string $image, string $description, string $category, string $branch_id, string $branch_name, string $created_at, string $updated_at)
    {
        $price = is_null($price) ? null : (float) $price;
        $newdata = new Product(
            $product_id,
            $name,
            $price,
            $image,
            $description,
            $category,
            $branch_id,
            $branch_name,
            $created_at,
            $updated_at
        );

        return $this->ProductRepository->update($newdata);
    }

    public function findByProductID(string $product_id)
    {
        return $this->ProductRepository->findByProductID($product_id);
    }

    public function findByID(string $product_id)
    {
        return $this->ProductRepository->findByID($product_id);
    }

    public function delete(string $product_id): void
    {
        $this->ProductRepository->delete($product_id);
    }

    public function filterByCategory(string $category)
    {
        return $this->ProductRepository->filterByCategory($category);
    }
}
