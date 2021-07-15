<?php

namespace App\Entities;

/**
 * @package App\Entities
 */
class EntityCollection
{
    /**
     * @var Entity[]
     */
    private array $entities;

    /**
     * @param Entity $entity
     *
     * @return $this
     */
    public function addEntity(Entity $entity): self
    {
        $this->entities[] = $entity;

        return $this;
    }

    /**
     * @return Entity[]
     */
    public function getAll(): array
    {
        return $this->entities;
    }

    /**
     * @return array
     */
    public function getAllAsArray(): array
    {
        $result = [];

        foreach ($this->getAll() as $entity) {
            $result[] = $entity->toArray();
        }

        return $result;
    }
}
