<?php
namespace App\Clients;
use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy{

    public function checkAvailibility(Stock $stock)
    {
         $results =http::get ('http://foo.test')->json();
        return $results;
    }

}