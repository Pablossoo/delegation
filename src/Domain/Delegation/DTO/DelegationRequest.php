<?php

declare(strict_types=1);

namespace App\Domain\Delegation\DTO;

use App\Infrastructure\Validator\UniqDelegationUser;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqDelegationUser] final class DelegationRequest
{
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['PL', 'DE', 'GB'])]
    public string $country;

    #[Assert\NotBlank]
    #[Assert\GreaterThan(value: 'today')]
    public \DateTimeInterface $startDelegation;

    #[Assert\NotBlank]
    #[Assert\GreaterThan(propertyPath: 'startDelegation')]
    public \DateTimeInterface $endDelegation;

    #[Assert\NotBlank]
    public int $user;
}
