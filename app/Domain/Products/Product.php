<?php

namespace  App\Domain\Products;

class Product
{
  

    public function __construct(  
        private ?string $id,
        private ?string $name,
        private ?float $price,
        private ?string $image,
        private ?string $created_at,
        private ?string $updated_at
                                
    ){
        
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    
    public function toArray()
    {
        return [
            // 'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'image'=> $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    public function getId()
    {
        return $this->id;
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
    public function created_at()
    {
        return $this->created_at;
    }
    public function updated_at()
    {
        return $this->updated_at;
    }
}
