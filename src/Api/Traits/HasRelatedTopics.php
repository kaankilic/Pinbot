<?php

namespace Kaankilic\Pinbot\Api\Traits;

use Kaankilic\Pinbot\Helpers\UrlBuilder;

trait HasRelatedTopics
{
    use HandlesRequest;

    /**
     * Returns a list of related topics.
     *
     * @param string $interest
     * @return array|bool
     */
    public function getRelatedTopics($interest)
    {
        return $this->get(
            ['interest_name' => $interest],
            UrlBuilder::RESOURCE_GET_CATEGORIES_RELATED
        );
    }
}