<?php

namespace Tests;

use App\Clients\StockStatus;
use \App\Clients\ClientFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
protected function mockClientRequest($available, $price)
{
    $this->mock(\App\Clients\ClientFactory::class, function ($mock) use ($available, $price) {
        $mock->shouldReceive('make')
             ->andReturn(new \App\Clients\StockStatus($available, $price));
    });
}

}
