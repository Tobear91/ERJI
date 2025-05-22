<?php

namespace App\Module\Intervenant\Application\DTO;

use App\Module\IntervenantType\Application\DTO\IntervenantTypeLightDTO;

final class IntervenantLightDTO
{
    public function __construct(
        public string $vic,
        // public IntervenantTypeLightDTO $intervenant_type,
    ) {}
}
