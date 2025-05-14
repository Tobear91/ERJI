<?php

namespace App\Module\Chantier\Application\Action;

use App\Module\Chantier\Infrastructure\Doctrine\ChantierRepository;
use App\Module\Chantier\Application\Service\ChantierMapper;
use App\Application\Responder\JsonResponder;
use App\Module\Chantier\Domain\Entity\Chantier;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class ChantierFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private ChantierRepository $chantier_repository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $chantiers = $this->chantier_repository->findAll();
        $chantiers = array_map(fn($chantier) => ChantierMapper::toDTO(ChantierMapper::toDomain($chantier)), $chantiers);
        return $this->jsonResponder->encodeAndAddToResponse($response, $chantiers, 200);
    }
}
