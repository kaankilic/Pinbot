<?php

namespace Kaankilic\Pinbot\Api\Providers;

use Kaankilic\Pinbot\Helpers\Pagination;
use Kaankilic\Pinbot\Helpers\UrlBuilder;
use Kaankilic\Pinbot\Api\Traits\HasRelatedTopics;
use Kaankilic\Pinbot\Api\Providers\Core\FollowableProvider;

class Topics extends FollowableProvider
{
    use HasRelatedTopics;

    protected $followUrl   = UrlBuilder::RESOURCE_FOLLOW_INTEREST;
    protected $unFollowUrl = UrlBuilder::RESOURCE_UNFOLLOW_INTEREST;

    protected $entityIdName = 'interest_id';

    /**
     * Get category info
     *
     * @param string $topic
     * @return array|bool
     */
    public function info($topic)
    {
        return $this->get(["interest" => $topic], UrlBuilder::RESOURCE_GET_TOPIC);
    }

    /**
     * Returns a feed of pins.
     *
     * @param string $interest
     * @param int $limit
     * @return Pagination
     */
    public function pins($interest, $limit = Pagination::DEFAULT_LIMIT)
    {
        $data = [
            'interest'  => $interest,
            'pins_only' => false,
        ];

        return $this->paginate($data, UrlBuilder::RESOURCE_GET_TOPIC_FEED, $limit);
    }

    /**
     * Returns an array of trending topics from http://pinterest.com/discover page. Then
     * you can use an id of each topic to get trending pins for this topic with
     * $bot->pins->explore() method.
     *
     * @return array
     */
    public function explore()
    {
        $data = [
            "aux_fields" => [],
            "offset"     => 180,
        ];

        return $this->get($data, UrlBuilder::RESOURCE_EXPLORE_SECTIONS);
    }
}