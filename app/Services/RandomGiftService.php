<?php

namespace App\Services;

use App\Enums\GiftStatus;
use App\Enums\GiftType;
use App\Models\GiftHistory;
use App\Models\GiftItem;
use App\Models\GiftMoney;
use App\Models\User;
use Illuminate\Support\Collection;

class RandomGiftService
{
    const MIN_MONEY = 50_000;
    const MAX_MONEY = 1_500_000;
    const MIN_BONUS = 30;
    const MAX_BONUS = 500;

    public function getGift(User $user)
    {
        $items = $this->getAvailableItems();
        $money_limit = $this->getAvailableMoney();

        $gift_types = [GiftType::Bonus];
        if ($money_limit > 0) {
            $gift_types[] = GiftType::Money;
        }
        if ($items->isNotEmpty()) {
            $gift_types[] = GiftType::Item;
        }

        $type = $gift_types[array_rand($gift_types)];
        $data = match ($type) {
            GiftType::Item => $this->randomItem($items)->id,
            GiftType::Money => $this->randomNumber(self::MIN_MONEY, min(self::MAX_MONEY, $money_limit), 1000),
            GiftType::Bonus => $this->randomNumber(self::MIN_BONUS, self::MAX_BONUS, 5),
        };

        $gift = new GiftHistory();
        $gift->user()->associate($user);
        $gift->type = $type;
        $gift->data = $data;
        $gift->status = GiftStatus::New;
        $gift->save();

        return $gift;
    }

    private function getAvailableMoney(): int
    {
        return GiftMoney::first()->balance;
    }

    /**
     * @return \Illuminate\Support\Collection<int, GiftItem>|GiftItem[]
     * @noinspection PhpDocSignatureInspection
     */
    private function getAvailableItems(): Collection
    {
        return GiftItem::where('amount', '>', 0)->get();
    }

    private function randomNumber(int $min, int $max, int $step): int
    {
        return random_int(intval($min / $step), intval($max / $step)) * $step;
    }

    /**
     * @param \Illuminate\Support\Collection<int, GiftItem>|GiftItem[] $items
     * @return GiftItem
     * @noinspection PhpDocSignatureInspection
     */
    private function randomItem(Collection $items): GiftItem
    {
        return $items->map(function (GiftItem $item) {
            return array_fill(0, $item->random_rate, $item);
        })->flatten(1)->random();
    }
}
