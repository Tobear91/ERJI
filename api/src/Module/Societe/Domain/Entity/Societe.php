<?php

namespace App\Module\Societe\Domain\Entity;

use DateTimeImmutable;

final class Societe
{
    public function __construct(
        public string $name,
        public string $address,
        public string $postalCode,
        public string $city,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null
    ) {}
}
