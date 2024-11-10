<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use App\Domain\Products\ProductRepository;
use App\Domain\Products\Product;

class EloquentProductRepository implements ProductRepository
{
    public function create(Product $product): void
    {
        $productModel = ProductModel::find($product->getId()) ?? new ProductModel();
        $productModel->id = $product->getId();
        $productModel->name = $product->getName();
        $productModel->price = $product->getPrice();
        $productModel->image = $product->getImage();
        $productModel->created_at = $product->created_at();
        $productModel->updated_at = $product->updated_at();
        $productModel->save();
    }
    
    public function update(Product $product): void
    {
        $productModel = ProductModel::find($product->getId()) ?? new ProductModel();
        $productModel->id = $product->getId();
        $productModel->name = $product->getName();
        $productModel->price = $product->getPrice();
        $productModel->image = $product->getImage();
        $productModel->created_at = $product->created_at();
        $productModel->updated_at = $product->updated_at();
        $productModel->save();
    }
    public function findByID(string $id): ?Product
    {
        $productModel = ProductModel::find($id);
        if (!$productModel) {
            return null;
        }
        return new Product($productModel->id, $productModel->name, $productModel->price, $productModel->image, $productModel->created_at, $productModel->updated_at);
    }
    public function findAll(): array
    {
        return ProductModel::all()->map(fn($productModel) => new Product(
            id: $productModel->id,
            name: $productModel->name,
            price: $productModel->price,
            image: $productModel->image,
            created_at: $productModel->created_at,
            updated_at: $productModel->updated_at,
        ))->toArray();
    }

    public function findByProductID(string $id): ?Product
    {
        $productModel = ProductModel::where('id', $id)->first();
        if (!$productModel) {
            return null;
        }
        return new Product($productModel->id, $productModel->product_id, $productModel->name, $productModel->price, $productModel->created_at, $productModel->updated_at);
    }

    public function searchProduct(string $search): array
    {
        $match = ProductModel::where('product_id', $search)->orWhere('name', $search)->orWhere('price')->first();

        $related = ProductModel::where('id', '!=', $match?->id)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('product_id', 'LIKE', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")->get();

        return [
            'match' => $match ? new Product(
                $match->id,
                $match->product_id,
                $match->name,
                $match->price,
                $match->image,
                $match->created_at,
                $match->updated_at,
            ) : null,
            'related' => $related->map(
                function ($product) {
                    return new Product(
                        $product->id,
                        $product->product_id,
                        $product->name,
                        $product->price,
                        $product->image,
                        $product->created_at,
                        $product->updated_at,
                    );
                }
            )->toArray()
        ];
    }
}
