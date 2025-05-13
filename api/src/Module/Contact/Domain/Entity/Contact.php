<?php

namespace App\Module\Contact\Domain\Entity;

use App\Module\Societe\Domain\Entity\Societe;
use DateTimeImmutable;

final class Contact
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public Societe $societe,
        public ?string $email = null,
        public ?string $phone = null,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null,
    ) {}
}
