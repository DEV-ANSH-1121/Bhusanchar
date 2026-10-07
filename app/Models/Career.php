<?php

namespace App\Models;

use Database\Factories\CareerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'job_title',
    'job_description',
    'eligible_criteria',
    'key_responsibilities',
    'salary',
    'location',
    'last_application_date',
])]
class Career extends Model
{
    /** @use HasFactory<CareerFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'eligible_criteria' => 'array',
            'key_responsibilities' => 'array',
            'last_application_date' => 'date',
        ];
    }

    /**
     * Limit jobs to those that still accept applications.
     */
    #[Scope]
    protected function acceptingApplications(Builder $query): Builder
    {
        return $query->whereDate('last_application_date', '>=', today());
    }

    /**
     * @return HasMany<CareerApplication, $this>
     */
    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class);
    }
}
