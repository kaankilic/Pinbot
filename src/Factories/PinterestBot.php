<?php

namespace Kaankilic\Pinbot\Factories;

use Kaankilic\Pinbot\Api\Request;
use Kaankilic\Pinbot\Api\Response;
use Kaankilic\Pinbot\Helpers\Cookies;
use Kaankilic\Pinbot\Api\CurlHttpClient;
use Kaankilic\Pinbot\Api\ProvidersContainer;

class PinterestBot
{
    /**
     * Initializes Bot instance and all its dependencies.
     *
     * @return ProvidersContainer
     */
    public static function create()
    {
        $request = self::makeRequest();
        $response = self::makeResponse();

        return self::buildProvidersContainer($request, $response);
    }

    /**
     * @return Request
     */
    protected static function makeRequest()
    {
        $httpClient = self::buildHttpClient();

        return new Request($httpClient);
    }

    /**
     * @return Response
     */
    protected static function makeResponse()
    {
        return new Response();
    }

    /**
     * @return CurlHttpClient
     */
    protected static function buildHttpClient()
    {
        return new CurlHttpClient(new Cookies());
    }

    /**
     * @param $request
     * @param $response
     * @return ProvidersContainer
     */
    protected static function buildProvidersContainer(Request $request, Response $response)
    {
        return new ProvidersContainer($request, $response);
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
