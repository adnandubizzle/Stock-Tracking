<?php

namespace App\Clients;

use App\Models\Stock;

class Target implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {
            return new StockStatus($this->$stock()->in_stock,$this->$stock->price); 
//Not needed above line

    }
}


