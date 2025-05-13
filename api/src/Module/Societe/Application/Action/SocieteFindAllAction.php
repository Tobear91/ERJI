<?php

namespace App\Module\Societe\Application\Action;

use App\Module\Societe\Infrastructure\Doctrine\SocieteRepository;
use App\Module\Societe\Application\Service\SocieteMapper;
use App\Application\Responder\JsonResponder;
use App\Module\Societe\Domain\Entity\Societe;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class SocieteFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private SocieteRepository $societeRepository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $societes = $this->societeRepository->findAll();
        $societes = array_map(fn($societe) => SocieteMapper::toDTO(SocieteMapper::toDomain($societe)), $societes);
        return $this->jsonResponder->encodeAndAddToResponse($response, $societes, 200);
    }
}
