<?php

use App\Module\Societe\Application\Action\SocieteCreateAction;
use App\Module\Societe\Application\Action\SocieteFindAllAction;
use App\Module\SocieteType\Application\Action\SocieteTypeCreateAction;
use App\Module\SocieteType\Application\Action\SocieteTypeFindAllAction;
use App\Module\User\Application\Action\UserFindAllAction;
use App\Module\User\Application\Action\UserCreateAction;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;

return function (App $app) {
    $app->group('/users', function (RouteCollectorProxy $group) {
        $group->get('', UserFindAllAction::class);
        $group->post('', UserCreateAction::class);
    });
    $app->group('/societes', function (RouteCollectorProxy $group) {
        $group->get('', SocieteFindAllAction::class);
        $group->post('', SocieteCreateAction::class);
    });
    $app->group('/societe-types', function (RouteCollectorProxy $group) {
        $group->get('', SocieteTypeFindAllAction::class);
        $group->post('', SocieteTypeCreateAction::class);
    });
};
