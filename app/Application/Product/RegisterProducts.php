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
    

    public function create(string $id ,string $name,  $price, string $image, string $description, string $created_at , string $updated_at)
    {

        $price = is_null($price) ? null : (float)$price;

        $data = new Product($id, $name,  $price ,  $image, $description, $created_at, $updated_at);
        
        return $this->productRepository->create($data);
    }

    public function findByProductID(string $id)
    {
        return $this->productRepository->findByProductID($id);
    }

    public function update(string $id, string $name, $price, $description, string $image)
    {
        $price = is_null($price) ? null : (float)$price;
        
        $existingProduct = $this->productRepository->findByProductID($id);
        if (!$existingProduct) {
            throw new \Exception('Product not found');
        }
        
        $updatedProduct = new Product(
            $id,
            $name,
            $price,
            $description,
            $image,
            $existingProduct->created_at(),
            date('Y-m-d H:i:s')
        );
        
        return $this->productRepository->update($updatedProduct);
    }

    public function delete(string $id): void
    {
        $this->productRepository->delete($id);
    }

}
