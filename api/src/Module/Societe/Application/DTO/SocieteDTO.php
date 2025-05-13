<?php

namespace App\Module\Societe\Application\DTO;

use App\Module\SocieteType\Application\DTO\SocieteTypeDTO;

final class SocieteDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $address,
        public string $postal_code,
        public string $city,
        public string $created,
        public string $updated,
        public SocieteTypeDTO $societe_type,
    ) {}
}
