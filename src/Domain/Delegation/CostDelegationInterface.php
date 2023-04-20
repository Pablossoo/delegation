<?php

declare(strict_types=1);

namespace App\Domain\Delegation;

interface CostDelegationInterface
{
    public function calculate(int $numberOfDaysOnDelegation): int;
}
