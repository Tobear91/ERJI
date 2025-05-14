<?php

namespace App\Module\Chantier\Application\DTO;

final class ChantierLightDTO
{
    public function __construct(
        public string $name,
        public string $address,
        public string $postal_code,
        public string $city,
    ) {}
}
