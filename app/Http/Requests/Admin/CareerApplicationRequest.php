<?php

namespace App\Http\Requests\Admin;

use App\Models\Career;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerApplicationRequest extends FormRequest
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
            'career_id' => ['required', 'integer', Rule::exists(Career::class, 'id')],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'max:20'],
            'resume' => [
                Rule::requiredIf($this->isMethod('post')),
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
        ];
    }
}
