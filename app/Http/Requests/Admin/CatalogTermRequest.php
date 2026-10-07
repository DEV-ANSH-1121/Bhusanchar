<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Models\Crop;
use App\Models\Packaging;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use RuntimeException;

class CatalogTermRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique($this->modelClass())->ignore($this->uniqueIgnore()),
            ],
        ];
    }

    /**
     * @return class-string<Model>
     */
    private function modelClass(): string
    {
        return match (true) {
            $this->routeIs('admin.categories.*') => Category::class,
            $this->routeIs('admin.crops.*') => Crop::class,
            $this->routeIs('admin.packagings.*') => Packaging::class,
            default => throw new RuntimeException('Unsupported catalog route.'),
        };
    }

    private function uniqueIgnore(): ?Model
    {
        $record = $this->route('category') ?? $this->route('crop') ?? $this->route('packaging');

        return $record instanceof Model ? $record : null;
    }
}
