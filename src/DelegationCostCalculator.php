<?php

declare(strict_types=1);

namespace App;

use App\Enum\Country;

final readonly class DelegationCostCalculator
{
    public function __construct(
        private CostDelegationInterface $costDelegation,
        private int $numberOfDaysOnDelegation
    ) {
    }

    public function getTotalCost(Country $country): int
    {
        return $country->value * $this->costDelegation->calculate($this->numberOfDaysOnDelegation);
    }
}
