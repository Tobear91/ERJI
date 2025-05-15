<?php

namespace App\Module\Contact\Application\DTO;

use App\Module\ContactFunction\Application\DTO\ContactFunctionLightDTO;

final class ContactLightDTO
{
    public function __construct(
        public string $id,
        public string $firstname,
        public string $lastname,
        public ?string $email,
        public ?string $phone,
        public ContactFunctionLightDTO $contact_function,
    ) {}
}
