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

    public function create(string $product_id, string $name, $price, string $image, string $description, string $category, string $created_at, string $updated_at)
    {

        $price = is_null($price) ? null : (float) $price;

        $data = new SpecialProduct($product_id, $name, $price, $image, $description, $category, $created_at, $updated_at);

        return $this->SpecialRepository->create($data);
    }

    public function update(string $product_id, string $name, $price, ?string $image, string $description, string $category, string $created_at, string $updated_at)
    {
        $price = is_null($price) ? null : (float) $price;
        $newdata = new SpecialProduct(
            $product_id,
            $name,
            $price,
            $image,
            $description,
            $category,
            $created_at,
            $updated_at
        );

        return $this->SpecialRepository->update($newdata);
    }

    public function findByProductID(string $product_id)
    {
        return $this->SpecialRepository->findByProductID($product_id);
    }

    public function findByID(string $product_id)
    {
        return $this->SpecialRepository->findByID($product_id);
    }

    // public function restore(string $product_id, string $name, $price, string $image, string $description, string $category, string $created_at, string $updated_at)
    // {

    //     // $price = is_null($price) ? null : (float) $price;
    //     $data = new SpecialProduct($product_id, $name, $price, $image, $description, $category, $created_at, $updated_at);

    //     return $this->SpecialRepository->restore($data);
    // }

    public function delete(string $product_id): void
    {
        $this->SpecialRepository->delete($product_id);
    }

    public function filterByCategory(string $category)
    {
        return $this->SpecialRepository->filterByCategory($category);
    }
}
