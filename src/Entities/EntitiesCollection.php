<?php

namespace App\Entities;

interface EntitiesCollection
{
    public function __construct(EntityInterface ...$entities);

    public function add(EntityInterface $entity): void;

    public function all(): array;
}