<?php

namespace App\Module\Societe\Application\Service;

use App\Module\Societe\Application\DTO\SocieteDTO;
use App\Module\Societe\Domain\Entity\Societe;
use App\Module\Societe\Application\Service\SocieteMapper;
use App\Module\Societe\Infrastructure\Doctrine\SocieteRepository;
use App\Module\Societe\Validation\Service\SocieteValidator;
use App\Module\SocieteType\Infrastructure\Doctrine\SocieteTypeRepository;

class SocieteService
{

    public function __construct(private SocieteRepository $societe_repository, private SocieteTypeRepository $societe_type_repository) {}

    public function createSociete(array $societe_data): SocieteDTO
    {
        SocieteValidator::validate($societe_data);

        $societe_type_id = 'cc46186b-0ac9-4920-b861-205991c0c8f1';
        $societe_type = $this->societe_type_repository->findOneById($societe_type_id);

        $societe = new Societe(
            name: $societe_data['name'],
            address: $societe_data['address'],
            postal_code: $societe_data['postal_code'],
            city: $societe_data['city'],
        );

        $record = SocieteMapper::toRecord($societe);
        $record->setSocieteType($societe_type);

        $this->societe_repository->save($record);

        return SocieteMapper::toDTO(SocieteMapper::toDomain($record));
    }
}
