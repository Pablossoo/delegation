<?php

declare(strict_types=1);

namespace App\Mapper;

final class MapCountryToCurrency
{
    public function map(string $country): string
    {
        return match ($country) {
            'PL'    => 'PLN',
            'DE'    => 'EUR',
            'GB'    => 'FUNT',
            default => throw new \Exception('currency not found')
        };
    }
}
