<?php

declare(strict_types=1);

namespace App\ValueObject;

final class DiffDaysDelegation
{
    public function calculateDiffDate(
        \DateTimeImmutable $startDelegation,
        \DateTimeImmutable $endDelegation
    ): \DateInterval {
        return $startDelegation->diff($endDelegation);
    }
}
