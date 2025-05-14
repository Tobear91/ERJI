<?php

namespace App\Module\Lot\Application\DTO;

use App\Module\Chantier\Application\DTO\ChantierLightDTO;

final class LotDTO
{
    public function __construct(
        public string $id,
        public string $label,
        public string $created,
        public string $updated,
        public ChantierLightDTO $chantier,
    ) {}
}
