<?php

namespace Kaankilic\Pinbot\Api\Traits;

use Kaankilic\Pinbot\Helpers\Pagination;

trait HasPagination
{
    /**
     * @param callable $callback
     * @param int $limit
     * @return Pagination
     */
    abstract protected function paginateCustom(callable $callback, $limit = Pagination::DEFAULT_LIMIT);
}