<?php

namespace  App\Domain\Products;

class Product
{
  

    public function __construct(
        private ?string $product_id,
        private ?string $name,
        private ?float $price,
        private ?string $image,
        private ?string $description,
        private ?string $created_at,
        private ?string $updated_at
                                
    ){
        
        $this->product_id = $product_id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    
    public function toArray()
    {
        return [
            'id' => $this->product_id,  
            'name' => $this->name,
            'price' => $this->price,
            'image'=> $this->image,
            'description' => $this->description,
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
    public function created_at()
    {
        return $this->created_at;
    }
    public function updated_at()
    {
        return $this->updated_at;
    }
 
        
    /** This function is setting the new value of the properties*/
    public function setProduct_id(string $product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
        return $this;
    }


    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function setUpdatedAt(string $updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

}
