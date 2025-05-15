<?php

namespace App\Module\SocieteType\Application\Service;

use App\Module\SocieteType\Application\DTO\SocieteTypeDTO;
use App\Module\SocieteType\Application\DTO\SocieteTypeLightDTO;
use App\Module\SocieteType\Domain\Entity\SocieteType;
use App\Module\SocieteType\Infrastructure\Doctrine\Entity\SocieteTypeRecord;

final class SocieteTypeMapper
{
    public static function toDomain(SocieteTypeRecord $record): SocieteType
    {
        return new SocieteType(
            id: $record->getId(),
            label: $record->getLabel(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
        );
    }

    public static function toDTO(SocieteType $societetype): SocieteTypeDTO
    {
        return new SocieteTypeDTO(
            id: $societetype->id,
            label: $societetype->label,
            created: $societetype->created->format('Y-m-d H:i:s'),
            updated: $societetype->updated->format('Y-m-d H:i:s'),
        );
    }

    public static function toLightDTO(SocieteType $societetype): SocieteTypeLightDTO
    {
        return new SocieteTypeLightDTO(
            label: $societetype->label,
        );
    }

    public static function toLightDTOFromRecord(SocieteTypeRecord $record): SocieteTypeLightDTO
    {
        return new SocieteTypeLightDTO(
            label: $record->getLabel(),
        );
    }

    public static function toRecord(SocieteType $societeType): SocieteTypeRecord
    {
        $record = new SocieteTypeRecord();
        $record->setLabel($societeType->label);
        return $record;
    }
}
