<?php

namespace App\Module\Lot\Application\Service;

use App\Module\Chantier\Infrastructure\Doctrine\ChantierRepository;
use App\Module\Lot\Application\DTO\LotDTO;
use App\Module\Lot\Domain\Entity\Lot;
use App\Module\Lot\Application\Service\LotMapper;
use App\Module\Lot\Infrastructure\Doctrine\LotRepository;
use App\Module\Lot\Validation\Service\LotValidator;

class LotService
{

    public function __construct(private LotRepository $lot_repository, private ChantierRepository $chantier_repository) {}

    public function createSociete(array $societeTypeData): LotDTO
    {
        LotValidator::validate($societeTypeData);

        $chantier = $this->chantier_repository->findOneById($societeTypeData['chantier_id']);

        $societeType = new Lot(
            label: $societeTypeData['label'],
        );

        $record = LotMapper::toRecord($societeType, $chantier);

        $this->lot_repository->save($record);

        return LotMapper::toDTO(LotMapper::toDomain($record));
    }
}
