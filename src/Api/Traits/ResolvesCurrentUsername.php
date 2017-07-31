<?php

namespace Kaankilic\Pinbot\Api\Traits;

use Kaankilic\Pinbot\Api\Providers\User;
use Kaankilic\Pinbot\Api\ProvidersContainer;

/**
 * @property ProvidersContainer container
 */
trait ResolvesCurrentUsername
{
    protected function resolveCurrentUsername()
    {
        /** @var User $userProvider */
        $userProvider = $this->container->getProvider('user');

        return $userProvider->username();
    }
}