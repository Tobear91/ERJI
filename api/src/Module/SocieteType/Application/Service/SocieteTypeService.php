<?php

namespace App\Module\SocieteType\Application\Service;

use App\Module\SocieteType\Application\DTO\SocieteTypeDTO;
use App\Module\SocieteType\Domain\Entity\SocieteType;
use App\Module\SocieteType\Application\Service\SocieteTypeMapper;
use App\Module\SocieteType\Infrastructure\Doctrine\SocieteTypeRepository;
use App\Module\SocieteType\Validation\Service\SocieteTypeValidator;

class SocieteTypeService
{

    public function __construct(private SocieteTypeRepository $societeRepository) {}

    public function createSociete(array $societeTypeData): SocieteTypeDTO
    {
        SocieteTypeValidator::validate($societeTypeData);

        $societeType = new SocieteType(
            label: $societeTypeData['label'],
        );

        $record = SocieteTypeMapper::toRecord($societeType);

        $this->societeRepository->save($record);

        return SocieteTypeMapper::toDTO(SocieteTypeMapper::toDomain($record));
    }
}
