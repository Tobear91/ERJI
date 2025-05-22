<?php

namespace App\Module\Intervenant\Domain\Entity;

use App\Module\Chantier\Application\DTO\ChantierLightDTO;
use App\Module\Contact\Application\DTO\ContactLightDTO;
use DateTimeImmutable;

final class Intervenant
{
    public function __construct(
        public bool $vic,
        public ?ChantierLightDTO $chantier = null,
        public ?ContactLightDTO $contact = null,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null,
    ) {}
}
