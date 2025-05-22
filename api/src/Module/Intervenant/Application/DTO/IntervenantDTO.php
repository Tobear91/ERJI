<?php

namespace App\Module\Intervenant\Application\DTO;

use App\Module\Chantier\Application\DTO\ChantierLightDTO;
use App\Module\Contact\Application\DTO\ContactLightDTO;

final class IntervenantDTO
{
    public function __construct(
        public string $id,
        public bool $vic,
        public string $created,
        public string $updated,
        public ContactLightDTO $contact,
        public ChantierLightDTO $chantier,
    ) {}
}
