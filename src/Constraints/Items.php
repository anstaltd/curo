<?php

namespace Ansta\Curo\Constraints;

/**
 * Class Items
 * @package Ansta\Curo\Constraints
 */
Class Items extends Constraint
{

    /**
     * @return array
     */
    public function getItems()
    {

        foreach($this->data as &$item) {

            $item = new Item($item);
            $item = $item->toArray();

        }

        return $this->data;

    }

}
