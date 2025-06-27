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
        if ($this->retailer->name === 'Best Buy') {
        
            $results=(new BestBuy ())->checkAvailibility($this);
            
        }


//TARGET

    //   if ($this->retailer->name === 'Target') {


    //     $results=(new Target ())->checkAvailibility($this);
            
    //     }
        $this->update([
            'in_stock' => $results['available'],
            'price' => $results['price'],
        ]);

    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }


}
