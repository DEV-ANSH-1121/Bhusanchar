<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            $product->image_url = route('products.image', $product);
            return $product;
        });
        $response = [
            'success' => true,
            'message' => 'Products fetched successfully',
            'data' => $products,
        ];
        return response()->json($response);
    }

    public function image(Product $product)
    {
        return $product->image();
    }
}
