<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    
        use HasFactory;
    public function track()
    {
        $this->stock->each->track();
    }

    public function inStock()
    {
        return $this->stock()->where('in_stock', true)->exists();
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
        public function histories()
    {
        return $this->hasMany(\App\Models\History::class);

    }
}
