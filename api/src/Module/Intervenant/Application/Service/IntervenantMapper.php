<?php

namespace App\Module\Intervenant\Application\Service;

use App\Module\Chantier\Application\Service\ChantierMapper;
use App\Module\Chantier\Infrastructure\Doctrine\Entity\ChantierRecord;
use App\Module\Contact\Application\Service\ContactMapper;
use App\Module\Contact\Infrastructure\Doctrine\Entity\ContactRecord;
use App\Module\Intervenant\Application\DTO\IntervenantDTO;
use App\Module\Intervenant\Application\DTO\IntervenantLightDTO;
use App\Module\Intervenant\Domain\Entity\Intervenant;
use App\Module\Intervenant\Infrastructure\Doctrine\Entity\IntervenantRecord;

final class IntervenantMapper
{
    public static function toDomain(IntervenantRecord $record): Intervenant
    {
        return new Intervenant(
            id: $record->getId(),
            vic: $record->isVic(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
            contact: ContactMapper::toLightDTOFromRecord($record->getContact()),
            chantier: ChantierMapper::toLightDTOFromRecord($record->getChantier()),
        );
    }

    public static function toDTO(Intervenant $intervenant): IntervenantDTO
    {
        return new IntervenantDTO(
            id: $intervenant->id,
            vic: $intervenant->vic,
            created: $intervenant->created->format('Y-m-d H:i:s'),
            updated: $intervenant->updated->format('Y-m-d H:i:s'),
            contact: $intervenant->contact,
            chantier: $intervenant->chantier,
        );
    }

    public static function toLightDTO(Intervenant $intervenant): IntervenantLightDTO
    {
        return new IntervenantLightDTO(
            vic: $intervenant->vic,
        );
    }

    public static function toLightDTOFromRecord(IntervenantRecord $record): IntervenantLightDTO
    {
        return new IntervenantLightDTO(
            vic: $record->isVic(),
        );
    }

    public static function toRecord(Intervenant $intervenant, ContactRecord $contact, ChantierRecord $chantier): IntervenantRecord
    {
        $record = new IntervenantRecord();
        $record->setVic($intervenant->vic);
        $record->setContact($contact);
        $record->setChantier($chantier);
        return $record;
    }
}
