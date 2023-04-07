<?php

declare(strict_types=1);

namespace App;

final class ZeroCostDelegation implements CostDelegationInterface
{
    public function calculate(int $numberOfDaysOnDelegation): int
    {
        return 0 * $numberOfDaysOnDelegation;
    }
}
