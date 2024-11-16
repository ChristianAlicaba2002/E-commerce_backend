<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;


use App\Domain\Products\SpecialProduct;
use App\Domain\Products\SpecialRepository; 
use App\Infrastructure\Persistence\Eloquent\Product\SpecialProductModel;
class EloquentSpecialProductRepository implements SpecialRepository
{
    public function create(SpecialProduct $SpecialProduct): void
    {
        $productModel = SpecialProductModel::find($SpecialProduct->getId()) ?? new SpecialProductModel();
        $productModel->id = $SpecialProduct->getId();
        $productModel->name = $SpecialProduct->getName();
        $productModel->price = $SpecialProduct->getPrice();
        $productModel->description = $SpecialProduct->getDescription();
        $productModel->category = $SpecialProduct->getCategory();
        $productModel->image = $SpecialProduct->getImage();
        $productModel->created_at = $SpecialProduct->getCreated_at();
        $productModel->updated_at = $SpecialProduct->getUpdated_at();
        $productModel->save();
    }
    
    public function update(SpecialProduct $SpecialProduct): void
    {
        $productModel = SpecialProductModel::find($SpecialProduct->getId()) ?? new SpecialProductModel();
        $productModel->id = $SpecialProduct->getId();
        $productModel->name = $SpecialProduct->getName();
        $productModel->price = $SpecialProduct->getPrice();
        $productModel->description = $SpecialProduct->getDescription();
        $productModel->category = $SpecialProduct->getCategory();
        $productModel->image = $SpecialProduct->getImage();
        $productModel->created_at = $SpecialProduct->getCreated_at();
        $productModel->updated_at = $SpecialProduct->getUpdated_at();
        $productModel->save();
    }

    public function delete(string $id): void
    {
        SpecialProductModel::where('id', $id)->delete();
    }
    

    public function findByID(string $id): ?SpecialProduct
    {
        $productModel = SpecialProductModel::find($id);
        if (!$productModel) {
            return null;
        }
        return new SpecialProductModel($productModel->id, $productModel->name, $productModel->price, $productModel->image, $productModel->created_at, $productModel->updated_at);
    }

    public function findAll(): array
    {
        return SpecialProductModel::all()->map(fn($productModel) => new SpecialProduct(
            id: $productModel->id,
            name: $productModel->name,
            price: $productModel->price,
            description: $productModel->description,
            category: $productModel->category,
            image: $productModel->image,
            created_at: $productModel->created_at,
            updated_at: $productModel->updated_at,
        ))->toArray();
    }

    public function findByProductID(string $id): ?SpecialProduct
    {
        $productModel = SpecialProductModel::where('id', $id)->first();
        if (!$productModel) {
            return null;
        }
        return new SpecialProduct(
            id: $productModel->id,
            name: $productModel->name,
            price: $productModel->price,
            description: $productModel->description,
            category: $productModel->category,
            image: $productModel->image,
            created_at: $productModel->created_at,
            updated_at: $productModel->updated_at
        );
    }

    public function searchProduct(string $search): array 
    {
        // Cast price to string for comparison and ensure search term is treated as string
        $searchTerm = (string) $search;
        
        $match = SpecialProductModel::where('product_id', $searchTerm)
            ->orWhere('name', $searchTerm)
            ->orWhere('price', $searchTerm) // Direct comparison instead of LIKE
            ->first();

        $related = SpecialProductModel::where('id', '!=', $match?->id)
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('product_id', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('price', $searchTerm); // Direct comparison for price
            })
            ->get();

        return [
            'match' => $match ? new SpecialProduct(
                id: $match->id,
                name: $match->name,
                price: $match->price,
                description: $match->description,
                category: $match->category,
                image: $match->image,
                created_at: $match->created_at,
                updated_at: $match->updated_at
            ) : null,
            'related' => $related->map(
                function ($product) {
                    return new SpecialProduct(
                        id: $product->id,
                        name: $product->name,
                        price: $product->price,
                        description: $product->description,
                        category: $product->category,
                        image: $product->image,
                        created_at: $product->created_at,
                        updated_at: $product->updated_at
                    );
                }
            )->toArray()
        ];
        }

        public function filterByCategory(string $category): array
        {
        return SpecialProductModel::where('category', $category)
            ->get()
            ->map(fn($product) => new SpecialProduct(
                id: $product->id,
                name: $product->name,
                price: $product->price,
                description: $product->description,
                category: $product->category,
                image: $product->image,
                created_at: $product->created_at,
                updated_at: $product->updated_at
            ))->toArray();
        }

}
