<?php

namespace App\Application\Product;

use App\Domain\Products\SpecialProduct;
use App\Domain\Products\SpecialRepository;


class SpecialProducts
{
    private SpecialRepository $SpecialRepository;
    
    public function __construct(SpecialRepository $SpecialRepository)
    {
        $this->SpecialRepository = $SpecialRepository;
    }

    public function findAll()
    {
        return $this->SpecialRepository->findAll();
    }
    

    public function create(string $id ,string $name,  $price, string $image, string $description, string $category, string $created_at , string $updated_at)
    {

        $price = is_null($price) ? null : (float)$price;
        $data = new SpecialProduct($id, $name,  $price , $image, $description, $category, $created_at, $updated_at);
        return $this->SpecialRepository->create($data);
    }

    public function findByProductID(string $id)
    {
        return $this->SpecialRepository->findByProductID($id);
    }
    public function findByID(string $id)
    {
        return $this->SpecialRepository->findByProductID($id);
    }


    public function update( string $id , string $name,  $price, ?string $image, string $description, string $category, string $created_at, string $updated_at)
    {
        $price = is_null($price) ? null : (float)$price;
        $updated_at = date('Y-m-d H:i:s');
        $newdata = new SpecialProduct($id, $name, $price, $image, $description, $category, $created_at, $updated_at);
        return $this->SpecialRepository->update($newdata);
    }

    public function delete(string $id): void
    {
        $this->SpecialRepository->delete($id);
    }
    
    public function filterByCategory(string $category)
    {
        return $this->SpecialRepository->filterByCategory($category);
    }
}
