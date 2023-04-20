<?php

declare(strict_types=1);

namespace App\Domain\Common\Enum;

enum Country: int
{
    case PL = 10;
    case DE = 50;
    case GB = 75;
}
