<?php

namespace Ansta\Curo\Constraints;

/**
 * Class Transaction
 * @package Ansta\Curo\Constraints
 */
Class Transaction extends Constraint
{
    /**
     * Transaction constructor.
     * @param array $data
     */
    public function __construct(Array $data = [])
    {

        $this->data = $data['payment'];

    }

    /**
     * @return array
     */
    public function getCaptureArray()
    {

        return  [
            'transaction_id' => $this->transaction_id,
        ];

    }

    /**
     * @param $value
     * @return null
     */
    public function getRedirect_url($value)
    {
        return isset($this->data['url']) ? $this->data['url'] : null;
    }
}
