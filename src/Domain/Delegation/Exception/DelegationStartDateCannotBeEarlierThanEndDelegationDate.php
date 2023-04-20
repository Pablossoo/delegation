<?php

namespace App\Domain\Delegation\Exception;

final class DelegationStartDateCannotBeEarlierThanEndDelegationDate extends \Exception
{
    public static function tryCreateDelegationWithDates(\DateTimeInterface $startDate, \DateTimeInterface $endDate): self {
        return new DelegationStartDateCannotBeEarlierThanEndDelegationDate(sprintf('Start date %s can not be earlier than end date %s', $startDate->format('Y-m-d'), $endDate->format('Y-m-d')));
    }
}