<?php

namespace Tests\Unit;

use App\Clients\Client;
use App\Clients\ClientException;
use App\Clients\StockStatus;
use App\Models\Retailer;
use App\Models\Stock;
use Database\Seeders\RetailerWithProductSeeder;
use Exception;
use App\Clients\ClientFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class StockTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    public function it_throws_an_exception_if_client_not_found_when_tracking()
    {
        // given i have a retialer with stock
        // if i track that stock but retialer doesnt have the client class for that stock ( non existent basically )
        // the function throws an exception
        $this->seed(RetailerWithProductSeeder::class);

        Retailer::first()->update(['name' => 'Foo retialer ']);

        $this->expectException(ClientException::class);
        // track the stock
        Stock::first()->track();

    }

    /** @test */
    public function it_updates_local_stock_status_after_being_tracked()
    {
        $this->seed(RetailerWithProductSeeder::class);

        // uses the client factory to determine the appropirate cline

        // check availability call

        // create a fake client for testing purposes

        // mockes can be used to create fake client


        $clientMock=Mockery::mock(Client::class);
        $clientMock->shouldReceive('checkAvailibility')->andReturn(new StockStatus($available=true, $price=9900));


        // tap is a laravel helper function
        $stock = tap(Stock::first())->track();

        $this->assertTrue($stock->in_stock);
        $this->assertEquals(9900, $stock->price);

    }
}

class fakeClient implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {
        return new StockStatus($available=true, $price=9900);
    }
}