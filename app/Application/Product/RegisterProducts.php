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
    

    public function create(string $id ,string $name,  $price, string $image, string $created_at , string $updated_at)
    {

        $price = is_null($price) ? null : (float)$price;
        $data = new Product($id, $name,  $price , $image, $created_at, $updated_at);
        return $this->productRepository->create($data);
    }

    public function findByProductID(string $id)
    {
        return $this->productRepository->findByProductID($id);
    }
}
