<?php

namespace App\Domain\Products;

class Product
{
    public function __construct(
        private ?string $product_id,
        private ?string $name,
        private ?float $price,
        private ?string $image,
        private ?string $description,
        private ?string $branch_id,
        private ?string $branch_name,
        private ?string $created_at,
        private ?string $updated_at

    ) {

        $this->product_id = $product_id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->branch_id = $branch_id;
        $this->branch_name = $branch_name;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function toArray()
    {
        return [
            'id' => $this->product_id,
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image,
            'description' => $this->description,
            'branch_id' => $this->branch_id,
            'branch_name' => $this->branch_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function getProduct_id()
    {
        return $this->product_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getBranch_id()
    {
        return $this->branch_id;
    }

    public function getBranch_name()
    {
        return $this->branch_name;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
