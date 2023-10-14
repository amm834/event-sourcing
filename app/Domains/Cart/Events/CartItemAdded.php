<?php

namespace App\Domains\Cart\Events;

use App\Domains\Product\Price;
use App\Models\Cart;

class CartItemAdded
{
    public function __construct(
        public readonly string $cartUuid,
        public readonly string $cartItemUuid,
        public readonly string $productUuid,
        public readonly int    $amount,
        public readonly Price  $currentPrice,

    )
    {

    }

    public function getProduct(): Cart
    {
    }

    public function totalPrice(): float|int
    {
        return $this->amount * $this->currentPrice->pricePerItemIncludingVat();
    }
}
