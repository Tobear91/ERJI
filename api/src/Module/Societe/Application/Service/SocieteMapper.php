<?php

namespace App\Module\Societe\Application\Service;

use App\Module\Societe\Application\DTO\SocieteDTO;
use App\Module\Societe\Domain\Entity\Societe;
use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;

final class SocieteMapper
{
    public static function toDomain(SocieteRecord $record): Societe
    {
        return new Societe(
            id: $record->getId(),
            name: $record->getName(),
            address: $record->getAddress(),
            postalCode: $record->getPostalCode(),
            city: $record->getCity(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
        );
    }

    public static function toDTO(Societe $societe): SocieteDTO
    {
        return new SocieteDTO(
            id: $societe->id,
            name: $societe->name,
            address: $societe->address,
            postalCode: $societe->postalCode,
            city: $societe->city,
            created: $societe->created->format('Y-m-d H:i:s'),
            updated: $societe->updated->format('Y-m-d H:i:s'),
        );
    }

    public static function toRecord(Societe $societe): SocieteRecord
    {
        $record = new SocieteRecord();
        $record->setName($societe->name);
        $record->setAddress($societe->address);
        $record->setPostalCode($societe->postalCode);
        $record->setCity($societe->city);
        return $record;
    }
}
