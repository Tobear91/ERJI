<?php

namespace App\Module\Societe\Application\Service;

use App\Module\Contact\Application\Service\ContactMapper;
use App\Module\Contact\Domain\Entity\Contact;
use App\Module\Contact\Infrastructure\Doctrine\Entity\ContactRecord;
use App\Module\Societe\Application\DTO\SocieteDTO;
use App\Module\Societe\Application\DTO\SocieteLightDTO;
use App\Module\Societe\Domain\Entity\Societe;
use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;
use App\Module\SocieteType\Application\Service\SocieteTypeMapper;
use App\Module\SocieteType\Infrastructure\Doctrine\Entity\SocieteTypeRecord;

final class SocieteMapper
{
    public static function toDomain(SocieteRecord $record): Societe
    {
        $contacts = array_map(
            fn(ContactRecord $contact_record) => ContactMapper::toDomain($contact_record),
            $record->getContacts()->toArray()
        );

        return new Societe(
            id: $record->getId(),
            name: $record->getName(),
            address: $record->getAddress(),
            postal_code: $record->getPostalCode(),
            city: $record->getCity(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
            societe_type: SocieteTypeMapper::toDomain($record->getSocieteType()),
            contacts: $contacts,
        );
    }

    public static function toDTO(Societe $societe, bool $include_contacts = true): SocieteDTO
    {

        $contactsDTOs = array_map(
            fn(Contact $contact) => ContactMapper::toLightDTO($contact),
            $societe->contacts ?? []
        );

        return new SocieteDTO(
            id: $societe->id,
            name: $societe->name,
            address: $societe->address,
            postal_code: $societe->postal_code,
            city: $societe->city,
            created: $societe->created->format('Y-m-d H:i:s'),
            updated: $societe->updated->format('Y-m-d H:i:s'),
            societe_type: SocieteTypeMapper::toLightDTO($societe->societe_type),
            contacts: $include_contacts ? $contactsDTOs : null,
        );
    }

    public static function toLightDTO(Societe $societe): SocieteLightDTO
    {
        return new SocieteLightDTO(
            name: $societe->name,
            address: $societe->address,
            postal_code: $societe->postal_code,
            city: $societe->city,
            societe_type: SocieteTypeMapper::toLightDTO($societe->societe_type),
        );
    }

    public static function toLightDTOFromRecord(SocieteRecord $record): SocieteLightDTO
    {
        return new SocieteLightDTO(
            name: $record->getName(),
            address: $record->getAddress(),
            postal_code: $record->getPostalCode(),
            city: $record->getCity(),
            societe_type: SocieteTypeMapper::toLightDTOFromRecord($record->getSocieteType()),
        );
    }

    public static function toRecord(Societe $societe, SocieteTypeRecord $societe_type): SocieteRecord
    {
        $record = new SocieteRecord();
        $record->setName($societe->name);
        $record->setAddress($societe->address);
        $record->setPostalCode($societe->postal_code);
        $record->setCity($societe->city);
        $record->setSocieteType($societe_type);
        return $record;
    }
}
