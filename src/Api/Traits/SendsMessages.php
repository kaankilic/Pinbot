<?php

namespace Kaankilic\Pinbot\Api\Traits;

use Kaankilic\Pinbot\Helpers\UrlBuilder;
use Kaankilic\Pinbot\Exceptions\InvalidRequest;

/**
 * Trait SendsMessages
 *
 * @property string $messageEntityName
 *
 * @package Kaankilic\Pinbot\Api\Traits
 */
trait SendsMessages
{
    use HandlesRequest;

    protected function requiresLoginForSendsMessages()
    {
        return [
            'send',
            'sendWithMessage',
            'sendWithEmail',
        ];
    }

    /**
     * @param array|string $userIds
     * @param array|string $emails
     *
     * @param array $data
     * @return bool
     */
    protected function callSendMessage($userIds, $emails, array $data)
    {
        $userIds = is_array($userIds) ? $userIds : [$userIds];
        $emails = is_array($emails) ? $emails : [$emails];

        $this->guardAgainstEmptyData($userIds, $emails);

        $requestOptions = array_merge([
                'emails'   => $emails,
                'user_ids' => $userIds,
            ],
            $data);

        return $this->post($requestOptions, UrlBuilder::RESOURCE_SEND_MESSAGE);
    }

    /**
     * @param string $text
     * @param string $entityId
     * @return array
     */
    protected function buildMessageData($text = null, $entityId = null)
    {
        $entityName = $this->getMessageEntityName();

        return [
            $entityName => $entityId,
            'text'      => $text,
        ];
    }

    /**
     * Send item with message or by email.
     *
     * @param string $entityId
     * @param string $text
     * @param array|string $userIds
     * @param array|string $emails
     * @return bool
     */
    public function send($entityId, $text, $userIds, $emails)
    {
        $messageData = $this->buildMessageData($text, $entityId);

        return $this->callSendMessage($userIds, $emails, $messageData);
    }

    /**
     * Send item with messages.
     * @param int $entityId
     * @param string $text
     * @param array|string $userIds
     * @return bool
     */
    public function sendWithMessage($entityId, $text, $userIds)
    {
        return $this->send($entityId, $text, $userIds, []);
    }

    /**
     * Send entity with emails.
     *
     * @param int $entityId
     * @param string $text
     * @param array|string $emails
     * @return bool
     */
    public function sendWithEmail($entityId, $text, $emails)
    {
        return $this->send($entityId, $text, [], $emails);
    }

    /**
     * @return string
     */
    protected function getMessageEntityName()
    {
        return property_exists($this, 'messageEntityName') ? $this->messageEntityName : '';
    }

    /**
     * @param array $userIds
     * @param array $emails
     * @throws InvalidRequest
     */
    protected function guardAgainstEmptyData(array $userIds, array $emails)
    {
        if (empty($userIds) && empty($emails)) {
            throw new InvalidRequest('You must specify user_ids or emails to send message.');
        }
    }
}