<?php

namespace App\Actions\Admin;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class ManageProduct
{
    /**
     * @param  array{name: string, description: string, price: mixed}  $attributes
     * @param  array{category_ids: array<int, int|string>, crop_ids: array<int, int|string>, packaging_ids: array<int, int|string>}  $relations
     */
    public function create(array $attributes, UploadedFile $image, array $relations): Product
    {
        $imagePath = $this->storeImage($image);

        try {
            return DB::transaction(function () use ($attributes, $imagePath, $relations): Product {
                $product = Product::query()->create([
                    ...$attributes,
                    'image_path' => $imagePath,
                ]);

                $this->syncRelations($product, $relations);

                return $product;
            });
        } catch (Throwable $exception) {
            $this->deleteImage($imagePath);

            throw $exception;
        }
    }

    /**
     * @param  array{name: string, description: string, price: mixed}  $attributes
     * @param  array{category_ids: array<int, int|string>, crop_ids: array<int, int|string>, packaging_ids: array<int, int|string>}  $relations
     */
    public function update(Product $product, array $attributes, array $relations, ?UploadedFile $image = null): Product
    {
        $newImagePath = $image instanceof UploadedFile ? $this->storeImage($image) : null;
        $previousImagePath = $product->image_path;

        try {
            $product = DB::transaction(function () use ($product, $attributes, $relations, $newImagePath): Product {
                $product->update([
                    ...$attributes,
                    ...($newImagePath !== null ? ['image_path' => $newImagePath] : []),
                ]);

                $this->syncRelations($product, $relations);

                return $product;
            });
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                $this->deleteImage($newImagePath);
            }

            throw $exception;
        }

        if ($newImagePath !== null) {
            $this->deleteImage($previousImagePath);
        }

        return $product;
    }

    public function delete(Product $product): void
    {
        $imagePath = $product->image_path;

        DB::transaction(function () use ($product): void {
            $product->delete();
        });

        $this->deleteImage($imagePath);
    }

    /**
     * @param  array{category_ids: array<int, int|string>, crop_ids: array<int, int|string>, packaging_ids: array<int, int|string>}  $relations
     */
    private function syncRelations(Product $product, array $relations): void
    {
        $product->categories()->sync($relations['category_ids']);
        $product->crops()->sync($relations['crop_ids']);
        $product->packagings()->sync($relations['packaging_ids']);
    }

    private function storeImage(UploadedFile $image): string
    {
        $path = $image->store('products');

        if ($path === false) {
            throw new RuntimeException('Unable to store the product image.');
        }

        return $path;
    }

    private function deleteImage(?string $path): void
    {
        if ($path === null || $path === '') {
            return;
        }

        Storage::delete($path);
    }
}
