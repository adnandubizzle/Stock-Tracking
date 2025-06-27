<?php

namespace Tests\Unit;

use App\Clients\ClientException;
use App\Models\Retailer;
use App\Models\Stock;
use Database\Seeders\RetailerWithProduct;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase; 

class StockTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_throws_an_exception_when_client_does_not_exist()
    {
        $this->seed(RetailerWithProductSeeder::class);

        Retailer::first()->update([
            'name' => 'Foo Retailer',
        ]);

        $this->expectException(ClientException::class);

        Stock::first()->track();
    }

    /** @test */
    public function it_updates_loal_stock_status_after_being_tracked()
    {

        $this->seed(RetailerWithProductSeeder::class);

        $this->mockClientRequest($available = true, $price = 29999);

        $stock = tap(Stock::first())->track();

        $this->assertTrue($stock->in_stock);
        $this->assertEquals(29999, $stock->price);

    }
}