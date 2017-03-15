<?php

namespace Ansta\Curo\Constraints;

Class Customer extends Constraint
{

    public function getIp()
    {
        //Could do some fancy stuff to check for the true IP?
        return $_SERVER['REMOTE_ADDR'];
    }

}
