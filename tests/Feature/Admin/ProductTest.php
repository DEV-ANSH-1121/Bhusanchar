<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\Crop;
use App\Models\Packaging;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

/**
 * @return array{admin: Admin, category: Category, crop: Crop, packaging: Packaging}
 */
function productFormRecords(): array
{
    return [
        'admin' => Admin::factory()->create(),
        'category' => Category::factory()->create(['name' => 'Fertilizers']),
        'crop' => Crop::factory()->create(['name' => 'Wheat']),
        'packaging' => Packaging::factory()->create(['name' => '25 kg']),
    ];
}

it('redirects guests away from product endpoints', function (string $method, string $uri) {
    $this->{$method}($uri)->assertRedirect(route('admin.login'));
})->with([
    'index' => ['get', '/app/cp/products'],
    'create' => ['get', '/app/cp/products/create'],
    'store' => ['post', '/app/cp/products'],
]);

it('redirects guests away from product record endpoints', function (string $method, string $uri) {
    $product = Product::factory()->create();

    $this->{$method}(str_replace('{product}', (string) $product->id, $uri))
        ->assertRedirect(route('admin.login'));
})->with([
    'edit' => ['get', '/app/cp/products/{product}/edit'],
    'update' => ['put', '/app/cp/products/{product}'],
    'destroy' => ['delete', '/app/cp/products/{product}'],
    'image' => ['get', '/app/cp/products/{product}/image'],
]);

it('renders the product form with compact catalog selectors', function () {
    ['admin' => $admin, 'category' => $category] = productFormRecords();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.products.create'))
        ->assertSee('Select categories', false)
        ->assertSee('Select all', false)
        ->assertSee('Clear selection', false)
        ->assertSee($category->name, false)
        ->assertSee(route('admin.categories.index'), false)
        ->assertSee(route('admin.crops.index'), false)
        ->assertSee(route('admin.packagings.index'), false);
});

