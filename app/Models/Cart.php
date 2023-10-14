<?php

namespace App\Models;

use App\Domains\Cart\Enums\CartStatus;
use CartLockStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EventSourcing\Projections\Projection;

class Cart extends Projection
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'total_item_price_excluding_vat' => 'integer',
        'total_item_price_including_vat' => 'integer',
        'status' => CartStatus::class,
        'lock_status' => CartLockStatus::class,
        'coupon_reduction' => 'integer',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
