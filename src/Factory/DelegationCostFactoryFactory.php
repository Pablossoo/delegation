<?php

declare(strict_types=1);

namespace App\Factory;

use App\BaseCostDelegation;
use App\BonusCostDelegation;
use App\DelegationCostCalculator;
use App\ZeroCostDelegation;

final class DelegationCostFactoryFactory implements DelegationCostFactoryInterface
{
    private const LENGTH_DELEGATION_ALLOW_TO_GET_EXTRA__DIET = 7;

    private const MINIMAL_HOURS_TO_PAYMENT_DIET = 8;

    public function create(\DateInterval $diffDaysStartAndEnd): DelegationCostCalculator
    {
        if ($diffDaysStartAndEnd->d === 0 && $diffDaysStartAndEnd->h < self::MINIMAL_HOURS_TO_PAYMENT_DIET) {
            $delegationCalculator = new ZeroCostDelegation();
        } elseif ($diffDaysStartAndEnd->d > self::LENGTH_DELEGATION_ALLOW_TO_GET_EXTRA__DIET) {
            $delegationCalculator = new BonusCostDelegation();
        } else {
            $delegationCalculator = new BaseCostDelegation();
        }

        return new DelegationCostCalculator($delegationCalculator, $diffDaysStartAndEnd->d);
    }
}
