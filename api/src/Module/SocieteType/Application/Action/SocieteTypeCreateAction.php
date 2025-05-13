<?php

namespace App\Module\SocieteType\Application\Action;

use App\Module\SocieteType\Application\Service\SocieteTypeService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class SocieteTypeCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private SocieteTypeService $societeService) {}

    function __invoke(Request $request, Response $response): Response
    {
        $societeData = (array)$request->getParsedBody();
        $societetype = $this->societeService->createSociete($societeData);
        return $this->jsonResponder->encodeAndAddToResponse($response, $societetype, 201);
    }
}
