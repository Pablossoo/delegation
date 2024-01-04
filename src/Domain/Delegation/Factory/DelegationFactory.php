<?php

declare(strict_types=1);

namespace App\Domain\Delegation\Factory;

use App\Application\Command\CreateDelegation;
use App\Domain\Delegation\Delegation;
use Ramsey\Uuid\Uuid;


final readonly class DelegationFactory implements DelegationFactoryInterface
{
    public function create(CreateDelegation $delegation): Delegation
    {
        return new Delegation(
            Uuid::uuid4(),
            $delegation->country,
            $delegation->startDelegation,
            $delegation->endDelegation,
            $delegation->createdAt
        );
    }
}
