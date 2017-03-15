<?php

namespace Ansta\Curo;

class PaymentMethods {

    const AFTERPAY = 1;
    const BANCONTACT = 2;
    const BANK_TRANSFER = 3;
    const BITCOIN = 4;
    const CAPAYABLE = 5;
    const CREDIT_CARD = 6;
    const DIRECT_DEBIT = 7;
    const EPS = 8;
    const GIROPAY = 9;
    const IDEAL = 10;
    const KLARNA = 11;
    const PAYPAL = 12;
    const PAYSAFECARD = 13;
    const PRZELEWY24 = 14;
    const SOFORTBANKING = 15;


    public static $extension = [
        self::AFTERPAY => 'afterpay',
        self::BANCONTACT => 'bancontact',
        self::BANK_TRANSFER => 'banktransfer',
        self::BITCOIN => 'bitcoin',
        self::CAPAYABLE => 'capayable',
        self::CREDIT_CARD => 'creditcard',
        self::DIRECT_DEBIT => 'directdebit',
        self::EPS => 'eps',
        self::GIROPAY => 'giropay',
        self::IDEAL => 'ideal',
        self::KLARNA => 'klarna',
        self::PAYPAL => 'paypal',
        self::PAYSAFECARD => 'paysafecard',
        self::PRZELEWY24 => 'przelewy24',
        self::SOFORTBANKING => 'sofortbanking',
    ];

    public static $names = [
        self::AFTERPAY => 'Afterpay',
        self::BANCONTACT => 'Bancontact',
        self::BANK_TRANSFER => 'Bank Transfer',
        self::BITCOIN => 'bitcoin',
        self::CAPAYABLE => 'Capayable',
        self::CREDIT_CARD => 'Credit Card',
        self::DIRECT_DEBIT => 'Debit Card',
        self::EPS => 'EPS',
        self::GIROPAY => 'Giropay',
        self::IDEAL => 'iDEAL',
        self::KLARNA => 'Klarna',
        self::PAYPAL => 'PayPal',
        self::PAYSAFECARD => 'Paysafecard',
        self::PRZELEWY24 => 'Przelewy24',
        self::SOFORTBANKING => 'SOFORTbanking',
    ];

}
