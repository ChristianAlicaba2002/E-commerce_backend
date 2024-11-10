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
    

    public function create(string $id ,string $name,  $price, string $image, string $created_at , string $updated_at)
    {

        $price = is_null($price) ? null : (float)$price;
        $data = new SpecialProduct($id, $name,  $price , $image, $created_at, $updated_at);
        return $this->SpecialRepository->create($data);
    }

    public function findByProductID(string $id)
    {
        return $this->SpecialRepository->findByProductID($id);
    }
}
