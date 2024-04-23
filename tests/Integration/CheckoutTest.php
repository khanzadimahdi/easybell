<?php

namespace Tests\Integration;

use Easybell\Assesment\Checkout;
use Easybell\Assesment\PricingRule;
use Easybell\Assesment\PricingRulesCollection;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    public function testCheckout(): void
    {
        $this->assertEquals(0, $this->price(''));
        $this->assertEquals(50, $this->price('A'));
        $this->assertEquals(80, $this->price('A,B'));
        $this->assertEquals(115, $this->price('C,D,B,A'));

        $this->assertEquals(100, $this->price('A,A'));
        $this->assertEquals(130, $this->price('A,A,A'));
        $this->assertEquals(180, $this->price('A,A,A,A'));
        $this->assertEquals(230, $this->price('A,A,A,A,A'));
        $this->assertEquals(260, $this->price('A,A,A,A,A,A'));

        $this->assertEquals(160, $this->price('A,A,A,B'));
        $this->assertEquals(175, $this->price('A,A,A,B,B'));
        $this->assertEquals(190, $this->price('A,A,A,B,B,D'));
        $this->assertEquals(190, $this->price('D,A,B,A,B,A'));
    }

    private function price(string $commaSeperatedItems): float
    {
        $checkout = $this->checkout();

        $items = array_filter(explode(',', $commaSeperatedItems));
        foreach ($items as $item) {
            $checkout->scan($item);
        }

        return $checkout->total();
    }

    protected function checkout(): Checkout
    {
        // To see more details: http://codekata.com/kata/kata09-back-to-the-checkout/
        // --------------------------
        // Item   Unit    Special
        // Price  Price
        // --------------------------
        // A      50      3 for 130
        // B      30      2 for 45
        // C      20
        // D      15

        $ruleA = new PricingRule('A', 50, 3, 130);
        $ruleB = new PricingRule('B', 30, 2, 45);
        $ruleC = new PricingRule('C', 20);
        $ruleD = new PricingRule('D', 15);

        $pricingRules = new PricingRulesCollection([
            $ruleA, $ruleB, $ruleC, $ruleD
        ]);

        return new Checkout($pricingRules);
    }
}