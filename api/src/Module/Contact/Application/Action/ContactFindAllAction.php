<?php

namespace App\Module\Contact\Application\Action;

use App\Module\Contact\Infrastructure\Doctrine\ContactRepository;
use App\Module\Contact\Application\Service\ContactMapper;
use App\Application\Responder\JsonResponder;
use App\Module\Contact\Domain\Entity\Contact;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class ContactFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private ContactRepository $contactRepository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $contacts = $this->contactRepository->findAll();
        $contacts = array_map(fn($contact) => ContactMapper::toDTO(ContactMapper::toDomain($contact)), $contacts);
        return $this->jsonResponder->encodeAndAddToResponse($response, $contacts, 200);
    }
}
