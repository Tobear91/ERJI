<?php

namespace App\Module\Chantier\Application\Service;

use App\Module\Chantier\Application\DTO\ChantierDTO;
use App\Module\Chantier\Application\DTO\ChantierLightDTO;
use App\Module\Chantier\Domain\Entity\Chantier;
use App\Module\Chantier\Infrastructure\Doctrine\Entity\ChantierRecord;
use App\Module\Lot\Application\Service\LotMapper;
use App\Module\Lot\Domain\Entity\Lot;
use App\Module\Lot\Infrastructure\Doctrine\Entity\LotRecord;

final class ChantierMapper
{
    public static function toDomain(ChantierRecord $record): Chantier
    {
        $lots = array_map(
            fn(LotRecord $lotRecord) => LotMapper::toDomain($lotRecord),
            $record->getLots()->toArray()
        );

        return new Chantier(
            id: $record->getId(),
            name: $record->getName(),
            address: $record->getAddress(),
            postal_code: $record->getPostalCode(),
            city: $record->getCity(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
            lots: $lots,
        );
    }

    public static function toDTO(Chantier $chantier): ChantierDTO
    {
        $lotDTOs = array_map(
            fn(Lot $lot) => LotMapper::toLightDTO($lot),
            $chantier->lots
        );

        return new ChantierDTO(
            id: $chantier->id,
            name: $chantier->name,
            address: $chantier->address,
            postal_code: $chantier->postal_code,
            city: $chantier->city,
            created: $chantier->created->format('Y-m-d H:i:s'),
            updated: $chantier->updated->format('Y-m-d H:i:s'),
            lots: $lotDTOs,
        );
    }

    public static function toLightDTO(Chantier $chantier): ChantierLightDTO
    {
        return new ChantierLightDTO(
            name: $chantier->name,
            address: $chantier->address,
            postal_code: $chantier->postal_code,
            city: $chantier->city,
        );
    }

    public static function toLightDTOFromRecord(ChantierRecord $record): ChantierLightDTO
    {
        return new ChantierLightDTO(
            name: $record->getName(),
            address: $record->getAddress(),
            postal_code: $record->getPostalCode(),
            city: $record->getCity()
        );
    }

    public static function toRecord(Chantier $chantier): ChantierRecord
    {
        $record = new ChantierRecord();
        $record->setName($chantier->name);
        $record->setAddress($chantier->address);
        $record->setPostalCode($chantier->postal_code);
        $record->setCity($chantier->city);
        return $record;
    }
}
