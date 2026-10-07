<?php

namespace App\Models;

use Database\Factories\StockPointApplicationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'applicant_name',
    'business_name',
    'email',
    'mobile',
    'state',
    'district',
    'block',
    'panchayat',
    'business_address',
    'status',
    'admin_message',
])]
class StockPointApplication extends Model
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

    /** @use HasFactory<StockPointApplicationFactory> */
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
}
