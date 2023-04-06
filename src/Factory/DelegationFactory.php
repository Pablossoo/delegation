<?php

declare(strict_types=1);

namespace App\Factory;

use App\DTO\DelegationRequest;
use App\Entity\Delegation;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class DelegationFactory implements DelegationFactoryInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function create(DelegationRequest $delegationRequest): Delegation
    {
        $user = $this->userRepository->find($delegationRequest->user);
        if (! $user instanceof \App\Entity\User) {
            throw new NotFoundHttpException('User not found');
        }
        $delegation = new Delegation();
        $delegation->setStartDelegation($delegationRequest->startDelegation);
        $delegation->setEndDelegation($delegationRequest->endDelegation);
        $delegation->setUser($user);
        $delegation->setCountry($delegationRequest->country);

        return $delegation;
    }
}
