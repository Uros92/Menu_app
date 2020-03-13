<?php

namespace App\ExchangeRate;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class ExchangeRate {

    const SERVICE_CLIENT = 'http://api.currencylayer.com/live?';
    const ACCESS_KEY = '0eea08dbc3e1b49e52597bcd2d86b61b';
    const CURRENCIES = 'JPY,GBP,EUR';


    /**
     * Send get request to service and get currency exchange rates
     *
     * @return bool
     */
    public static function exchangeRates(): bool
    {
        $client = new Client();
        $result = $client->get(self::SERVICE_CLIENT . "access_key=" . self::ACCESS_KEY . "&currencies=" . self::CURRENCIES);

        if($result->getStatusCode() === 200) {
            $exchange_rates = json_decode($result->getBody()->getContents())->quotes;

            $instance = new self();
            // store in database
            return $instance->updateExchangeRates($exchange_rates);
        }

        return false;
    }

    /**
     * Update currency exchange rates
     *
     * @param object $exchange_rates
     *
     * @return bool
     */
    protected function updateExchangeRates(object $exchange_rates): bool
    {
        $currencies = [
            [ 'id' => 1, 'exchange_rate' => $exchange_rates->USDJPY ],
            [ 'id' => 2, 'exchange_rate' => $exchange_rates->USDGBP ],
            [ 'id' => 3, 'exchange_rate' => $exchange_rates->USDEUR ],
        ];

        foreach ($currencies as $currency) {

            DB::table('currencies')
                ->where('id', $currency['id'])
                ->update(['exchange_rate' => $currency['exchange_rate']]);

        };

        return true;
    }
}
