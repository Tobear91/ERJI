<?php

namespace App\Module\User\Infrastructure\Doctrine;

use App\Module\User\Infrastructure\Doctrine\Entity\UserRecord;

interface UserRepositoryInterface
{
    public function save(UserRecord $user): void;
    public function findAll(): array;
}
