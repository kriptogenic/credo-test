<?php

namespace App\Models;

use App\Enums\GiftStatus;
use App\Enums\GiftType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiftHistory extends Model
{
    protected $casts = [
        'type' => GiftType::class,
        'status' => GiftStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
