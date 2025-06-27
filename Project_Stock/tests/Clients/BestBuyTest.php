<?php

namespace Tests\Clients;

use App\Clients\BestBuy;
use App\Clients\Client;
use App\Models\Stock;
use Database\Seeders\RetailerWithProductSeeder;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


//if we use command like vendor/pin/phpunit --exclude-group-api , it will run all tests except the ones marked with this group 
/** @group api */


class BestBuyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tracks_a_product()
    {
        // given i have a product , with stock at best buy
        // if i use the best buy client to track that stock , it should return an appropriate stock status

        // seed the data
        $this->seed(RetailerWithProductSeeder::class);

        $stock = tap(Stock::first())->update([
            'sku' => '6470923',
            // sku is taken from best buy website, this sku is for nintendo switch

            'url' => 'https://www.bestbuy.com/site/switch-oled-model-w-joy-con-nintendo-switch-oled-model/6470923.p?skuId=6470923',
        ]);

        try {
            $stockStatus = (new BestBuy)->checkAvailability($stock);
        } catch (Exception $e) {
            $this->fail('failed to track API of BB');

        }

    }
}