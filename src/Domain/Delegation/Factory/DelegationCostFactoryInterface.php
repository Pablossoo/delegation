<?php

declare(strict_types=1);

namespace App\Domain\Delegation\Factory;

use App\Domain\Delegation\CalculatorStrategy\DelegationCostCalculator;

interface DelegationCostFactoryInterface
{
    public function create(\DateInterval $diffDaysStartAndEnd): DelegationCostCalculator;
}
