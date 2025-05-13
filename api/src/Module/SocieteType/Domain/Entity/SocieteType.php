<?php

namespace App\Module\SocieteType\Domain\Entity;

use DateTimeImmutable;

final class SocieteType
{
    public function __construct(
        public string $label,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null
    ) {}
}
