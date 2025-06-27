<?php

namespace App\Clients;

class StockStatus
{
 
    public $available;

    public $price;

    
//Constructor inn php
    public function __construct($available, $price)
    {
        $this->available = $available;
        $this->price = $price;

    }
}