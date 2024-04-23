<?php

namespace Easybell\Assesment;

use InvalidArgumentException;

class PricingRulesCollection
{
    /**
     * @param PricingRule[] $rules
     */
    public function __construct(private readonly array $rules)
    {
        array_walk($rules, static function ($rules) {
            if (! $rules instanceof PricingRule) {
                throw new InvalidArgumentException(sprintf('each pricing rule MUST be instance of %s', PricingRule::class));
            }
        });
    }

    public function find(string $id): ?PricingRule
    {
        foreach ($this->rules as $rule) {
            if ($rule->getId() === $id) {
                return $rule;
            }
        }

        return null;
    }
}