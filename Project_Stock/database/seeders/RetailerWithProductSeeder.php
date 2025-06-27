<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;

class RetailerWithProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $switch = Product::create(['name' => 'Nintendo Switch']);
        $bestBuy = Retailer::create(['name' => 'Best Buy']);

        $stock = new Stock([
            'price' => 1000,
            'url' => 'http://foo.com',
            'sku' => '12345',
            'in_stock' => false,
        ]);

        $bestBuy->addStock($switch, $stock);

    }
}
