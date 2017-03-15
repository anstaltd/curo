<?php

namespace Ansta\Curo\Constraints;

class BillingAddress extends Constraint
{
    public function getPostcode($value)
    {
        return isset($this->data['postcode']) ? $this->data['postcode'] : (isset($this->data['zipcode']) ? $this->data['zipcode'] : null);
    }

    public function getZipcode($value)
    {
        return $this->getPostcode($value);
    }
}
