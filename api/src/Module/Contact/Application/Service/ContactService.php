<?php

namespace App\Module\Contact\Application\Service;

use App\Module\Contact\Application\DTO\ContactDTO;
use App\Module\Contact\Domain\Entity\Contact;
use App\Module\Contact\Application\Service\ContactMapper;
use App\Module\Contact\Infrastructure\Doctrine\ContactRepository;
use App\Module\Contact\Validation\Service\ContactValidator;

class ContactService
{

    public function __construct(private ContactRepository $contact_repository) {}

    public function createContact(array $contact_datas): ContactDTO
    {
        ContactValidator::validate($contact_datas);

        $contact = new Contact(
            firstname: $contact_datas['firstname'],
            lastname: $contact_datas['lastname'],
            email: $contact_datas['email'] ?? null,
            phone: $contact_datas['phone']?? null,
        );

        $record = ContactMapper::toRecord($contact);

        $this->contact_repository->save($record);

        return ContactMapper::toDTO(ContactMapper::toDomain($record));
    }
}
