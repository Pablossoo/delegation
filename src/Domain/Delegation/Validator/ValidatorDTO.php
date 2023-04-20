<?php

namespace App\Domain\Delegation\Validator;

use App\Domain\Delegation\DTO\DelegationRequest;

interface ValidatorDTO
{
    public function validate(DelegationRequest $delegationRequest): bool;
}