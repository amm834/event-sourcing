<?php

namespace App\Domains\Cart\Projectors;

use App\Domains\Cart\Enums\CartStatus;
use App\Domains\Cart\Events\CartCheckedOut;
use App\Domains\Cart\Events\CartInitialized;
use App\Domains\Cart\Events\CartItemAdded;
use App\Models\Cart;
use CartLockStatus;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

class CartProjector extends Projector
{
    public function resetState(): void
    {
       Cart::query()->delete();
    }

    public function onCartInitialized(CartInitialized $event): void
    {
        (new Cart)->writeable()->create([
            'uuid' => $event->cartUuid,
            'status' => CartStatus::pending(),
            'lock_status' => CartLockStatus::unlocked(),
            'customer_id' => $event->customerUuid,
            'created_at' => $event->date,
        ]);
    }

    public function onCartItemAdded(CartItemAdded $event): void
    {
        $cart = Cart::find($event->cartUuid);

        $cart->writeable()->update([
            'total_item_price_excluding_vat' => $cart->total_item_price_excluding_vat + ($event->amount * $event->currentPrice->pricePerItemExcludingVat()),
            'total_item_price_including_vat' => $cart->total_item_price_including_vat + ($event->amount * $event->currentPrice->pricePerItemIncludingVat()),
        ]);
    }

    public function onCartCheckedOut(CartCheckedOut $event): void
    {
        $cart = Cart::find($event->cartUuid);

        $storedEvent = EloquentStoredEvent::find($event->storedEventId());

        $cart->writeable()->update([
            'status' => CartStatus::checkedOut(),
            'checked_out_at' => $storedEvent->created_at,
        ]);
    }

}
