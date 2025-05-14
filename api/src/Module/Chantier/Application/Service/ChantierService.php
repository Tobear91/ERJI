<?php

namespace App\Module\Chantier\Application\Service;

use App\Module\Chantier\Application\DTO\ChantierDTO;
use App\Module\Chantier\Domain\Entity\Chantier;
use App\Module\Chantier\Application\Service\ChantierMapper;
use App\Module\Chantier\Infrastructure\Doctrine\ChantierRepository;
use App\Module\Chantier\Validation\Service\ChantierValidator;

class ChantierService
{

    public function __construct(private ChantierRepository $chantier_repository) {}

    public function createChantier(array $chantier_datas): ChantierDTO
    {
        ChantierValidator::validate($chantier_datas);

        $chantier = new Chantier(
            name: $chantier_datas['name'],
            address: $chantier_datas['address'],
            postal_code: $chantier_datas['postal_code'],
            city: $chantier_datas['city'],
        );

        $record = ChantierMapper::toRecord($chantier);

        $this->chantier_repository->save($record);

        return ChantierMapper::toDTO(ChantierMapper::toDomain($record));
    }
}
