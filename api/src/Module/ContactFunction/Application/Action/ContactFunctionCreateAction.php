<?php

namespace App\Module\ContactFunction\Application\Action;

use App\Module\ContactFunction\Application\Service\ContactFunctionService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class ContactFunctionCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private ContactFunctionService $contact_function_service) {}

    function __invoke(Request $request, Response $response): Response
    {
        $contact_function_datas = (array)$request->getParsedBody();
        $contact_function = $this->contact_function_service->createSociete($contact_function_datas);
        return $this->jsonResponder->encodeAndAddToResponse($response, $contact_function, 201);
    }
}
