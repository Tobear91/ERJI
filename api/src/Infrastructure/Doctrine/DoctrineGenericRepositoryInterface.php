<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

interface DoctrineGenericRepositoryInterface
{
    public function save(object $entity): void;
    public function findAll(): array;
    public function findOneById(string $id): ?object;
}
