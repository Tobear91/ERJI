<?php

namespace App\Module\ContactFunction\Application\Action;

use App\Module\ContactFunction\Infrastructure\Doctrine\ContactFunctionRepository;
use App\Module\ContactFunction\Application\Service\ContactFunctionMapper;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class ContactFunctionFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private ContactFunctionRepository $contact_function_repository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $contact_functions = $this->contact_function_repository->findAll();
        $contact_functions = array_map(fn($contact_function) => ContactFunctionMapper::toDTO(ContactFunctionMapper::toDomain($contact_function)), $contact_functions);
        return $this->jsonResponder->encodeAndAddToResponse($response, $contact_functions, 200);
    }
}
