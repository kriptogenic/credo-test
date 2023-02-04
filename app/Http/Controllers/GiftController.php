<?php

namespace App\Http\Controllers;

use App\Enums\GiftStatus;
use App\Enums\GiftType;
use App\Models\GiftHistory;
use App\Models\GiftItem;
use App\Models\GiftMoney;
use App\Services\ConvertGiftService;
use App\Services\RandomGiftService;
use Illuminate\Http\Request;

class GiftController extends Controller
{
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

    public function update(Request $request, int $gift_id, ConvertGiftService $convertGiftService)
    {
        $gift = GiftHistory::where('status', GiftStatus::New)
            ->where('user_id', $request->user()->id)
            ->where('id', $gift_id)
            ->firstOrfail();
        $data = $request->validate([
            'address' => ['required', 'string'],
            'convert' => ['required', 'boolean'],
        ]);
        if ($gift->type === GiftType::Money && $data['convert']) {
            $gift->data = $convertGiftService->convert($gift->data);
            $gift->type = GiftType::Bonus;
        }
        $gift->status = GiftStatus::Pending;
        $gift->delivery_address = $data['address'];
        $gift->save();

        if ($gift->type === GiftType::Item) {
            GiftItem::find($gift->data)->decrement('amount');
        } elseif ($gift->type === GiftType::Money) {
            GiftMoney::first()->decrement('balance', $gift->data);
        }


        return [
            'data' => $gift
        ];
    }

    public function destroy(Request $request, int $gift_id)
    {
        $gift = GiftHistory::where('status', GiftStatus::New)
            ->where('user_id', $request->user()->id)
            ->where('id', $gift_id)
            ->firstOrfail();
        $gift->status = GiftStatus::Cancelled;
        $gift->save();
    }
}
