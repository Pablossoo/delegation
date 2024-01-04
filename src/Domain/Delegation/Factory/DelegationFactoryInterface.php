<?php

declare(strict_types=1);

namespace App\Domain\Delegation\Factory;

use App\Application\Command\CreateDelegation;
use App\Domain\Delegation\Delegation;
use App\Domain\Delegation\DTO\DelegationRequest;

interface DelegationFactoryInterface
{
    public function create(CreateDelegation $delegation): Delegation;
}
