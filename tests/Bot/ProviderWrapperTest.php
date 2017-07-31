<?php

namespace Kaankilic\Pinbot\Tests\Bot;

use PHPUnit\Framework\TestCase;
use Kaankilic\Pinbot\Api\Request;
use Kaankilic\Pinbot\Api\Response;
use Kaankilic\Pinbot\Helpers\Cookies;
use Kaankilic\Pinbot\Api\CurlHttpClient;
use Kaankilic\Pinbot\Api\ProvidersContainer;
use Kaankilic\Pinbot\Api\Providers\Core\Provider;
use Kaankilic\Pinbot\Api\Providers\Core\ProviderWrapper;

class ProviderWrapperTest extends TestCase
{
    /**
     * For not logged in request.
     *
     * @test
     * @expectedException \Kaankilic\Pinbot\Exceptions\AuthRequired
     */
    public function it_should_fail_when_login_is_required()
    {
        $wrapper = $this->createWrapper();
        $wrapper->testFail();
    }

    /** @test */
    public function it_should_call_provider_method()
    {
        $wrapper = $this->createWrapper();
        $this->assertEquals('success', $wrapper->testSuccess());
    }

    /**
     * @test
     * @expectedException \Kaankilic\Pinbot\Exceptions\InvalidRequest
     */
    public function it_should_throw_exception_when_calling_non_existed_method()
    {
        $this->createWrapper()->badMethod();
    }

    /**
     * @return ProviderWrapper
     */
    protected function createWrapper()
    {
        $request = new Request(new CurlHttpClient(new Cookies()));

        $provider = new TestProvider(new ProvidersContainer($request, new Response()));

        return new ProviderWrapper($provider);
    }
}

/**
 * Dummy Class TestProvider
 */
class TestProvider extends Provider
{
    /**
     * @var array
     */
    protected $loginRequiredFor = ['testFail'];

    public function testFail()
    {
        return 'exception';
    }

    public function testSuccess()
    {
        return 'success';
    }
}
