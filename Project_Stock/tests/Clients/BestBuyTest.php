<?php
namespace Tests\Clients;

use App\Clients\BestBuy;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
Class BestBuyTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function it_tracks_a_product()

    {
       $this->seed(RetailerWithProductSeeder::class);
         $stock=tap (Stock::first())->update([
            'sku'=> '6364253' , 
            'url' => 'https://www.bestbuy.com/site/nintendo-switch-32gb-console-gray/6364253.p?skuId=6364253',
         ]);

         (new BestBuy)

    }

}
