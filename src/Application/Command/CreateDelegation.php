<?php

namespace App\Application\Command;

class CreateDelegation
{
    public string $country;

    public \DateTimeInterface $startDelegation;

    public \DateTimeInterface $endDelegation;

    public \DateTimeInterface $createdAt;
}