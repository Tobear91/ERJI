<?php

namespace App\Module\Chantier\Application\Action;

use App\Module\Chantier\Application\Service\ChantierService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class ChantierCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private ChantierService $chantierService) {}

    function __invoke(Request $request, Response $response): Response
    {
        $chantier_datas = (array)$request->getParsedBody();
        $chantier = $this->chantierService->createChantier($chantier_datas);
        return $this->jsonResponder->encodeAndAddToResponse($response, $chantier, 201);
    }
}
