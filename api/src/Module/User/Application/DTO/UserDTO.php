<?php

namespace App\Module\User\Application\DTO;

final class UserDTO
{
    public function __construct(
        public string $id,
        public string $firstname,
        public string $lastname,
        public string $email,
        public string $created,
        public string $updated,
    ) {}
}
