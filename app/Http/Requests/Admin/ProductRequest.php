<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Models\Crop;
use App\Models\Packaging;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user('admin') !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'image' => [
                Rule::requiredIf($this->isMethod('post')),
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['integer', Rule::exists(Category::class, 'id')],
            'crop_ids' => ['required', 'array', 'min:1'],
            'crop_ids.*' => ['integer', Rule::exists(Crop::class, 'id')],
            'packaging_ids' => ['required', 'array', 'min:1'],
            'packaging_ids.*' => ['integer', Rule::exists(Packaging::class, 'id')],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'image' => 'main image',
            'category_ids' => 'categories',
            'crop_ids' => 'suitable crops',
            'packaging_ids' => 'packaging',
        ];
    }

    /**
     * @return array{name: string, description: string, price: mixed}
     */
    public function productAttributes(): array
    {
        return $this->safe()->only(['name', 'description', 'price']);
    }

    /**
     * @return array{category_ids: array<int, int|string>, crop_ids: array<int, int|string>, packaging_ids: array<int, int|string>}
     */
    public function relationIds(): array
    {
        return [
            'category_ids' => $this->validated('category_ids'),
            'crop_ids' => $this->validated('crop_ids'),
            'packaging_ids' => $this->validated('packaging_ids'),
        ];
    }
}
