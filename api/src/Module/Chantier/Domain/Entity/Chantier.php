<?php

namespace App\Module\Chantier\Domain\Entity;

use DateTimeImmutable;

final class Chantier
{
    public function __construct(
        public string $name,
        public string $address,
        public string $postal_code,
        public string $city,
        /** @var Lot[] */
        public array $lots,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null,
    ) {}
}
