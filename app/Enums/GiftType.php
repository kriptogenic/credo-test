<?php

namespace App\Enums;

enum GiftType: string
{
    case Item = 'item';
    case Money = 'money';
    case Bonus = 'bonus';
}
