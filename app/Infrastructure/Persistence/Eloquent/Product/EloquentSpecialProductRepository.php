<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use App\Domain\Products\SpecialProduct;
use App\Domain\Products\SpecialRepository;

class EloquentSpecialProductRepository implements SpecialRepository
{
    public function create(SpecialProduct $SpecialProduct): void
    {
        $SpecialProductModel = SpecialProductModel::find($SpecialProduct->getProduct_id()) ?? new SpecialProductModel;
        $SpecialProductModel->product_id = $SpecialProduct->getProduct_id();
        $SpecialProductModel->name = $SpecialProduct->getName();
        $SpecialProductModel->price = $SpecialProduct->getPrice();
        $SpecialProductModel->description = $SpecialProduct->getDescription();
        $SpecialProductModel->category = $SpecialProduct->getCategory();
        $SpecialProductModel->image = $SpecialProduct->getImage();
        $SpecialProductModel->created_at = $SpecialProduct->getCreated_at();
        $SpecialProductModel->updated_at = $SpecialProduct->getUpdated_at();
        $SpecialProductModel->save();
    }

    // public function restore(SpecialProduct $SpecialProduct): void
    // {
    //     $DeletedDonmacItemsModel = DeletedDonmacItemsModel::find($SpecialProduct->getProduct_id()) ?? new DeletedDonmacItemsModel;
    //     $DeletedDonmacItemsModel->product_id = $SpecialProduct->getProduct_id();
    //     $DeletedDonmacItemsModel->name = $SpecialProduct->getName();
    //     $DeletedDonmacItemsModel->price = $SpecialProduct->getPrice();
    //     $DeletedDonmacItemsModel->description = $SpecialProduct->getDescription();
    //     $DeletedDonmacItemsModel->category = $SpecialProduct->getCategory();
    //     $DeletedDonmacItemsModel->image = $SpecialProduct->getImage();
    //     $DeletedDonmacItemsModel->created_at = $SpecialProduct->getCreated_at();
    //     $DeletedDonmacItemsModel->updated_at = $SpecialProduct->getUpdated_at();
    //     $DeletedDonmacItemsModel->save();
    // }

    public function update(SpecialProduct $SpecialProduct): void
    {
        $SpecialProductModel = SpecialProductModel::find($SpecialProduct->getProduct_id()) ?? new SpecialProductModel;
        // $SpecialProductModel->product_id = $SpecialProduct->getProduct_id();
        $SpecialProductModel->name = $SpecialProduct->getName();
        $SpecialProductModel->price = $SpecialProduct->getPrice();
        $SpecialProductModel->description = $SpecialProduct->getDescription();
        $SpecialProductModel->category = $SpecialProduct->getCategory();
        $SpecialProductModel->image = $SpecialProduct->getImage();
        $SpecialProductModel->created_at = $SpecialProduct->getCreated_at();
        $SpecialProductModel->updated_at = $SpecialProduct->getUpdated_at();
        $SpecialProductModel->save();
    }

    public function delete(string $product_id): void
    {
        SpecialProductModel::where('product_id', $product_id)->delete();
    }

    public function findByID(string $product_id): ?SpecialProduct
    {
        $SpecialProductModel = SpecialProductModel::find($product_id);
        if (! $SpecialProductModel) {
            return null;
        }

        return new SpecialProduct(
            product_id: $SpecialProductModel->product_id,
            name: $SpecialProductModel->name,
            price: $SpecialProductModel->price,
            description: $SpecialProductModel->description,
            category: $SpecialProductModel->category,
            image: $SpecialProductModel->image,
            created_at: $SpecialProductModel->created_at,
            updated_at: $SpecialProductModel->updated_at
        );
    }

    public function findAll(): array
    {
        return SpecialProductModel::all()->map(fn ($SpecialProductModel) => new SpecialProduct(
            product_id: $SpecialProductModel->product_id,
            name: $SpecialProductModel->name,
            price: $SpecialProductModel->price,
            description: $SpecialProductModel->description,
            category: $SpecialProductModel->category,
            image: $SpecialProductModel->image,
            created_at: $SpecialProductModel->created_at,
            updated_at: $SpecialProductModel->updated_at,
        ))->toArray();
    }

    public function findByProductID(string $product_id): ?SpecialProduct
    {
        $SpecialProductModel = SpecialProductModel::where('product_id', $product_id)->first();
        if (! $SpecialProductModel) {
            return null;
        }

        return new SpecialProduct(
            product_id: $SpecialProductModel->product_id,
            name: $SpecialProductModel->name,
            price: $SpecialProductModel->price,
            description: $SpecialProductModel->description,
            category: $SpecialProductModel->category,
            image: $SpecialProductModel->image,
            created_at: $SpecialProductModel->created_at,
            updated_at: $SpecialProductModel->updated_at
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

        $related = SpecialProductModel::where('product_id', '!=', $match?->product_id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('product_id', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('price', $searchTerm); // Direct comparison for price
            })
            ->get();

        return [
            'match' => $match ? new SpecialProduct(
                product_id: $match->product_id,
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
                        product_id: $product->product_id,
                        name: $product->name,
                        price: $product->price,
                        description: $product->description,
                        category: $product->category,
                        image: $product->image,
                        created_at: $product->created_at,
                        updated_at: $product->updated_at
                    );
                }
            )->toArray(),
        ];
    }

    public function filterByCategory(string $category): array
    {
        return SpecialProductModel::where('category', $category)
            ->get()
            ->map(fn ($product) => new SpecialProduct(
                product_id: $product->product_id,
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
