<?php

namespace App\Module\Contact\Application\Service;

use App\Module\Contact\Application\DTO\ContactDTO;
use App\Module\Contact\Domain\Entity\Contact;
use App\Module\Contact\Application\Service\ContactMapper;
use App\Module\Contact\Infrastructure\Doctrine\ContactRepository;
use App\Module\Contact\Validation\Service\ContactValidator;
use App\Module\Societe\Application\Service\SocieteMapper;
use App\Module\Societe\Infrastructure\Doctrine\SocieteRepository;

class ContactService
{

    public function __construct(private ContactRepository $contact_repository, private SocieteRepository $societe_repository) {}

    public function createContact(array $contact_datas): ContactDTO
    {
        ContactValidator::validate($contact_datas);

        $societe_id = '0bc6f4df-56a2-4fa5-bdc0-881853f73a38';
        $societe = $this->societe_repository->findOneById($societe_id);

        $contact = new Contact(
            firstname: $contact_datas['firstname'],
            lastname: $contact_datas['lastname'],
            email: $contact_datas['email'] ?? null,
            phone: $contact_datas['phone'] ?? null,
            societe: SocieteMapper::toDomain($societe),
        );

        $record = ContactMapper::toRecord($contact, $societe);

        $this->contact_repository->save($record);

        return ContactMapper::toDTO(ContactMapper::toDomain($record));
    }
}
