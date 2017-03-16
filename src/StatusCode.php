<?php

namespace Ansta\Curo;

class StatusCode {

    const PROGRESS = 0;
    const AUTHORISED_SUCCESS = 1;
    const D_SECURE_Y_WAITING = 2;
    const D_SECURE_N = 3;
    const D_SECURE_U = 4;
    const D_SECURE_E = 5;
    const TRANSACTION_SUCCESS = 6;
    const RECURRING_SUCCESS = 7;
    const TRANSACTION_FAILED = 8;
    const TRANSACTION_FAILED_FRAUD = 9;
    const TRANSACTION_REJECTED = 10;
    const TRANSACTION_EXPIRED = 11;
    const TRANSACTION_CANCELED = 12;
    const RECURRING_FAILED = 13;
    const AUTHORISATION_FAILED = 14;
    const TRANSACTION_3D_TIME_OUT = 15;
    const TRANSACTION_3D_NOT_ALLOWED = 16;
    const TRANSACTION_3DS_FAILED_VERIFICATION = 17;
    const WAIT_TIME_EXPIRED = 18;
    const REFUND_TO_CUSTOMER = 19;
    const TRANSACTION_NEVER_RECEIVED = 20;
    const CHARGEBACK_BY_CUSTOMER = 21;
    const CHARGEBACK_2ND_ATTEMPT = 22;
    const AUTHORISATION_CANCELED = 23;
    const FRAUD_FROM_BANK = 24;
    const RETRIEVAL_FROM_BANK = 25;
    const TRANSACTION_AWAITING_USER_ACTION = 26;
    const TRANSACTION_AWAITING_CAPTURE = 27;
    const RECURRING_AWAITING_CONFIRMATION = 28;
    const EXTERNAL_CONFIRMATION = 29;

    public static $status = [
        self::PROGRESS => 0,
        self::AUTHORISED_SUCCESS => 100,
        self::D_SECURE_Y_WAITING => 150,
        self::D_SECURE_N => 152,
        self::D_SECURE_U => 154,
        self::D_SECURE_E => 156,
        self::TRANSACTION_SUCCESS => 200,
        self::RECURRING_SUCCESS => 210,
        self::TRANSACTION_FAILED => 300,
        self::TRANSACTION_FAILED_FRAUD => 301,
        self::TRANSACTION_REJECTED => 302,
        self::TRANSACTION_EXPIRED => 308,
        self::TRANSACTION_CANCELED => 309,
        self::RECURRING_FAILED => 310,
        self::AUTHORISATION_FAILED => 330,
        self::TRANSACTION_3D_TIME_OUT => 350,
        self::TRANSACTION_3D_NOT_ALLOWED => 351,
        self::TRANSACTION_3DS_FAILED_VERIFICATION => 352,
        self::WAIT_TIME_EXPIRED => 370,
        self::REFUND_TO_CUSTOMER => 400,
        self::TRANSACTION_NEVER_RECEIVED => 404,
        self::CHARGEBACK_BY_CUSTOMER => 410,
        self::CHARGEBACK_2ND_ATTEMPT => 420,
        self::AUTHORISATION_CANCELED => 450,
        self::FRAUD_FROM_BANK => 601,
        self::RETRIEVAL_FROM_BANK => 604,
        self::TRANSACTION_AWAITING_USER_ACTION => 700,
        self::TRANSACTION_AWAITING_CAPTURE => 701,
        self::RECURRING_AWAITING_CONFIRMATION => 710,
        self::EXTERNAL_CONFIRMATION => 750,
    ];

    public static $description = [
        self::PROGRESS => 'Transaction in progress',
        self::AUTHORISED_SUCCESS => 'Authorization successful',
        self::D_SECURE_Y_WAITING => '3D secure status \'Y\' (yes), waiting for 3D secure authentication',
        self::D_SECURE_N => '3D secure status \'N\' (no)',
        self::D_SECURE_U => '3D secure status \'U\' (unknown)',
        self::D_SECURE_E => '3D secure status \'E\' (error)',
        self::TRANSACTION_SUCCESS => 'Transaction successful',
        self::RECURRING_SUCCESS => 'Recurring transaction successful',
        self::TRANSACTION_FAILED => 'Transaction failed',
        self::TRANSACTION_FAILED_FRAUD => 'Transaction failed due to anti fraud system',
        self::TRANSACTION_REJECTED => 'Transaction rejected',
        self::TRANSACTION_EXPIRED => 'Transaction was expired',
        self::TRANSACTION_CANCELED => 'Transaction was cancelled',
        self::RECURRING_FAILED => 'Recurring transaction failed',
        self::AUTHORISATION_FAILED => 'Authorization failed',
        self::TRANSACTION_3D_TIME_OUT => 'Transaction failed, time out for 3D secure authentication',
        self::TRANSACTION_3D_NOT_ALLOWED => 'Transaction failed, non-3DS transactions are not allowed',
        self::TRANSACTION_3DS_FAILED_VERIFICATION => 'Transaction failed 3DS verification',
        self::WAIT_TIME_EXPIRED => 'Wait time expired',
        self::REFUND_TO_CUSTOMER => 'Refund to consumer',
        self::TRANSACTION_NEVER_RECEIVED => 'Reversal by system (transaction was never received)',
        self::CHARGEBACK_BY_CUSTOMER => 'Chargeback by consumer',
        self::CHARGEBACK_2ND_ATTEMPT => 'Chargeback (2nd attempt)',
        self::AUTHORISATION_CANCELED => 'Authorization cancelled',
        self::FRAUD_FROM_BANK => 'Fraud notification received from bank',
        self::RETRIEVAL_FROM_BANK => 'Retrieval notification received from bank',
        self::TRANSACTION_AWAITING_USER_ACTION => 'Transaction is waiting for user action',
        self::TRANSACTION_AWAITING_CAPTURE => 'Waiting for capture',
        self::RECURRING_AWAITING_CONFIRMATION => 'Waiting for confirmation recurring',
        self::EXTERNAL_CONFIRMATION => 'Waiting for confirmation (from external party like a bank)',
    ];

}
