<?php

namespace App\Module\Chantier\Application\DTO;

final class ChantierDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $address,
        public string $postal_code,
        public string $city,
        public string $created,
        public string $updated,
        /** @var LotLightDTO[] */
        public ?array $lots = null,
    ) {}
}
