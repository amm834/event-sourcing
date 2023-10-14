<?php

namespace App\Domains\Actions;

use App\Domains\Cart\Events\CartInitialized;
use App\Models\Cart;
use App\Models\Customer;
use App\Support\Uuid;

class InitializeCart
{
    public function __invoke(Customer $customer): Cart|array|\LaravelIdea\Helper\App\Models\_IH_Cart_C
    {
        $cartUuid = Uuid::new();

        $event = new CartInitialized(
            cartUuid: $cartUuid,
            customerUuid: $customer->uuid,
            date: now(),
        );

        $event->handle();

        return Cart::findOrFail($cartUuid);
    }
}
