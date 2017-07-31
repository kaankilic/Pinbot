<?php

namespace Kaankilic\Pinbot\Api\Traits;

use Kaankilic\Pinbot\Api\Request;
use Kaankilic\Pinbot\Api\Response;

trait HandlesRequest
{
    /**
     * Executes a POST request to Pinterest API.
     *
     * @param array $requestOptions
     * @param string $resourceUrl
     *
     * @return bool
     */
    abstract protected function post(array $requestOptions = [], $resourceUrl);

    /**
     * Executes a GET request to Pinterest API.
     *
     * @param array $requestOptions
     * @param string $resourceUrl
     * @return bool|array
     */
    abstract protected function get(array $requestOptions = [], $resourceUrl = '');

    /**
     * @return Response
     */
    abstract public function getResponse();

    /**
     * @return Request
     */
    abstract public function getRequest();
}
