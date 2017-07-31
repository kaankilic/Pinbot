<?php

namespace Kaankilic\Pinbot\Api\Providers\Core;

/**
 * Class EntityProvider
 * @package Kaankilic\Pinbot\Api\Providers
 *
 * @property string entityIdName
 */
abstract class EntityProvider extends Provider
{
    /**
     * @var string
     */
    protected $entityIdName;

    /**
     * @return string
     */
    public function getEntityIdName()
    {
        return property_exists($this, 'entityIdName') ? $this->entityIdName : '';
    }
}