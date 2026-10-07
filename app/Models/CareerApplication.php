<?php

namespace App\Models;

use Database\Factories\CareerApplicationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'career_id',
    'name',
    'email',
    'mobile',
    'resume_path',
    'resume_disk',
    'status',
    'admin_message',
])]
class CareerApplication extends Model
{
    public const int STATUS_NEW = 1;

    public const int STATUS_IN_PROGRESS = 2;

    public const int STATUS_CLOSED = 3;

    /**
     * @var array<int, string>
     */
    public const array STATUSES = [
        self::STATUS_NEW => 'New',
        self::STATUS_IN_PROGRESS => 'In progress',
        self::STATUS_CLOSED => 'Closed',
    ];

    /** @use HasFactory<CareerApplicationFactory> */
    use HasFactory;

    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => self::STATUS_NEW,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'integer',
        ];
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? 'Unknown';
    }

    /**
     * @return BelongsTo<Career, $this>
     */
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}
