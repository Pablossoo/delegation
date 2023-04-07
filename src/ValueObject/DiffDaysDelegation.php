<?php

declare(strict_types=1);

namespace App\ValueObject;

use Carbon\CarbonImmutable;
use DateInterval;

final class DiffDaysDelegation
{
    public function calculateDiffDate(
        \DateTimeInterface $startDelegation,
        \DateTimeInterface $endDelegation
    ): \DateInterval {
        $start         = CarbonImmutable::parse($startDelegation->format('Y-m-d H:i:s'));
        $end           = CarbonImmutable::parse($endDelegation->format('Y-m-d H:i:s'));
        $diffInMinutes = 0;
        $step          = $start;

        while ($step < $end) {
            if ($step->isWeekend()) {
                $step = $step->next('Monday');

                continue;
            }

            $nextStep = \min($end, $step->addDay()->startOfDay());

            $diffInMinutes += $step->diffInMinutes($nextStep);
            $step = $nextStep;
        }
        $diffInHours = \round($diffInMinutes / 60, 2);
        $diffInDays  = \floor($diffInHours / 24);
        $diffInHours %= 24;

        if ($diffInHours >= 8) {
            ++$diffInDays;
            $diffInHours = 0;
        }

        return new DateInterval(\sprintf('P%sDT%dH', $diffInDays, $diffInHours));
    }
}
