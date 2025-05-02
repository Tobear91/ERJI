<?php

use App\Module\User\Application\Action\UserFindAllAction;
use App\Module\User\Application\Action\UserCreateAction;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;

return function (App $app) {
    $app->group('/users', function (RouteCollectorProxy $group) {
        $group->get('', UserFindAllAction::class);
        $group->post('', UserCreateAction::class);
    });
};
