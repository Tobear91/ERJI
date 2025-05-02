<?php

namespace App\Module\Societe\Application\DTO;

final class SocieteDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $address,
        public string $postalCode,
        public string $city,
        public string $created,
        public string $updated,
    ) {}
}
