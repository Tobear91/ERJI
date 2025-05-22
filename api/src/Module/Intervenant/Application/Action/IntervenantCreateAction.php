<?php

namespace App\Module\Intervenant\Application\Action;

use App\Module\Intervenant\Application\Service\IntervenantService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class IntervenantCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private IntervenantService $intervenantService) {}

    function __invoke(Request $request, Response $response): Response
    {
        $intervenantData = (array)$request->getParsedBody();
        $intervenant = $this->intervenantService->createIntervenant($intervenantData);
        return $this->jsonResponder->encodeAndAddToResponse($response, $intervenant, 201);
    }
}
