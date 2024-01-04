<?php

declare(strict_types=1);

namespace App\Domain\Delegation;

use App\Domain\Delegation\Exception\DelegationStartDateCannotBeEarlierThanEndDelegationDate;
use App\Domain\User\User;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class Delegation
{
    private User $user;

    public function __construct(
        private UuidInterface              $id,
        private string             $country,
        private \DateTimeInterface $startDelegation,
        private \DateTimeInterface $endDelegation,
        private \DateTimeInterface $createdAt

    )
    {
        if ($this->startDelegation <= $this->endDelegation) {
            throw DelegationStartDateCannotBeEarlierThanEndDelegationDate::tryCreateDelegationWithDates($this->startDelegation, $this->endDelegation);
        }

    }

    public function assignUser(User $user): void
    {
        $this->user = $user;
    }
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getStartDelegation(): \DateTimeInterface
    {
        return $this->startDelegation;
    }

    public function getEndDelegation(): \DateTimeInterface
    {
        return $this->endDelegation;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
