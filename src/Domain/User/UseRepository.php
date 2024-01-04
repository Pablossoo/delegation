<?php

namespace App\Domain\User;

interface UseRepository
{
    public function save(User $user): void;
}