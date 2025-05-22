<?php

namespace App\Module\Intervenant\Infrastructure\Doctrine;

use App\Module\Intervenant\Infrastructure\Doctrine\Entity\IntervenantRecord;

interface IntervenantRepositoryInterface
{
    public function save(IntervenantRecord $intervenant): void;
}