it('lists products for an authenticated admin', function () {
    $admin = Admin::factory()->create();
    $product = Product::factory()->create([
        'name' => 'Balanced NPK Fertilizer',
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.products.index'))
        ->assertSee('Balanced NPK Fertilizer', false)
        ->assertSee(route('admin.products.create'), false);

    $this->assertModelExists($product);
});

it('escapes product names on the listing page', function () {
    $admin = Admin::factory()->create();
    Product::factory()->create([
        'name' => "<script>alert('xss')</script>",
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.products.index'))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false);
});

it('creates a product with an image and catalog relationships', function () {
    Storage::fake();

    ['admin' => $admin, 'category' => $category, 'crop' => $crop, 'packaging' => $packaging] = productFormRecords();
    $image = UploadedFile::fake()->image('npk.jpg');

    $this->actingAs($admin, 'admin')
        ->from(route('admin.products.create'))
        ->post(route('admin.products.store'), [
            'name' => 'Balanced NPK Fertilizer',
            'description' => 'Balanced crop nutrition for wheat, rice and maize across high-demand seasons.',
            'price' => '880.00',
            'image' => $image,
            'image_path' => 'ignored/path.jpg',
            'category_ids' => [$category->id],
            'crop_ids' => [$crop->id],
            'packaging_ids' => [$packaging->id],
        ])
        ->assertRedirect(route('admin.products.index'))
        ->assertSessionHas('status', 'product-created');

    $product = Product::query()->where('name', 'Balanced NPK Fertilizer')->first();

    expect($product)->not->toBeNull()
        ->and($product->description)->toBe('Balanced crop nutrition for wheat, rice and maize across high-demand seasons.')
        ->and($product->price)->toBe('880.00')
        ->and($product->image_path)->not->toBe('ignored/path.jpg')
        ->and($product->categories->modelKeys())->toBe([$category->id])
        ->and($product->crops->modelKeys())->toBe([$crop->id])
        ->and($product->packagings->modelKeys())->toBe([$packaging->id]);

    Storage::assertExists($product->image_path);
});

it('rejects a product when required fields are missing', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.products.create'))
        ->post(route('admin.products.store'), [])
        ->assertRedirect(route('admin.products.create'))
        ->assertSessionHasErrors(['name', 'description', 'price', 'image', 'category_ids', 'crop_ids', 'packaging_ids']);

    $this->assertDatabaseCount('products', 0);
});

it('rejects catalog ids that do not exist', function () {
    Storage::fake();

    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.products.create'))
        ->post(route('admin.products.store'), [
            'name' => 'Balanced NPK Fertilizer',
            'description' => 'Balanced crop nutrition for wheat, rice and maize across high-demand seasons.',
            'price' => '880.00',
            'image' => UploadedFile::fake()->image('npk.jpg'),
            'category_ids' => [999],
            'crop_ids' => [999],
            'packaging_ids' => [999],
        ])
        ->assertRedirect(route('admin.products.create'))
        ->assertSessionHasErrors(['category_ids.0', 'crop_ids.0', 'packaging_ids.0']);

    $this->assertDatabaseCount('products', 0);
});

it('updates a product and replaces its image', function () {
    Storage::fake();

    ['admin' => $admin, 'category' => $category, 'crop' => $crop, 'packaging' => $packaging] = productFormRecords();
    $secondCategory = Category::factory()->create(['name' => 'Bio-Fertilizers']);
    $previousPath = 'products/previous.jpg';
    Storage::put($previousPath, 'previous-image');

    $product = Product::factory()->create([
        'name' => 'Old Name',
        'description' => 'Old description.',
        'price' => '100.00',
        'image_path' => $previousPath,
    ]);
    $product->categories()->sync([$category->id]);
    $product->crops()->sync([$crop->id]);
    $product->packagings()->sync([$packaging->id]);

    $newImage = UploadedFile::fake()->image('updated.png');

    $this->actingAs($admin, 'admin')
        ->from(route('admin.products.edit', $product))
        ->put(route('admin.products.update', $product), [
            'name' => 'Soil Booster Bio Mix',
            'description' => 'Improves soil microbial activity and supports sustainable field productivity.',
            'price' => '620.50',
            'image' => $newImage,
            'category_ids' => [$secondCategory->id],
            'crop_ids' => [$crop->id],
            'packaging_ids' => [$packaging->id],
        ])
        ->assertRedirect(route('admin.products.index'))
        ->assertSessionHas('status', 'product-updated');

    $product->refresh();

    expect($product->name)->toBe('Soil Booster Bio Mix')
        ->and($product->description)->toBe('Improves soil microbial activity and supports sustainable field productivity.')
        ->and($product->price)->toBe('620.50')
        ->and($product->categories->modelKeys())->toBe([$secondCategory->id]);

    Storage::assertMissing($previousPath);
    Storage::assertExists($product->image_path);
});

it('keeps the existing image when a product is updated without a new file', function () {
    Storage::fake();

    ['admin' => $admin, 'category' => $category, 'crop' => $crop, 'packaging' => $packaging] = productFormRecords();
    $imagePath = 'products/keep.jpg';
    Storage::put($imagePath, 'keep-image');

    $product = Product::factory()->create([
        'name' => 'Organic Compost Granules',
        'image_path' => $imagePath,
    ]);
    $product->categories()->sync([$category->id]);
    $product->crops()->sync([$crop->id]);
    $product->packagings()->sync([$packaging->id]);

    $this->actingAs($admin, 'admin')
        ->from(route('admin.products.edit', $product))
        ->put(route('admin.products.update', $product), [
            'name' => 'Organic Compost Granules',
            'description' => $product->description,
            'price' => $product->price,
            'category_ids' => [$category->id],
            'crop_ids' => [$crop->id],
            'packaging_ids' => [$packaging->id],
        ])
        ->assertRedirect(route('admin.products.index'));

    expect($product->refresh()->image_path)->toBe($imagePath);
    Storage::assertExists($imagePath);
});

it('deletes a product, its image, and its catalog assignments', function () {
    Storage::fake();

    ['admin' => $admin, 'category' => $category, 'crop' => $crop, 'packaging' => $packaging] = productFormRecords();
    $imagePath = 'products/delete-me.jpg';
    Storage::put($imagePath, 'delete-image');

    $product = Product::factory()->create([
        'image_path' => $imagePath,
    ]);
    $product->categories()->sync([$category->id]);
    $product->crops()->sync([$crop->id]);
    $product->packagings()->sync([$packaging->id]);

    $this->actingAs($admin, 'admin')
        ->from(route('admin.products.index'))
        ->delete(route('admin.products.destroy', $product))
        ->assertRedirect(route('admin.products.index'))
        ->assertSessionHas('status', 'product-deleted');

    $this->assertModelMissing($product);
    $this->assertDatabaseCount('category_product', 0);
    $this->assertDatabaseCount('crop_product', 0);
    $this->assertDatabaseCount('packaging_product', 0);
    Storage::assertMissing($imagePath);
});

it('streams a stored product image for an authenticated admin', function () {
    Storage::fake();

    $admin = Admin::factory()->create();
    $imagePath = 'products/stream.jpg';
    Storage::put($imagePath, 'image-bytes');

    $product = Product::factory()->create([
        'image_path' => $imagePath,
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.products.image', $product))
        ->assertOk();
});
