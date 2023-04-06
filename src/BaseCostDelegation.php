<?php

declare(strict_types=1);

namespace App;

final class BaseCostDelegation implements CostDelegationInterface
{
    private const NORMAL_RATE_MULTIPLIER = 1;

    public function calculate(int $numberOfDaysOnDelegation): int
    {
        return self::NORMAL_RATE_MULTIPLIER * $numberOfDaysOnDelegation;
    }
}
