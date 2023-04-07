<?php

declare(strict_types=1);

namespace App\Factory;

use App\DTO\DelegationRequest;
use App\Entity\Delegation;

interface DelegationFactoryInterface
{
    public function create(DelegationRequest $delegationRequest): Delegation;
}
