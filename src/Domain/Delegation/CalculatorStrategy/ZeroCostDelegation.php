<?php

declare(strict_types=1);

namespace App\Domain\Delegation\CalculatorStrategy;

use App\Domain\Delegation\CostDelegationInterface;

final class ZeroCostDelegation implements CostDelegationInterface
{
    public function calculate(int $numberOfDaysOnDelegation): int
    {
        return 0 * $numberOfDaysOnDelegation;
    }
}
