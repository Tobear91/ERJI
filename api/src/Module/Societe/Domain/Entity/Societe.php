<?php

namespace App\Module\Societe\Domain\Entity;

use App\Module\SocieteType\Domain\Entity\SocieteType;
use DateTimeImmutable;

final class Societe
{
    public function __construct(
        public string $name,
        public string $address,
        public string $postal_code,
        public string $city,
        public ?SocieteType $societe_type = null,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null,
        public ?array $contacts = null
    ) {}
}
