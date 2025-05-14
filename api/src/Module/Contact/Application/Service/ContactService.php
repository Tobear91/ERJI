<?php

namespace App\Module\Contact\Application\Service;

use App\Module\Contact\Application\DTO\ContactDTO;
use App\Module\Contact\Domain\Entity\Contact;
use App\Module\Contact\Application\Service\ContactMapper;
use App\Module\Contact\Infrastructure\Doctrine\ContactRepository;
use App\Module\Contact\Validation\Service\ContactValidator;
use App\Module\ContactFunction\Application\Service\ContactFunctionMapper;
use App\Module\ContactFunction\Infrastructure\Doctrine\ContactFunctionRepository;
use App\Module\Societe\Application\Service\SocieteMapper;
use App\Module\Societe\Infrastructure\Doctrine\SocieteRepository;

class ContactService
{

    public function __construct(private ContactRepository $contact_repository, private SocieteRepository $societe_repository, private ContactFunctionRepository $contact_function_repository) {}

    public function createContact(array $contact_datas): ContactDTO
    {
        ContactValidator::validate($contact_datas);

        $societe_id = 'e078a387-683d-4235-81eb-362533a9820b';
        $societe = $this->societe_repository->findOneById($societe_id);

        $contact_function_id = '206268b8-2a1a-4f83-8fe9-ed1f715bf771';
        $contact_function = $this->contact_function_repository->findOneById($contact_function_id);

        $contact = new Contact(
            firstname: $contact_datas['firstname'],
            lastname: $contact_datas['lastname'],
            email: $contact_datas['email'] ?? null,
            phone: $contact_datas['phone'] ?? null,
            societe: SocieteMapper::toDomain($societe),
            contact_function: ContactFunctionMapper::toDomain($contact_function),
        );

        $record = ContactMapper::toRecord($contact, $societe, $contact_function);

        $this->contact_repository->save($record);

        return ContactMapper::toDTO(ContactMapper::toDomain($record));
    }
}
