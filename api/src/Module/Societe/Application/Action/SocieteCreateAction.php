<?php

namespace App\Module\Societe\Application\Action;

use App\Module\Societe\Application\Service\SocieteService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class SocieteCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private SocieteService $societeService) {}

    function __invoke(Request $request, Response $response): Response
    {
        $societeData = (array)$request->getParsedBody();
        $societe = $this->societeService->createSociete($societeData);
        return $this->jsonResponder->encodeAndAddToResponse($response, $societe, 201);
    }
}
