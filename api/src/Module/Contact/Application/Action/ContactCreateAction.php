<?php

namespace App\Module\Contact\Application\Action;

use App\Module\Contact\Application\Service\ContactService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class ContactCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private ContactService $contact_service) {}

    function __invoke(Request $request, Response $response): Response
    {
        $contact_datas = (array)$request->getParsedBody();
        $contact = $this->contact_service->createContact($contact_datas);
        return $this->jsonResponder->encodeAndAddToResponse($response, $contact, 201);
    }
}
