<?php

namespace Tests\Integration;

use App\Models\Stock;
use App\Models\User;
use App\Notifications\ImportantStockUpdate;
use App\UseCases\TrackStock;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TrackStockTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_notifies_the_user()
    {

        Notification::fake();
        $this->mockClientRequest(true, 29900);
        $this->seed(RetailerWithProductSeeder::class);

        (new TrackStock(Stock::first()))->handle();
        $user = User::find(1);
        Notification::assertSentTo($user, ImportantStockUpdate::class);

    }

    /** @test */
    public function refresh_stock()
    {

        Notification::fake();
        $this->mockClientRequest(true, 24900);
        $this->seed(RetailerWithProductSeeder::class);

        (new TrackStock(Stock::first()))->handle();

        tap(Stock::first(), function ($stock) {
            $this->assertEquals(29999, $stock->price);
            $this->assertTrue($stock->in_stock);
        });

    }
}
