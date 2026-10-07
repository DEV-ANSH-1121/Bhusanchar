<?php

namespace App\Http\Requests\Admin;

use App\Models\ContactEnquiry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnquiryStatusRequest extends FormRequest
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
            'status' => ['required', 'integer', Rule::in(array_keys(ContactEnquiry::STATUSES))],
            'admin_message' => [
                'nullable',
                'string',
                'max:5000',
                Rule::requiredIf($this->boolean('send_email')),
            ],
            'send_email' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'admin_message' => 'message',
            'send_email' => 'email option',
        ];
    }

    public function adminMessage(): ?string
    {
        $message = trim($this->string('admin_message')->toString());

        return $message === '' ? null : $message;
    }
}
