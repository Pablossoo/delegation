<?php

declare(strict_types=1);

namespace App;

final class BonusCostDelegation implements CostDelegationInterface
{
    private const BONUS_RATE_MULTIPLIER = 2;
    private const NUMBER_DAYS_FOR_BASE_PAID = 7;

    public function calculate(int $numberOfDaysOnDelegation): int
    {
        $extraPaidDays = $numberOfDaysOnDelegation - self::NUMBER_DAYS_FOR_BASE_PAID;
        return $numberOfDaysOnDelegation + (self::BONUS_RATE_MULTIPLIER * $extraPaidDays);
    }
}
