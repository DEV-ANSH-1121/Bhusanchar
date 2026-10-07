<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user('admin') !== null;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'eligible_criteria' => $this->bulletPoints('eligible_criteria'),
            'key_responsibilities' => $this->bulletPoints('key_responsibilities'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'job_title' => ['required', 'string', 'max:255'],
            'job_description' => ['required', 'string', 'max:10000'],
            'eligible_criteria' => ['required', 'array', 'min:1', 'max:30'],
            'eligible_criteria.*' => ['required', 'string', 'max:500'],
            'key_responsibilities' => ['required', 'array', 'min:1', 'max:30'],
            'key_responsibilities.*' => ['required', 'string', 'max:500'],
            'salary' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'last_application_date' => ['required', 'date'],
        ];
    }

    /**
     * @return array<int, string>
     */
    private function bulletPoints(string $key): array
    {
        $value = $this->input($key, []);

        if (! is_array($value)) {
            return [];
        }

        return collect($value)
            ->map(fn (mixed $point): string => is_string($point) ? trim($point) : '')
            ->filter(fn (string $point): bool => $point !== '')
            ->values()
            ->all();
    }
}
