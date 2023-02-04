<?php

namespace App\Enums;

enum GiftStatus: string
{
    case New = 'new';
    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Delivered = 'delivered';
}
