<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class RetailerWithProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


     // it adds dummy data for Product, Retailer and Stock
     // and calls addStock() with product and stock as its parameters to add DUMMY Stock.
    public function run(): void
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);
        $best_buy = Retailer::create(['name' => 'Best Buy']);

        $stock = new Stock([
            'price' => 10000,
            'url' => 'http://foo.com',
            'sku' => '6522225',
            'in_stock' => false,

        ]);
        User::factory()->create(['email' => 'jeffery@example.com']);

        $best_buy->addStock($switch, $stock);
    }
}