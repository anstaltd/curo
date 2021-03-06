<?php

namespace Ansta\Curo;

/**
 * Class Currency
 * @package Ansta\Curo
 */
class Currency {

    /**
     * Constants for Currency types
     */
    const GBP = 1;
    const EUR = 2;
    const USD = 3;

    public static $names = [
        self::GBP => 'Pounds',
        self::EUR => 'Euros',
        self::USD => 'Dollars',
    ];

    public static $symbols = [
        self::GBP => '£',
        self::EUR => '€',
        self::USD => '$',
    ];

    public static $currencyId = [
        self::GBP => 'GBP',
        self::EUR => 'EUR',
        self::USD => 'USD',
    ];

}
