<?php

namespace Easybell\Assesment;

class PricingRule
{
    public function __construct(
        private readonly string $id,
        private readonly float $unitPrice,
        private readonly int|null $specialQuantity = null,
        private readonly float|null $specialPrice  = null,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function calculatePrice(int $itemCount): float
    {
        if (
            $itemCount < $this->specialQuantity ||
            ($this->specialQuantity === null || $this->specialPrice === null)
        ) {
            return $itemCount * $this->unitPrice;
        }

        $specialPriceCount = (int) ($itemCount / $this->specialQuantity);
        $remainingCount = $itemCount % $this->specialQuantity;

        return ($specialPriceCount * $this->specialPrice) + ($remainingCount * $this->unitPrice);
    }
}