<?php

namespace Easybell\Assesment;

use Exception;

class Checkout
{
  private array $items = [];

  public function __construct(private readonly PricingRulesCollection $pricingRules)
  {
  }

  public function scan(string $item): void
  {
    if (! isset($this->items[$item])) {
        $this->items[$item] = 0;
    }

    ++$this->items[$item];
  }

  public function total(): float
  {
    $total = 0;

    foreach ($this->items as $itemId => $itemCount) {
        $pricingRule = $this->pricingRules->find($itemId);
        if ($pricingRule === null) {
            throw new Exception(sprintf('item pricing rule not exists. item id: %s', $itemId));
        }

        $total += $pricingRule->calculatePrice($itemCount);
    }

    return $total;
  }
}

// Example usage
// $pricingRules = [
//   ['item' => 'A', 'quantity' => 3, 'basePrice' => 130, 'price' => 260],
//   ['item' => 'B', 'quantity' => 2, 'basePrice' => 45, 'price' => 70],
// ];

// $checkout = new Checkout($pricingRules);
// $checkout->scan('A');
// $checkout->scan('A');
// $checkout->scan('A');
// $checkout->scan('B');
// $checkout->scan('B');

// $total = $checkout->total();

// echo "Total: $" . $total;
