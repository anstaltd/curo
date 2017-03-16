<?php

namespace Ansta\Curo;

use GuzzleHttp\Client as Guzzle;

use Ansta\Curo\Constraints\ShippingAddress;
use Ansta\Curo\Constraints\Customer;
use Ansta\Curo\Constraints\Items;
use Ansta\Curo\Constraints\BillingAddress;
use Ansta\Curo\Constraints\Transaction;
use Ansta\Curo\Constraints\Order;

use Ansta\Curo\Exceptions\CuroRequiredConfig;
use Ansta\Curo\Exceptions\CuroException;
use Ansta\Curo\Exceptions\CuroCaptureFailedException;
use Psr\Http\Message\ResponseInterface;

//TODO Add get payment methods

class Curo
{

    /**
     * Constants for routes
     *
     */

    const ROUTE = 'https://secure.curopayments.net/rest/';
    const TEST_ROUTE = 'https://secure-staging.curopayments.net/rest/';

    /*
     * @var
     * testing boolean
     */

    public static $testing = false;

    /**
     * @var string
     * The required route of the request
     */
    private $route = '';

    /**
     * @var int|mixed
     * Version of API
     */
    protected $version = 1;

    /**
     * @var Guzzle
     * Guzzle
     */
    protected $guzzle;

    /**
     * @var array
     * Default set of auth params
     */
    private $auth = [];

    /**
     * @var array
     * Default set of data
     */
    protected $data = [];

    /**
     * Curo constructor.
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {

        $this->guzzle = new Guzzle();

        static::$testing = (isset($configs['testing'])) ? $configs['testing'] : true;

        if (isset($configs['version'])) {
            $this->version = $configs['version'];
        }

        $this->route = ((static::$testing) ? self::TEST_ROUTE : self::ROUTE).'v'.$this->version.'/curo/';

       $this->setConfigs($configs);

    }

    /**
     * @param $config
     * @return array|mixed
     */
    private function getConfigs($config)
    {

        return (file_exists(__DIR__.'/configs/'.$config.'.php')) ? include __DIR__.'/configs/'.$config.'.php' : [];

    }

    /**
     * @param $configs
     * @throws CuroRequiredConfig
     */
    private function setConfigs($configs)
    {

        $this->data = $this->getConfigs('defaults');

        foreach($this->getConfigs('required') as $required) {

            if(isset($configs[$required])) {
                $this->data[$required] = $configs[$required];
            } else {
                throw new CuroRequiredConfig('Please pass required config ' . $required);
            }

        }

        foreach($this->getConfigs('auth') as $auth) {

            if (isset($configs[$auth])) {
                $this->auth[$auth] = $configs[$auth];
            } else {
                throw new CuroRequiredConfig('Please pass required auth parameter' . $auth);
            }

        }

        //Override defaults

        if (isset($configs['currency_id'])) $this->data['currency_id'] = Currency::$currencyId[$configs['currency_id']];

        if (isset($configs['callback_url'])) $this->data['callback_url'] = $configs['callback_url'];

    }

    /**
     * @param Order $order
     * @param Items $items
     * @param Customer $customer
     * @param int $method
     * @param ShippingAddress|null $shippingAddress
     * @param BillingAddress|null $billingAddress
     * @return Transaction
     * @throws CuroException
     */
    public function createTransaction(
        Order $order,
        Items $items,
        Customer $customer,
        $method = PaymentMethods::CREDIT_CARD,
        ShippingAddress $shippingAddress = null,
        BillingAddress $billingAddress = null
    ) {

        $this->data['cartitems'] = $items->items;
        $this->data['amount'] = $order->amount * 100;
        $this->data['description'] = $order->description;
        $this->data['firstname'] = $customer->firstname;
        $this->data['lastname'] = $customer->lastname;
        $this->data['ip'] = $customer->ip;
        $this->data['reference'] = $order->id;
        $this->data['email'] = $customer->email;

        if ($shippingAddress) {
            $this->data['shipto_company'] = $shippingAddress->company;
            $this->data['shipto_address'] = $shippingAddress->address;
            $this->data['shipto_city'] = $shippingAddress->city;
            $this->data['shipto_state'] = $shippingAddress->state;
            $this->data['shipto_zipcode'] = $shippingAddress->postcode;
        }

        if ($billingAddress) {
            $this->data['company'] = $billingAddress->company;
            $this->data['address'] = $billingAddress->address;
            $this->data['city'] = $billingAddress->city;
            $this->data['state'] = $billingAddress->state;
            $this->data['zipcode'] = $billingAddress->postcode;
        }

        $response = $this->guzzle->request(
            'POST',
            $this->route.'payment/'.PaymentMethods::$extension[$method],
            [
                'auth' => $this->getAuth(),
                'json' => $this->data,
            ]
        );

        $body = $this->getBodyFromResponse($response);

        if ($response->getStatusCode() == 200 && $body['success'] == 1) {
            return new Transaction($body);
        }

        throw new CuroException((isset($body['error']) && isset($body['error']['message'])) ? $body['error']['message'] : 'Curo responded without an error message.');

    }

    /**
     * @param Transaction $transaction
     */
    public function captureTransaction(Transaction $transaction)
    {

        $response = $this->guzzle->request(
            'POST',
            $this->route.'capture',
            [
                'auth' => $this->getAuth(),
                'json' => $transaction->getCaptureArray(),
            ]
        );

        $body = $this->getBodyFromResponse($response);

        if ($response->getStatusCode() == 200) return true;

        else throw new CuroCaptureFailedException('Failed to capture payment: ' . (isset($body['error']) && isset($body['error']['message'])) ? $body['error']['message'] : 'Curo responded without an error message');

    }

    /**
     * @param $transactionId
     * @return Transaction
     * @throws CuroException
     */
    public function getTransaction($transactionId)
    {

        $response = $this->guzzle->request(
            'GET',
            $this->route.'transaction/'.$transactionId,
            [
                'auth' => $this->getAuth(),
            ]
        );

        $body = $this->getBodyFromResponse($response);

        if ($response->getCode() == 200) return new Transaction($response->getBody());

        else throw new CuroException(isset($body['error']) && isset($body['error']['message']) ? $body['error']['message'] : 'Curo responded without an error message.');

    }

    /**
     * @return array
     */
    private function getAuth()
    {
        return array_values($this->auth);
    }

    /**
     * @param ResponseInterface $response
     * @return array|mixed|object
     */
    private function getBodyFromResponse(ResponseInterface $response)
    {
        $rawBody = (String)$response->getBody();

        return json_decode($rawBody, true);
    }

}
