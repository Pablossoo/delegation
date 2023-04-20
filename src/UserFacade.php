<?php

declare(strict_types=1);

namespace App;

use App\Domain\User\User;
use App\Infrastructure\ORM\UserRepository;

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
