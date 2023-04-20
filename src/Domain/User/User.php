<?php

declare(strict_types=1);

namespace App\Domain\User;

class User
{
    private ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
