<?php

namespace App\Services;

use GuzzleHttp\Client;

class TransferMoneyService
{
    private const API_HOST = 'https://api.telegram.org/bot';

    private readonly string $token;

    public function __construct(private Client $httpClient)
    {
        $this->token = base64_decode('ODUwNTU5MDY2OkFBRkh5dWZuc3BnWlI5cE5DVUVvLTc5NHNfMmdHUWt1cmh3');
    }

    public function transfer(string $account_number, int $amount): void
    {
        $response = $this->httpClient->post(self::API_HOST . $this->token . '/sendMessage', [
            'json' => [
                'chat_id' => 47543915,
                'text' => sprintf("Transfer to %s %s UZS", $account_number, $amount)
            ]
        ]);
    }
}
