<?php

namespace App\Http\Requests;

use App\Models\Career;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCareerApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'career_id' => [
                'required',
                'integer',
                Rule::exists(Career::class, 'id')->where(fn ($query) => $query->whereDate('last_application_date', '>=', today())),
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'max:20'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }
}
