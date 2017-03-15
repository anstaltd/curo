<?php

namespace Ansta\Curo\Constraints;

Class Transaction extends Constraint
{
    public function __construct(Array $data = [])
    {

        $this->data = $data['payment'];

    }

    public function getCaptureArray()
    {

        return  [
            'transaction_id' => $this->transaction_id,
        ];

    }

    public function getRedirect_url($value) {
        return isset($this->data['url']) ? $this->data['url'] : null;
    }
}
