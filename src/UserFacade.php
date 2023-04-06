<?php

declare(strict_types=1);

namespace App;

use App\Entity\User;
use App\Repository\UserRepository;

final readonly class UserFacade
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function createUser(): void
    {
        $user = new User();
        $this->repository->save($user);
    }

    public function getLastUser(): ?User
    {
        return $this->repository->getLastCreatedUser();
    }
}
