<?php

namespace App\Application\Handler;

use App\Domain\Delegation\Delegation;
use App\Domain\Delegation\DelegationRepository;
use App\Domain\Delegation\Factory\DelegationFactoryInterface;


final class CreateDelegation
{

    public function __construct(private readonly DelegationRepository $delegationRepository, private readonly DelegationFactoryInterface $delegationFactory)
    {
    }

    public function __invoke(\App\Application\Command\CreateDelegation $command): Delegation
    {
        $delegation = $this->delegationFactory->create($command);
        $this->delegationRepository->save($delegation);
    }
}