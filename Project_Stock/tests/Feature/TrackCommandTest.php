<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ImportantStockUpdate;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Mockery;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
        $this->seed(RetailerWithProductSeeder::class);

    }

    /** @test */
    public function it_tracks_product_stock()
    {

        $this->assertFalse(Product::first()->inStock());

        $this->mockClientRequest($available = true, $price = 29900);
        $this->artisan('track');
        $this->assertTrue(Product::first()->inStock());

    }

    /** @test */
    public function it_notifies_the_user_when_stock_available()
    {

        $this->mockClientRequest($available = true, $price = 29900);
        $this->artisan('track');

        Notification::assertSentTo(User::first(), ImportantStockUpdate::class);
    }

    /** @test */
    // public function it_does_not_notify_the_user_when_stock_available()
    // {

    //     $this->mockClientRequest($available = false, $price = 29999);

    //     $this->artisan('track');

    //     Notification::assertNothingSent();
    // }
}