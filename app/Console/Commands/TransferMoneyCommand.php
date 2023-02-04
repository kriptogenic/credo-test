<?php

namespace App\Console\Commands;

use App\Enums\GiftStatus;
use App\Enums\GiftType;
use App\Models\GiftHistory;
use App\Services\TransferMoneyService;
use Illuminate\Console\Command;

class TransferMoneyCommand extends Command
{
    protected $signature = 'app:transfer-money';

    protected $description = 'Transfers money to clients bank account';

    public function handle(TransferMoneyService $service): int
    {
        $gifts = GiftHistory::where('type', GiftType::Money)
            ->where('status', GiftStatus::Pending)
            ->get();
        foreach ($gifts as $gift) {
            $service->transfer($gift->delivery_address, $gift->data);
            $gift->status = GiftStatus::Delivered;
            $gift->save();
        }
        return Command::SUCCESS;
    }
}
