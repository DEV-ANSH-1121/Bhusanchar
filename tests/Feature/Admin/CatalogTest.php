<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\Crop;
use App\Models\Packaging;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests away from catalog endpoints', function (string $uri) {
    $this->get($uri)->assertRedirect(route('admin.login'));
})->with([
    'categories' => ['/app/cp/categories'],
    'crops' => ['/app/cp/crops'],
    'packagings' => ['/app/cp/packagings'],
]);

it('lists catalog records for an authenticated admin', function (string $route, string $model, string $name) {
    $admin = Admin::factory()->create();
    $model::factory()->create(['name' => $name]);

    $this->actingAs($admin, 'admin')
        ->get(route($route))
        ->assertSee($name, false);
})->with([
    'categories' => ['admin.categories.index', Category::class, 'Fertilizers'],
    'crops' => ['admin.crops.index', Crop::class, 'Wheat'],
    'packagings' => ['admin.packagings.index', Packaging::class, '25 kg'],
]);

it('creates a catalog record', function (string $storeRoute, string $indexRoute, string $table, string $name, string $status) {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->post(route($storeRoute), ['name' => $name])
        ->assertRedirect(route($indexRoute))
        ->assertSessionHas('status', $status);

    $this->assertDatabaseHas($table, ['name' => $name]);
})->with([
    'category' => ['admin.categories.store', 'admin.categories.index', 'categories', 'Micronutrients', 'category-created'],
    'crop' => ['admin.crops.store', 'admin.crops.index', 'crops', 'Maize', 'crop-created'],
    'packaging' => ['admin.packagings.store', 'admin.packagings.index', 'packagings', '50 kg', 'packaging-created'],
]);

it('rejects a duplicate catalog name', function (string $storeRoute, string $model, string $name) {
    $admin = Admin::factory()->create();
    $model::factory()->create(['name' => $name]);

    $this->actingAs($admin, 'admin')
        ->from(route(str_replace('.store', '.create', $storeRoute)))
        ->post(route($storeRoute), ['name' => $name])
        ->assertSessionHasErrors('name');
})->with([
    'category' => ['admin.categories.store', Category::class, 'Fertilizers'],
    'crop' => ['admin.crops.store', Crop::class, 'Wheat'],
    'packaging' => ['admin.packagings.store', Packaging::class, '25 kg'],
]);

it('updates a catalog record', function (string $updateRoute, string $indexRoute, string $model, string $status) {
    $admin = Admin::factory()->create();
    $record = $model::factory()->create(['name' => 'Old Name']);

    $this->actingAs($admin, 'admin')
        ->put(route($updateRoute, $record), ['name' => 'New Name'])
        ->assertRedirect(route($indexRoute))
        ->assertSessionHas('status', $status);

    expect($record->refresh()->name)->toBe('New Name');
})->with([
    'category' => ['admin.categories.update', 'admin.categories.index', Category::class, 'category-updated'],
    'crop' => ['admin.crops.update', 'admin.crops.index', Crop::class, 'crop-updated'],
    'packaging' => ['admin.packagings.update', 'admin.packagings.index', Packaging::class, 'packaging-updated'],
]);

it('deletes a catalog record without deleting assigned products', function () {
    $admin = Admin::factory()->create();
    $category = Category::factory()->create();
    $product = Product::factory()->create();
    $product->categories()->sync([$category->id]);

    $this->actingAs($admin, 'admin')
        ->delete(route('admin.categories.destroy', $category))
        ->assertRedirect(route('admin.categories.index'))
        ->assertSessionHas('status', 'category-deleted');

    $this->assertModelMissing($category);
    $this->assertModelExists($product);
    $this->assertDatabaseCount('category_product', 0);
});

it('escapes catalog names on the listing page', function () {
    $admin = Admin::factory()->create();
    Category::factory()->create([
        'name' => "<script>alert('xss')</script>",
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.categories.index'))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false);
});
