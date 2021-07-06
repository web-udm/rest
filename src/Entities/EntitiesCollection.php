<?php

namespace App\Entities;

interface EntitiesCollection
{
    public function __construct(Entity ...$entities);

    public function add(Entity $entity): void;

    public function all(): array;
}
