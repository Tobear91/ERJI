<?php

namespace App\Module\SocieteType\Application\DTO;

final class SocieteTypeDTO
{
    public function __construct(
        public string $id,
        public string $label,
    ) {}
}
