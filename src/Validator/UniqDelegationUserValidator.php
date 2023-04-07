<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\DelegationEntityRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class UniqDelegationUserValidator extends ConstraintValidator
{
    public function __construct(
        private readonly DelegationEntityRepository $delegationEntityRepository
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        $existingDelegation = $this->delegationEntityRepository->findDuplicateDelegationInSameTimeForUser(
            $value->startDelegation,
            $value->endDelegation,
            $value->user,
        );

        if ($existingDelegation) {
            $this->context->buildViolation($constraint->message)
                ->atPath('startDate')
                ->addViolation();
        }
    }
}
