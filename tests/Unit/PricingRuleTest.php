<?php

namespace Tests\Unit;

use Easybell\Assesment\PricingRule;
use PHPUnit\Framework\TestCase;

class PricingRuleTest extends TestCase
{
    public function testPricingRule(): void
    {
        $rule = new PricingRule('A', 50, 3, 130);

        $this->assertEquals('A', $rule->getId());

        $this->assertEquals(50, $rule->calculatePrice(1));
        $this->assertEquals(50+50, $rule->calculatePrice(2));
        $this->assertEquals(130, $rule->calculatePrice(3));
        $this->assertEquals(130+50, $rule->calculatePrice(4));
        $this->assertEquals(260+50, $rule->calculatePrice(7));
    }
}
