<?php

namespace App\Application\Handler;

use App\Domain\Delegation\DelegationRepository;

use App\Domain\User\User;
use App\Domain\User\UseRepository;

final class CreateUser
{
    public function __construct(private readonly UseRepository $useRepository)
    {
    }

    public function __invoke(): User
    {
        $this->useRepository->save(new User());
    }
}