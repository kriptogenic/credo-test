<?php

namespace App\Services;

class ConvertGiftService
{
    private const CONVERT_COEFFICIENT = 60;

    public function convert(int $money): int
    {
        return intval($money / self::CONVERT_COEFFICIENT);
    }
}
