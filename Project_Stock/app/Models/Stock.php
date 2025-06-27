<?php

namespace App\Models;
use App\UseCases\TrackStock;

use App\Clients\BestBuy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\Http;

class Stock extends Model
{
        use HasFactory;

    protected $table = 'stock';


    protected $casts = [
        'in_stock' => 'boolean',
    ];

    
   

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
     public function track()
    {
        (new TrackStock($this))->handle();

    }

}
