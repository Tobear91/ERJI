<?php

namespace App\Module\Contact\Application\Service;

use App\Module\Contact\Application\DTO\ContactDTO;
use App\Module\Contact\Application\DTO\ContactLightDTO;
use App\Module\Contact\Domain\Entity\Contact;
use App\Module\Contact\Infrastructure\Doctrine\Entity\ContactRecord;
use App\Module\ContactFunction\Application\Service\ContactFunctionMapper;
use App\Module\ContactFunction\Infrastructure\Doctrine\Entity\ContactFunctionRecord;
use App\Module\Societe\Application\Service\SocieteMapper;
use App\Module\Societe\Infrastructure\Doctrine\Entity\SocieteRecord;

final class ContactMapper
{
    public static function toDomain(ContactRecord $record): Contact
    {
        return new Contact(
            id: $record->getId(),
            firstname: $record->getFirstname(),
            lastname: $record->getLastname(),
            email: $record->getEmail(),
            phone: $record->getPhone(),
            created: $record->getCreated(),
            updated: $record->getUpdated(),
            societe: SocieteMapper::toLightDTOFromRecord($record->getSociete()),
            contact_function: ContactFunctionMapper::toDomain($record->getContactFunction()),
        );
    }

    public static function toDTO(Contact $contact): ContactDTO
    {
        return new ContactDTO(
            id: $contact->id,
            firstname: $contact->firstname,
            lastname: $contact->lastname,
            email: $contact->email,
            phone: $contact->phone,
            created: $contact->created->format('Y-m-d H:i:s'),
            updated: $contact->updated->format('Y-m-d H:i:s'),
            societe: $contact->societe,
            contact_function: ContactFunctionMapper::toLightDTO($contact->contact_function),
        );
    }

    public static function toLightDTO(Contact $contact): ContactLightDTO
    {
        return new ContactLightDTO(
            id: $contact->id,
            firstname: $contact->firstname,
            lastname: $contact->lastname,
            email: $contact->email,
            phone: $contact->phone,
            contact_function: ContactFunctionMapper::toLightDTO($contact->contact_function),
        );
    }

    public static function toRecord(Contact $contact, SocieteRecord $societe, ContactFunctionRecord $contact_function): ContactRecord
    {
        $record = new ContactRecord();
        $record->setFirstname($contact->firstname);
        $record->setLastname($contact->lastname);
        $record->setSociete($societe);
        $record->setContactFunction($contact_function);

        if ($contact->email !== null)
            $record->setEmail($contact->email);

        if ($contact->phone !== null)
            $record->setPhone($contact->phone);

        return $record;
    }
}
