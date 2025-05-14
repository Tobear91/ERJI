<?php

namespace App\Module\Lot\Application\Service;

use App\Module\Chantier\Application\Service\ChantierMapper;
use App\Module\Chantier\Infrastructure\Doctrine\Entity\ChantierRecord;
use App\Module\Lot\Application\DTO\LotDTO;
use App\Module\Lot\Application\DTO\LotLightDTO;
use App\Module\Lot\Domain\Entity\Lot;
use App\Module\Lot\Infrastructure\Doctrine\Entity\LotRecord;

final class LotMapper
{
    public static function toDomain(LotRecord $record): Lot
    {
        return new Lot(
            id: $record->getId(),
            label: $record->getLabel(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
            chantier: ChantierMapper::toLightDTO(ChantierMapper::toDomain($record->getChantier())),
        );
    }

    public static function toDTO(Lot $lot): LotDTO
    {
        return new LotDTO(
            id: $lot->id,
            label: $lot->label,
            created: $lot->created->format('Y-m-d H:i:s'),
            updated: $lot->updated->format('Y-m-d H:i:s'),
            chantier: $lot->chantier,
        );
    }

    public static function toLightDTO(Lot $lot): LotLightDTO
    {
        return new LotLightDTO(
            label: $lot->label,
        );
    }

    public static function toRecord(Lot $lot, ChantierRecord $chantier): LotRecord
    {
        $record = new LotRecord();
        $record->setLabel($lot->label);
        $record->setChantier($chantier);
        return $record;
    }
}
