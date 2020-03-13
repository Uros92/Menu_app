<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class CurrenciesApiTest extends TestCase
{
    /**
     * Test external api call for currencies exchange rates
     *
     * @return void
     */
    public function testExternalApiForCurrenciesExchangeRates()
    {
        $client = new Client();
        $response = $client->get('http://api.currencylayer.com/live?access_key=0eea08dbc3e1b49e52597bcd2d86b61b&currencies=JPY,GBP,EUR');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertStringContainsString('quotes', $response->getBody()->getContents());
    }
}
