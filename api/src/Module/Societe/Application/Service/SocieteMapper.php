<?php

namespace App\Module\Societe\Application\Service;

use App\Module\Societe\Application\DTO\SocieteDTO;
use App\Module\Societe\Domain\Entity\Societe;
use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;
use App\Module\SocieteType\Application\Service\SocieteTypeMapper;

final class SocieteMapper
{
    public static function toDomain(SocieteRecord $record): Societe
    {
        return new Societe(
            id: $record->getId(),
            name: $record->getName(),
            address: $record->getAddress(),
            postal_code: $record->getPostalCode(),
            city: $record->getCity(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
            societe_type: $record->getSocieteType() ? SocieteTypeMapper::toDomain($record->getSocieteType()) : null,
        );
    }

    public static function toDTO(Societe $societe): SocieteDTO
    {
        return new SocieteDTO(
            id: $societe->id,
            name: $societe->name,
            address: $societe->address,
            postal_code: $societe->postal_code,
            city: $societe->city,
            created: $societe->created->format('Y-m-d H:i:s'),
            updated: $societe->updated->format('Y-m-d H:i:s'),
            societe_type: SocieteTypeMapper::toDTO($societe->societe_type),
        );
    }

    public static function toRecord(Societe $societe): SocieteRecord
    {
        $record = new SocieteRecord();
        $record->setName($societe->name);
        $record->setAddress($societe->address);
        $record->setPostalCode($societe->postal_code);
        $record->setCity($societe->city);
        return $record;
    }
}
