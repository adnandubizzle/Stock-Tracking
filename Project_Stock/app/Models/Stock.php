<?php

namespace App\Models;

use App\Clients\BestBuy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    protected $table = 'stock';

    protected $casts = [
        'in_stock' => 'boolean',
    ];

    public function track()
    {

        // /hitapi endpoint at the retailer like best buy etc



        //BESTBUY
        
        $status = $this->retailer
        ->client()
        ->checkAvailability($this);
            
    


//update Db here


      $this->update([
            'in_stock' => $status->available,  
            'price' => $status->price,      
        ]);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }


}
