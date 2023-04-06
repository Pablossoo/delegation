<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute] final class UniqDelegationUser extends Constraint
{
    public $message = 'User is already on delegation in selected period';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
