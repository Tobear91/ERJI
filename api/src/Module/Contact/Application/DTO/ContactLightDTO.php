<?php

namespace App\Module\Contact\Application\DTO;

use App\Module\ContactFunction\Application\DTO\ContactFunctionLightDTO;
use App\Module\Societe\Application\DTO\SocieteLightDTO;

final class ContactLightDTO
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public ?string $email,
        public ?string $phone,
        public SocieteLightDTO $societe,
        public ContactFunctionLightDTO $contact_function,
    ) {}
}
