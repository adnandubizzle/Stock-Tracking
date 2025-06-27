<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    public function stock(Product $product, Stock $stock)
    {
        return $this->hasMany(Stock::class);
    }

    public function addStock(Product $product, Stock $stock)
    {
        $stock->product_id = $product->id;

        $this->stock($product, $stock)->save($stock);
    }
}
