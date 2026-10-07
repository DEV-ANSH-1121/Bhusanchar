<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Fillable(['name', 'description', 'price', 'image_path'])]
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsToMany<Category, $this>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return BelongsToMany<Crop, $this>
     */
    public function crops(): BelongsToMany
    {
        return $this->belongsToMany(Crop::class);
    }

    /**
     * @return BelongsToMany<Packaging, $this>
     */
    public function packagings(): BelongsToMany
    {
        return $this->belongsToMany(Packaging::class);
    }

    /**
     * Stream the product image from the configured filesystem disk.
     */
    public function image(): StreamedResponse
    {
        abort_unless(Storage::exists($this->image_path), 404);

        return Storage::response($this->image_path);
    }
}
