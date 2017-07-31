<?php

namespace Kaankilic\Pinbot\Tests\Bot;

use PHPUnit\Framework\TestCase;
use Kaankilic\Pinbot\Api\Traits\SendsMessages;
use Kaankilic\Pinbot\Exceptions\InvalidRequest;

/**
 * Class RequestTest.
 */
class SendsMessagesTest extends TestCase
{
    /** @test */
    public function it_doesnt_allow_to_send_messages_without_specifying_emails_or_users()
    {
        $this->setExpectedException(InvalidRequest::class);
        /** @var SendsMessages $object */
        $object = $this->getMockForTrait(SendsMessages::class);

        $object
            ->expects($this->any())
             ->method('post');

        $object->send(1, 'message', [], []);
    }
}
