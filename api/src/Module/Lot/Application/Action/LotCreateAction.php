<?php

namespace App\Module\Lot\Application\Action;

use App\Module\Lot\Application\Service\LotService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class LotCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private LotService $lot_service) {}

    function __invoke(Request $request, Response $response): Response
    {
        $lot_datas = (array)$request->getParsedBody();
        $lot = $this->lot_service->createSociete($lot_datas);
        return $this->jsonResponder->encodeAndAddToResponse($response, $lot, 201);
    }
}
