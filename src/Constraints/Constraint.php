<?php

namespace Ansta\Curo\Constraints;

Abstract Class Constraint
{

    public $data = [];

    public function __construct(Array $data = [])
    {

        $this->data = $data;

    }

    public function __set($param, $value)
    {

        return $this->data[$param] = $value;

    }

    public function __get($param)
    {

        if (method_exists($this, 'get'.ucfirst($param))) {
            return $this->{'get'.ucfirst($param)}(isset($this->data[$param]) ? $this->data[$param] : null);
        }

        return in_array($param, array_keys($this->data)) ? $this->data[$param] : null;

    }

    public function toArray()
    {
        return $this->data;
    }

}
