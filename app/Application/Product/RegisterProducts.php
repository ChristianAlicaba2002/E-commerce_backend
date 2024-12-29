<?php

namespace App\Application\Product;

use App\Domain\Products\Product;
use App\Domain\Products\ProductRepository;

class RegisterProducts
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findAll()
    {
        return $this->productRepository->findAll();
    }

    public function create(string $product_id, string $name, $price, string $image, string $description, string $branch_id, string $branch_name, string $created_at, string $updated_at)
    {

        $price = is_null($price) ? null : (float) $price;

        $data = new Product($product_id, $name, $price, $image, $description, $branch_id, $branch_name, $created_at, $updated_at);

        return $this->productRepository->create($data);
    }

    public function update(string $product_id, string $name, $price, $description, string $image, string $branch_id, string $branch_name, string $created_at, string $updated_at)
    {
        $price = is_null($price) ? null : (float) $price;

        $existingProduct = $this->productRepository->findByProductID($product_id);
        if (! $existingProduct) {
            throw new \Exception('Product not found');
        }

        $updatedProduct = new Product(
            $product_id,
            $name,
            $price,
            $image,
            $description,
            $branch_id,
            $branch_name,
            $created_at,
            $updated_at
        );

        return $this->productRepository->update($updatedProduct);
    }

    public function findByProductID(string $product_id)
    {
        return $this->productRepository->findByProductID($product_id);
    }

    public function delete(string $product_id): void
    {
        $this->productRepository->delete($product_id);
    }
}
