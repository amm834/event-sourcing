<?php

namespace App\Domains\Cart\Events;

use Carbon\Carbon;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CartInitialized extends ShouldBeStored
{
    public function __construct(
        public readonly string $cartUuid,
        public readonly string $customerUuid,
        public readonly Carbon $date,
    )
    {
        //
    }
}
