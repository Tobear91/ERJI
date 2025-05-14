<?php

namespace App\Module\Contact\Application\DTO;

use App\Module\ContactFunction\Application\DTO\ContactFunctionLightDTO;
use App\Module\Societe\Application\DTO\SocieteLightDTO;

final class ContactDTO
{
    public function __construct(
        public string $id,
        public string $firstname,
        public string $lastname,
        public ?string $email,
        public ?string $phone,
        public string $created,
        public string $updated,
        public SocieteLightDTO $societe,
        public ContactFunctionLightDTO $contact_function,
    ) {}
}
