<?php

namespace Tests\Unit\Services;

use App\Services\GetInfoService;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class GetInfoServiceTest extends TestCase
{
    private $service;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->service = new GetInfoService();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetInfo()
    {
        $plots = Str::random(32);
        $result = $this->service->getInfo($plots);
        $item = $result->last();

        $this->assertEquals('69:27:0000022:1307', $item->cadastral_number);
    }
}
