<?php

namespace App\Clients;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {
        $results = Http::get($this->endPoint($stock->sku))->json();

        // Safe access using null coalescing to avoid errors on missing keys
        return new StockStatus(
            $results['onlineAvailability'] ?? false,
            (int) (($results['salePrice'] ?? 0) * 100)
        );
    }

    protected function endPoint($sku): string
    {
        $apiKey = config('services.clients.bestBuy.key');

        return "https://api.bestbuy.com/v1/products/{$sku}.json?apiKey={$apiKey}";
    }
}
