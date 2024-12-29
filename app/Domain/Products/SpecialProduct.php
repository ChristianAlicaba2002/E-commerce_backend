<?php

namespace App\Domain\Products;

class SpecialProduct
{
    public function __construct(
        private ?string $product_id,
        private ?string $name,
        private ?float $price,
        private ?string $image,
        private ?string $description,
        private ?string $category,
        private ?string $branch_id,
        private ?string $branch_name,
        private ?string $created_at,
        private ?string $updated_at,
    ) {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->category = $category;
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
            'category' => $this->category,
            'branch_name' => $this->branch_name,
            'branch_id' => $this->branch_id,
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

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getBranch_name()
    {
        return $this->branch_name;
    }

    public function getBranch_id()
    {
        return $this->branch_id;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }
}
