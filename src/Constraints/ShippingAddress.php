<?php

namespace Ansta\Curo\Constraints;

/**
 * Class ShippingAddress
 * @package Ansta\Curo\Constraints
 */
class ShippingAddress extends Constraint
{

    /**
     * @param $value
     * @return null
     */
    public function getPostcode($value)
    {
        return isset($this->data['postcode']) ? $this->data['postcode'] : (isset($this->data['zipcode']) ? $this->data['zipcode'] : null);
    }

    /**
     * @param $value
     * @return null
     */
    public function getZipcode($value)
    {
        return $this->getPostcode($value);
    }

}
