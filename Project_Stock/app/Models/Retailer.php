<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Retailer extends Model
// {
//     public function stock(Product $product, Stock $stock)
//     {
//         return $this->hasMany(Stock::class);
//     }

//     public function addStock(Product $product, Stock $stock)
//     {
//         $stock->product_id = $product->id;

//         $this->stock($product, $stock)->save($stock);
//     }
// }







namespace App\Models;

use App\Clients\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
        use HasFactory;

    public function addStock(Product $product, Stock $stock)
    {
        $stock->product_id = $product->id;

        // it should add all attributes of stock to the model
        $this->stock()->save($stock);

    }


    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    // client creation.
    public function client()
    {

        return (new ClientFactory)->make($this); 
;
    }
}
