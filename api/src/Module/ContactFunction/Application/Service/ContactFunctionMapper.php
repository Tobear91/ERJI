<?php

namespace App\Module\ContactFunction\Application\Service;

use App\Module\ContactFunction\Application\DTO\ContactFunctionDTO;
use App\Module\ContactFunction\Application\DTO\ContactFunctionLightDTO;
use App\Module\ContactFunction\Domain\Entity\ContactFunction;
use App\Module\ContactFunction\Infrastructure\Doctrine\Entity\ContactFunctionRecord;

final class ContactFunctionMapper
{
    public static function toDomain(ContactFunctionRecord $record): ContactFunction
    {
        return new ContactFunction(
            id: $record->getId(),
            label: $record->getLabel(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
        );
    }

    public static function toDTO(ContactFunction $contact_function): ContactFunctionDTO
    {
        return new ContactFunctionDTO(
            id: $contact_function->id,
            label: $contact_function->label,
            created: $contact_function->created->format('Y-m-d H:i:s'),
            updated: $contact_function->updated->format('Y-m-d H:i:s'),
        );
    }

    public static function toLightDTO(ContactFunction $contact_function): ContactFunctionLightDTO
    {
        return new ContactFunctionLightDTO(
            label: $contact_function->label,
        );
    }

    public static function toLightDTOFromRecord(ContactFunctionRecord $record): ContactFunctionLightDTO
    {
        return new ContactFunctionLightDTO(
            label: $record->getLabel(),
        );
    }

    public static function toRecord(ContactFunction $contact_function): ContactFunctionRecord
    {
        $record = new ContactFunctionRecord();
        $record->setLabel($contact_function->label);
        return $record;
    }
}
