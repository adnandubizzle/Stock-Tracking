<?php

namespace App\Clients;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {
        $results = Http::get($this->endPoint($stock->sku))->json();

        //fail safe of false and 100 in onlineAvailibility and salePrice respectively.
        return new StockStatus(
            $results['onlineAvailability'] ?? false,
            (int) (($results['salePrice'] ?? 0) * 100)
        );
    }


    // Dynamic fetching of the product with the supplied SKU in params.
    protected function endPoint($sku): string
    {
        $apiKey = config('services.clients.bestBuy.key');

        return "https://api.bestbuy.com/v1/products/{$sku}.json?apiKey={$apiKey}";
    }
}

//the End
