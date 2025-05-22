<?php

namespace App\Module\Intervenant\Application\Service;

use App\Module\Chantier\Infrastructure\Doctrine\ChantierRepository;
use App\Module\Contact\Infrastructure\Doctrine\ContactRepository;
use App\Module\Intervenant\Application\DTO\IntervenantDTO;
use App\Module\Intervenant\Domain\Entity\Intervenant;
use App\Module\Intervenant\Application\Service\IntervenantMapper;
use App\Module\Intervenant\Infrastructure\Doctrine\IntervenantRepository;
use App\Module\Intervenant\Validation\Service\IntervenantValidator;

class IntervenantService
{

    public function __construct(private IntervenantRepository $intervenant_repository, private ContactRepository $contact_repository, private ChantierRepository $chantier_repository) {}

    public function createIntervenant(array $intervenant_datas): IntervenantDTO
    {

        $intervenant_datas['vic'] = filter_var($intervenant_datas['vic'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        IntervenantValidator::validate($intervenant_datas);

        $contact = $this->contact_repository->findOneById($intervenant_datas['contact_id']);
        $chantier = $this->chantier_repository->findOneById($intervenant_datas['chantier_id']);

        $intervenant = new Intervenant(
            vic: $intervenant_datas['vic'],
        );

        $record = IntervenantMapper::toRecord($intervenant, $contact, $chantier);

        $this->intervenant_repository->save($record);

        return IntervenantMapper::toDTO(IntervenantMapper::toDomain($record));
    }
}
