<?php

namespace App\Module\User\Application\Service;

use App\Module\User\Application\DTO\UserDTO;
use App\Module\User\Domain\Entity\User;
use App\Module\User\Infrastructure\Doctrine\Entity\UserRecord;

final class UserMapper
{
    public static function toDomain(UserRecord $record): User
    {
        return new User(
            id: $record->getId(),
            firstname: $record->getFirstname(),
            lastname: $record->getLastname(),
            email: $record->getEmail(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
        );
    }

    public static function toDTO(User $user): UserDTO
    {
        return new UserDTO(
            id: $user->id,
            firstname: $user->firstname,
            lastname: $user->lastname,
            email: $user->email,
            created: $user->created->format('Y-m-d H:i:s'),
            updated: $user->updated->format('Y-m-d H:i:s'),
        );
    }

    public static function toRecord(User $user): UserRecord
    {
        $record = new UserRecord();
        $record->setFirstname($user->firstname);
        $record->setLastname($user->lastname);
        $record->setEmail($user->email);
        return $record;
    }
}
