<?php

namespace App\Module\Societe\Application\DTO;

use App\Module\SocieteType\Application\DTO\SocieteTypeLightDTO;

final class SocieteLightDTO
{
    public function __construct(
        public string $name,
        public string $address,
        public string $postal_code,
        public string $city,
        public SocieteTypeLightDTO $societe_type,
    ) {}
}
