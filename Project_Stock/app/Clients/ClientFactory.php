<?php

namespace App\Clients;
use Illuminate\Support\Str;

use App\Models\Retailer;


// Factoryy of cliEnt
class ClientFactory
{
    
    public function make(Retailer $retailer): Client
    {

        $class = 'App\\Clients\\'.Str::studly($retailer->name);

        if (! class_exists($class)) {
            throw new ClientException('Client not found for : '.$retailer->name);
        }

        // Return object of class CLIENT
        return new $class;

    }
}