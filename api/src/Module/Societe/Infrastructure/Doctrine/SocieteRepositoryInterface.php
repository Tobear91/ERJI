<?php

namespace App\Module\Societe\Infrastructure\Doctrine;

use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;

interface SocieteRepositoryInterface
{
    public function save(SocieteRecord $societe): void;
    public function findAll(): array;
}
