<?php

namespace App\Clients;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {

        $results = Http::get($this->endpoint($stock->sku))->json();
        dd($results);

        // intercept the requests to see the results
        //

        $product = $results['products'][0] ?? [];

        return new StockStatus(
            $product['onlineAvailability'] ?? false,
            (int) $product['salePrice'] * 100 // $->c
        );
    }

    protected function endpoint($sku)
    {
        $key = config('services.clients.bestbuy.key');

        return "https://api.bestbuy.com/v1/products(sku={$sku})?apiKey={$key}&format=json";
    }
}