<?php

namespace Ansta\Curo\Constraints;

/**
 * Class Constraint
 * @package Ansta\Curo\Constraints
 */
Abstract Class Constraint
{

    /**
     * @var array
     */
    public $data = [];

    /**
     * Constraint constructor.
     * @param array $data
     */
    public function __construct(Array $data = [])
    {

        $this->data = $data;

    }

    /**
     * @param $param
     * @param $value
     * @return mixed
     */
    public function __set($param, $value)
    {

        return $this->data[$param] = $value;

    }

    /**
     * @param $param
     * @return mixed|null
     */
    public function __get($param)
    {

        if (method_exists($this, 'get'.ucfirst($param))) {
            return $this->{'get'.ucfirst($param)}(isset($this->data[$param]) ? $this->data[$param] : null);
        }

        return in_array($param, array_keys($this->data)) ? $this->data[$param] : null;

    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

}
