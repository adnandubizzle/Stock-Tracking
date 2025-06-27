<?php

namespace Tests\Unit;

use App\Models\Product;
use Database\Seeders\RetailerWithProduct;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductHistoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_records_product_history()
    {

        $this->seed(RetailerWithProductSeeder::class);

        $this->mockClientRequest($available = true, $price = 29999);
        $product = Product::first();

        $this->assertCount(0, $product->histories);
        $product->track();

        $this->assertCount(1, $product->refresh()->histories);

        $history = $product->histories->first();

        $this->assertEquals($price, $history->price);
        $this->assertEquals($available, $history->in_stock);
        $this->assertEquals($product->id, $history->product_id);
        $this->assertEquals($product->stock[0]->id, $history->stock_id);

    }
}