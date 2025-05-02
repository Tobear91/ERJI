<?php

namespace App\Module\User\Domain\Entity;

use DateTimeImmutable;

final class User
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public string $email,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null
    ) {}
}
