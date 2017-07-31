<?php

namespace Kaankilic\Pinbot\Api\Forms;

abstract class Form
{
    /**
     * @return array
     */
    abstract protected function getData();

    /**
     * @return array
     */
    public function toArray()
    {
        return array_filter($this->getData(), function ($item) {
            return !is_null($item);
        });
    }
}