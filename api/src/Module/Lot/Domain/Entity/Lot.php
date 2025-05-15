<?php

namespace App\Module\Lot\Domain\Entity;

use App\Module\Chantier\Application\DTO\ChantierLightDTO;
use App\Module\Chantier\Domain\Entity\Chantier;
use DateTimeImmutable;

final class Lot
{
    public function __construct(
        public string $label,
        public ?ChantierLightDTO $chantier = null,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null
    ) {}
}
