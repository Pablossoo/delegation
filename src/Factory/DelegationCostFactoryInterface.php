<?php

declare(strict_types=1);

namespace App\Factory;

use App\DelegationCostCalculator;

interface DelegationCostFactoryInterface
{
    public function create(\DateInterval $diffDaysStartAndEnd): DelegationCostCalculator;
}
