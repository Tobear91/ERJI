<?php

namespace App\Module\ContactFunction\Application\Service;

use App\Module\ContactFunction\Application\DTO\ContactFunctionDTO;
use App\Module\ContactFunction\Domain\Entity\ContactFunction;
use App\Module\ContactFunction\Application\Service\ContactFunctionMapper;
use App\Module\ContactFunction\Infrastructure\Doctrine\ContactFunctionRepository;
use App\Module\ContactFunction\Validation\Service\ContactFunctionValidator;

class ContactFunctionService
{

    public function __construct(private ContactFunctionRepository $societeRepository) {}

    public function createSociete(array $societeTypeData): ContactFunctionDTO
    {
        ContactFunctionValidator::validate($societeTypeData);

        $societeType = new ContactFunction(
            label: $societeTypeData['label'],
        );

        $record = ContactFunctionMapper::toRecord($societeType);

        $this->societeRepository->save($record);

        return ContactFunctionMapper::toDTO(ContactFunctionMapper::toDomain($record));
    }
}
