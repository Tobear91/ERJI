<?php

use App\Application\Middleware\ErrorHandlerMiddleware;
use App\Application\Responder\JsonResponder;
use App\Infrastructure\Doctrine\Doctrine;
use App\Module\User\Infrastructure\Doctrine\UserRepository;
use App\Module\User\Infrastructure\Doctrine\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

return [
    JsonResponder::class => function () {
        return new JsonResponder();
    },
    EntityManagerInterface::class => function () {
        return Doctrine::getInstance()->getEntityManager();
    },
    UserRepositoryInterface::class => function (ContainerInterface $container) {
        return new UserRepository(
            $container->get(EntityManagerInterface::class)
        );
    },
    ErrorHandlerMiddleware::class => function (ContainerInterface $container) {
        return new ErrorHandlerMiddleware($container->get(JsonResponder::class));
    },
];
