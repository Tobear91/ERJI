<?php

namespace App\Module\Intervenant\Application\Action;

use App\Module\Intervenant\Infrastructure\Doctrine\IntervenantRepository;
use App\Module\Intervenant\Application\Service\IntervenantMapper;
use App\Application\Responder\JsonResponder;
use App\Module\Intervenant\Domain\Entity\Intervenant;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class IntervenantFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private IntervenantRepository $intervenantRepository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $intervenants = $this->intervenantRepository->findAll();
        $intervenants = array_map(fn($intervenant) => IntervenantMapper::toDTO(IntervenantMapper::toDomain($intervenant)), $intervenants);
        return $this->jsonResponder->encodeAndAddToResponse($response, $intervenants, 200);
    }
}
