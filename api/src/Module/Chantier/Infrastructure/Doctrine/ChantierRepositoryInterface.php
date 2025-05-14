<?php

namespace App\Module\Chantier\Infrastructure\Doctrine;

use App\Module\Chantier\Infrastructure\Doctrine\Entity\ChantierRecord;

interface ChantierRepositoryInterface
{
    public function save(ChantierRecord $chantier): void;
}
