<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use App\Domain\Products\Product;
use App\Domain\Products\ProductRepository;

class EloquentProductRepository implements ProductRepository
{
    public function create(Product $product): void
    {
        $productModel = ProductModel::find($product->getProduct_id()) ?? new ProductModel;
        $productModel->product_id = $product->getProduct_id();
        $productModel->name = $product->getName();
        $productModel->price = $product->getPrice();
        $productModel->description = $product->getDescription();
        $productModel->image = $product->getImage();
        $productModel->branch_id = $product->getBranch_id();
        $productModel->branch_name = $product->getBranch_name();
        $productModel->created_at = $product->getCreatedAt();
        $productModel->updated_at = $product->getUpdatedAt();
        $productModel->save();
    }

    public function update(Product $product): void
    {
        $productModel = ProductModel::find($product->getProduct_id()) ?? new ProductModel;
        $productModel->id = $product->getProduct_id();
        $productModel->name = $product->getName();
        $productModel->price = $product->getPrice();
        $productModel->description = $product->getDescription();
        $productModel->image = $product->getImage();
        $productModel->branch_id = $product->getBranch_id();
        $productModel->branch_name = $product->getBranch_name();
        $productModel->created_at = $product->getCreatedAt();
        $productModel->updated_at = $product->getUpdatedAt();
        $productModel->save();
    }

    public function delete(string $id): void
    {
        ProductModel::where('id', $id)->delete();
    }

    public function findByID(string $id): ?Product
    {
        $productModel = ProductModel::find($id);
        if (! $productModel) {
            return null;
        }

        return new Product(
            $productModel->id,
            $productModel->name,
            $productModel->price,
            $productModel->image,
            $productModel->description,
            $productModel->branch_id,
            $productModel->branch_name,
            $productModel->created_at,
            $productModel->updated_at);
    }

    public function findAll(): array
    {
        return ProductModel::all()->map(fn ($productModel) => new Product(
            product_id: $productModel->product_id,
            name: $productModel->name,
            price: $productModel->price,
            image: $productModel->image,
            description: $productModel->description,
            branch_id: $productModel->branch_id,
            branch_name: $productModel->branch_name,
            created_at: $productModel->created_at,
            updated_at: $productModel->updated_at,
        ))->toArray();
    }

    public function findByProductID(string $id): ?Product
    {
        $productModel = ProductModel::where('id', $id)->first();
        if (! $productModel) {
            return null;
        }

        return new Product(
            $productModel->product_id,
            $productModel->name,
            $productModel->price,
            $productModel->image,
            $productModel->description,
            $productModel->branch_id,
            $productModel->branch_name,
            $productModel->created_at,
            $productModel->updated_at);
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
                $match->product_id,
                $match->name,
                $match->price,
                $match->image,
                $match->description,
                $match->branch_id,
                $match->branch_name,
                $match->created_at,
                $match->updated_at,
            ) : null,
            'related' => $related->map(
                function ($product) {
                    return new Product(
                        $product->product_id,
                        $product->name,
                        $product->price,
                        $product->image,
                        $product->description,
                        $product->branch_id,
                        $product->branch_name,
                        $product->created_at,
                        $product->updated_at,
                    );
                }
            )->toArray(),
        ];
    }
}
