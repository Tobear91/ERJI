<?php

namespace App\Module\User\Application\Action;

use App\Module\User\Application\Service\UserService;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

final class UserCreateAction
{
    public function __construct(private JsonResponder $jsonResponder, private UserService $userService) {}

    function __invoke(Request $request, Response $response): Response
    {
        $userData = (array)$request->getParsedBody();
        $user = $this->userService->createUser($userData);
        return $this->jsonResponder->encodeAndAddToResponse($response, $user, 201);
    }
}
