<?php

namespace App\Module\Societe\Application\Service;

use App\Module\Societe\Application\DTO\SocieteDTO;
use App\Module\Societe\Domain\Entity\Societe;
use App\Module\Societe\Application\Service\SocieteMapper;
use App\Module\Societe\Infrastructure\Doctrine\SocieteRepository;
use App\Module\Societe\Validation\Service\SocieteValidator;

class SocieteService
{

    public function __construct(private SocieteRepository $societeRepository) {}

    public function createSociete(array $societeData): SocieteDTO
    {
        SocieteValidator::validate($societeData);

        $societe = new Societe(
            name: $societeData['name'],
            address: $societeData['address'],
            postalCode: $societeData['postalCode'],
            city: $societeData['city'],
        );

        $record = SocieteMapper::toRecord($societe);

        $this->societeRepository->save($record);

        return SocieteMapper::toDTO(SocieteMapper::toDomain($record));
    }
}
