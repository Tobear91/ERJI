<?php

namespace App\Module\ContactFunction\Application\DTO;

final class ContactFunctionDTO
{
    public function __construct(
        public string $id,
        public string $label,
        public string $created,
        public string $updated,
    ) {}
}
