<?php

namespace App\Domains\Cart\Events;


use App\Domains\Cart\DataTransferObjects\CartCheckoutData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CartCheckedOut extends ShouldBeStored
{
    public function __construct(
        public string           $cartUuid,
        public CartCheckoutData $cartCheckoutData
    )
    {
    }
}
