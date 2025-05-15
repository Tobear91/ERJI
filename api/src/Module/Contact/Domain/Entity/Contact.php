<?php

namespace App\Module\Contact\Domain\Entity;

use App\Module\ContactFunction\Domain\Entity\ContactFunction;
use App\Module\Societe\Application\DTO\SocieteLightDTO;
use DateTimeImmutable;

final class Contact
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public SocieteLightDTO $societe,
        public ContactFunction $contact_function,
        public ?string $email = null,
        public ?string $phone = null,
        public readonly ?string $id = null,
        public readonly ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $updated = null,
    ) {}
}
