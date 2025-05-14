<?php

namespace App\Module\Lot\Application\Action;

use App\Module\Lot\Infrastructure\Doctrine\LotRepository;
use App\Module\Lot\Application\Service\LotMapper;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class LotFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private LotRepository $lot_repository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $lots = $this->lot_repository->findAll();
        $lots = array_map(fn($lot) => LotMapper::toDTO(LotMapper::toDomain($lot)), $lots);
        return $this->jsonResponder->encodeAndAddToResponse($response, $lots, 200);
    }
}
