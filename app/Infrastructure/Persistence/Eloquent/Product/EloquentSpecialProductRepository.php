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
        $productModel->image = $SpecialProduct->getImage();
        $productModel->created_at = $SpecialProduct->created_at();
        $productModel->updated_at = $SpecialProduct->updated_at();
        $productModel->save();
    }
    
    public function update(SpecialProduct $SpecialProduct): void
    {
        $productModel = SpecialProductModel::find($SpecialProduct->getId()) ?? new SpecialProductModel();
        $productModel->id = $SpecialProduct->getId();
        $productModel->name = $SpecialProduct->getName();
        $productModel->price = $SpecialProduct->getPrice();
        $productModel->image = $SpecialProduct->getImage();
        $productModel->created_at = $SpecialProduct->created_at();
        $productModel->updated_at = $SpecialProduct->updated_at();
        $productModel->save();
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
        return new SpecialProduct($productModel->id, $productModel->product_id, $productModel->name, $productModel->price, $productModel->created_at, $productModel->updated_at);
    }

    public function searchProduct(string $search): array
    {
        $match = SpecialProductModel::where('product_id', $search)->orWhere('name', $search)->orWhere('price')->first();

        $related = SpecialProductModel::where('id', '!=', $match?->id)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('product_id', 'LIKE', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")->get();

        return [
            'match' => $match ? new SpecialProduct(
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
                    return new SpecialProduct(
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
