<?php

namespace Tests\Unit;

use Easybell\Assesment\Checkout;
use Easybell\Assesment\PricingRule;
use Easybell\Assesment\PricingRulesCollection;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    public function testCheckout(): void
    {
        $rule = $this->createMock(PricingRule::class);
        $rule->method("calculatePrice")->willReturn(10.0);

        $pricingRules = $this->createMock(PricingRulesCollection::class);
        $pricingRules->method("find")->willReturn($rule);

        $checkout = new Checkout($pricingRules);

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('B');

        $this->assertEquals(20, $checkout->total());
    }
}