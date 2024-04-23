<?php

namespace Tests\Unit;

use Easybell\Assesment\PricingRule;
use Easybell\Assesment\PricingRulesCollection;
use PHPUnit\Framework\TestCase;

class PricingRuleCollectionTest extends TestCase
{
    public function testFind(): void
    {
        $rule1 = $this->createPricingRuleMock('A');
        $rule2 = $this->createPricingRuleMock('B');
        $rule3 = $this->createPricingRuleMock('C');

        $pricingRules = new PricingRulesCollection([
            $rule1,
            $rule2,
            $rule3,
        ]);

        $findA = $pricingRules->find('A');
        $this->assertEquals('A', $findA->getId());

        $findB = $pricingRules->find('B');
        $this->assertEquals('B', $findB->getId());

        $findC = $pricingRules->find('C');
        $this->assertEquals('C', $findC->getId());

        $findD = $pricingRules->find('D');
        $this->assertNull($findD);
    }

    private function createPricingRuleMock(string $id): PricingRule
    {
        $mock = $this->createMock(PricingRule::class);
        $mock->method('getId')->willReturn($id);

        return $mock;
    }
}