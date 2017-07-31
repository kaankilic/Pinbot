<?php

namespace Kaankilic\Pinbot\Api\Traits;

/**
 * Trait CanBeDeleted
 *
 * @property string $deleteUrl
 */
trait CanBeDeleted
{
    use HandlesRequest, HasEntityIdName;

    protected function requiresLoginForCanBeDelete()
    {
        return [
            'delete',
        ];
    }

    /**
     * Delete entity by ID.
     *
     * @param int $entityId
     *
     * @return bool
     */
    public function delete($entityId)
    {
        return $this->post(
            [$this->getEntityIdName() => $entityId],
            $this->getDeleteUrl()
        );
    }

    /**
     * @return string
     */
    protected function getDeleteUrl()
    {
        return property_exists($this, 'deleteUrl') ? $this->deleteUrl : '';
    }
}