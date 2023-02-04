<?php

namespace App\Http\Controllers;

use App\Enums\GiftType;
use App\Models\GiftItem;
use App\Services\RandomGiftService;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {

    }

    public function store(RandomGiftService $giftService, Request $request)
    {
        $gift = $giftService->getGift($request->user());
        $data = $gift->type === GiftType::Item ? GiftItem::findOrFail($gift->data)->name : $gift->data;
        return [
            'data' => [
                'id' => $gift->id,
                'type' => $gift->type->value,
                'data' => $data
            ]
        ];
    }
}
