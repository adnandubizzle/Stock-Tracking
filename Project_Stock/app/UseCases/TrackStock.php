<?php

namespace App\UseCases;

use App\Clients\StockStatus;
use App\Models\History;
use App\Models\Stock;
use App\Models\User;
use App\Notifications\ImportantStockUpdate;

class TrackStock
{
    protected Stock $stock;

    protected StockStatus $stock_status;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }


    //cleaner Approach
    public function handle()
    {

        $this->checkAvailability();
        $this->notifyUser();
        $this->refreshStock();
        $this->recordToHistory();

    }

    protected function checkAvailability()
    {
        $this->stock_status = $this->stock
            ->retailer
            ->client()
            ->checkAvailability($this->stock);
    }

    protected function notifyUser()
    {
        if (! $this->stock->in_stock && $this->stock_status->available) {
            User::first()->notify(new ImportantStockUpdate($this->stock));
        }
    }

    protected function refreshStock()
    {
        $this->stock->update([
            'in_stock' => $this->stock_status->available,
            'price' => $this->stock_status->price,
        ]);
    }

    protected function recordToHistory()
    {
        History::create([
            'price' => $this->stock->price,
            'in_stock' => $this->stock->in_stock,
            'product_id' => $this->stock->product_id,
            'stock_id' => $this->stock->id,
        ]);

    }
}

