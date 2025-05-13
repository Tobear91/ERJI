<?php

namespace App\Module\SocieteType\Infrastructure\Doctrine;

use App\Module\SocieteType\Infrastructure\Doctrine\Entity\SocieteTypeRecord;

interface SocieteTypeRepositoryInterface
{
    public function save(SocieteTypeRecord $societetype): void;
    public function findOneById(string $id): SocieteTypeRecord;
}
