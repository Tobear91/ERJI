<?php

namespace App\Module\ContactFunction\Domain\Entity;

use DateTimeImmutable;

final class ContactFunction
{
    public function __construct(
        public string $label,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null
    ) {}
}
