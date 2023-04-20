<?php

namespace App\Domain\Delegation;

use App\Application\Query\DelegationQuery;
use App\Domain\User\User;

interface DelegationRepository
{
    public function save(Delegation $delegation): void;

    public function findDuplicateDelegationInSameTimeForUser(
        \DateTimeImmutable $startDelegation,
        \DateTimeImmutable $endDelegation,
        int $user
    ): DelegationQuery;
    public function getDelegationsByUser(User $user): DelegationQuery;

}