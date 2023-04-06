<?php

declare(strict_types=1);

namespace App;

interface CostDelegationInterface
{
    public function calculate(int $numberOfDaysOnDelegation): int;
}
