<?php

namespace App\Domains\Product;

class Price
{
    public function __construct(
        private readonly int $pricePerItemExcludingVat,
        private readonly int $vatPercentage,
    )
    {
    }

    public function pricePerItemExcludingVat(): int
    {
        return $this->pricePerItemExcludingVat;
    }

    public function pricePerItemIncludingVat(): int
    {
        return $this->pricePerItemExcludingVat + $this->vatPrice();
    }

    public function vatPercentage(): int
    {
        return $this->vatPercentage;
    }

    public function vatPrice(): int
    {
        $vatPrice = round($this->pricePerItemExcludingVat * ($this->vatPercentage / 100));

        return (int)$vatPrice;
    }
}
