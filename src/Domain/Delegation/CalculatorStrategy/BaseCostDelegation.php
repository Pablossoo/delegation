<?php

declare(strict_types=1);

namespace App\Domain\Delegation\CalculatorStrategy;

use App\Domain\Delegation\CostDelegationInterface;

final class BaseCostDelegation implements CostDelegationInterface
{
    private const NORMAL_RATE_MULTIPLIER = 1;

    public function calculate(int $numberOfDaysOnDelegation): int
    {
        return $numberOfDaysOnDelegation;
    }
}
