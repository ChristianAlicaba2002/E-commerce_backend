<?php

namespace App\Infrastructure\Persistence\Eloquent\Product;

use App\Domain\Products\Product;
use App\Domain\Products\ProductRepository;

class EloquentSpecialProductRepository implements ProductRepository
{
    public function create(Product $product): void
    {
        $ProductModel = ProductModel::find($product->getProduct_id()) ?? new ProductModel;
        $ProductModel->product_id = $product->getProduct_id();
        $ProductModel->name = $product->getName();
        $ProductModel->price = $product->getPrice();
        $ProductModel->description = $product->getDescription();
        $ProductModel->category = $product->getCategory();
        $ProductModel->image = $product->getImage();
        $ProductModel->branch_id = $product->getBranch_id();
        $ProductModel->branch_name = $product->getBranch_name();
        $ProductModel->created_at = $product->getCreated_at();
        $ProductModel->updated_at = $product->getUpdated_at();
        $ProductModel->save();
    }

    public function update(Product $product): void
    {
        $ProductModel = ProductModel::find($product->getProduct_id()) ?? new ProductModel;
        $ProductModel->product_id = $product->getProduct_id();
        $ProductModel->name = $product->getName();
        $ProductModel->price = $product->getPrice();
        $ProductModel->description = $product->getDescription();
        $ProductModel->category = $product->getCategory();
        $ProductModel->image = $product->getImage();
        $ProductModel->branch_id = $product->getBranch_id();
        $ProductModel->branch_name = $product->getBranch_name();
        $ProductModel->created_at = $product->getCreated_at();
        $ProductModel->updated_at = $product->getUpdated_at();
        $ProductModel->save();
    }

    public function delete(string $product_id): void
    {
        ProductModel::where('product_id', $product_id)->delete();
    }

    public function findByID(string $product_id): ?Product
    {
        $SpecialProductModel = ProductModel::find($product_id);
        if (! $SpecialProductModel) {
            return null;
        }

        return new Product(
            product_id: $SpecialProductModel->product_id,
            name: $SpecialProductModel->name,
            price: $SpecialProductModel->price,
            description: $SpecialProductModel->description,
            category: $SpecialProductModel->category,
            image: $SpecialProductModel->image,
            branch_id: $SpecialProductModel->branch_id,
            branch_name: $SpecialProductModel->branch_name,
            created_at: $SpecialProductModel->created_at,
            updated_at: $SpecialProductModel->updated_at
        );
    }

    public function findAll(): array
    {
        return ProductModel::all()->map(fn($SpecialProductModel) => new Product(
            product_id: $SpecialProductModel->product_id,
            name: $SpecialProductModel->name,
            price: $SpecialProductModel->price,
            description: $SpecialProductModel->description,
            category: $SpecialProductModel->category,
            image: $SpecialProductModel->image,
            branch_id: $SpecialProductModel->branch_id,
            branch_name: $SpecialProductModel->branch_name,
            created_at: $SpecialProductModel->created_at,
            updated_at: $SpecialProductModel->updated_at,
        ))->toArray();
    }

    public function findByProductID(string $product_id): ?Product
    {
        $SpecialProductModel = ProductModel::where('product_id', $product_id)->first();
        if (! $SpecialProductModel) {
            return null;
        }

        return new Product(
            product_id: $SpecialProductModel->product_id,
            name: $SpecialProductModel->name,
            price: $SpecialProductModel->price,
            description: $SpecialProductModel->description,
            category: $SpecialProductModel->category,
            image: $SpecialProductModel->image,
            branch_name: $SpecialProductModel->branch_name,
            branch_id: $SpecialProductModel->branch_id,
            created_at: $SpecialProductModel->created_at,
            updated_at: $SpecialProductModel->updated_at
        );
    }

    public function searchProduct(string $search): array
    {
        // Cast price to string for comparison and ensure search term is treated as string
        $searchTerm = (string) $search;

        $match = ProductModel::where('product_id', $searchTerm)
            ->orWhere('name', $searchTerm)
            ->orWhere('price', $searchTerm) // Direct comparison instead of LIKE
            ->first();

        $related = ProductModel::where('product_id', '!=', $match?->product_id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('product_id', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('price', $searchTerm); // Direct comparison for price
            })
            ->get();

        return [
            'match' => $match ? new Product(
                product_id: $match->product_id,
                name: $match->name,
                price: $match->price,
                description: $match->description,
                category: $match->category,
                image: $match->image,
                branch_name: $match->branch_name,
                branch_id: $match->branch_id,
                created_at: $match->created_at,
                updated_at: $match->updated_at
            ) : null,
            'related' => $related->map(
                function ($product) {
                    return new Product(
                        product_id: $product->product_id,
                        name: $product->name,
                        price: $product->price,
                        description: $product->description,
                        category: $product->category,
                        image: $product->image,
                        branch_name: $product->branch_name,
                        branch_id: $product->branch_id,
                        created_at: $product->created_at,
                        updated_at: $product->updated_at
                    );
                }
            )->toArray(),
        ];
    }

    public function filterByCategory(string $category): array
    {
        return ProductModel::where('category', $category)
            ->get()
            ->map(fn($product) => new Product(
                product_id: $product->product_id,
                name: $product->name,
                price: $product->price,
                description: $product->description,
                category: $product->category,
                image: $product->image,
                branch_name: $product->branch_name,
                branch_id: $product->branch_id,
                created_at: $product->created_at,
                updated_at: $product->updated_at
            ))->toArray();
    }
}
