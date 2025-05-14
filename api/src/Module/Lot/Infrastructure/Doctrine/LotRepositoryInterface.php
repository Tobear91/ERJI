<?php

namespace App\Module\Lot\Infrastructure\Doctrine;

use App\Module\Lot\Infrastructure\Doctrine\Entity\LotRecord;

interface LotRepositoryInterface
{
    public function save(LotRecord $lot): void;
    public function findOneById(string $id): LotRecord;
}
