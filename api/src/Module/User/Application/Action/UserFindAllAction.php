<?php

namespace App\Module\User\Application\Action;

use App\Module\User\Infrastructure\Doctrine\UserRepository;
use App\Module\User\Application\Service\UserMapper;
use App\Application\Responder\JsonResponder;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class UserFindAllAction
{
    public function __construct(private JsonResponder $jsonResponder, private UserRepository $userRepository) {}

    function __invoke(Request $request, Response $response): Response
    {
        $users = $this->userRepository->findAll();
        $users = array_map(fn($user) => UserMapper::toDTO(UserMapper::toDomain($user)), $users);
        return $this->jsonResponder->encodeAndAddToResponse($response, $users, 200);
    }
}
