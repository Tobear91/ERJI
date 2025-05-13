<?php

namespace App\Module\SocieteType\Application\Action;

use App\Module\SocieteType\Infrastructure\Doctrine\SocieteTypeRepository;
use App\Module\SocieteType\Application\Service\SocieteTypeMapper;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class SocieteTypeFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private SocieteTypeRepository $societeRepository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $societes = $this->societeRepository->findAll();
        $societes = array_map(fn($societetype) => SocieteTypeMapper::toDTO(SocieteTypeMapper::toDomain($societetype)), $societes);
        return $this->jsonResponder->encodeAndAddToResponse($response, $societes, 200);
    }
}
