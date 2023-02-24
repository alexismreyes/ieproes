<?php

namespace PHPMaker2023\ieproes;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Exception\HttpNotFoundException;

// Handle Routes
return function (App $app) {
    // alumnotbl
    $app->map(["GET","POST","OPTIONS"], '/AlumnotblList[/{id_alumno}]', AlumnotblController::class . ':list')->add(PermissionMiddleware::class)->setName('AlumnotblList-alumnotbl-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AlumnotblAdd[/{id_alumno}]', AlumnotblController::class . ':add')->add(PermissionMiddleware::class)->setName('AlumnotblAdd-alumnotbl-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AlumnotblView[/{id_alumno}]', AlumnotblController::class . ':view')->add(PermissionMiddleware::class)->setName('AlumnotblView-alumnotbl-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AlumnotblEdit[/{id_alumno}]', AlumnotblController::class . ':edit')->add(PermissionMiddleware::class)->setName('AlumnotblEdit-alumnotbl-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AlumnotblDelete[/{id_alumno}]', AlumnotblController::class . ':delete')->add(PermissionMiddleware::class)->setName('AlumnotblDelete-alumnotbl-delete'); // delete
    $app->group(
        '/alumnotbl',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_alumno}]', AlumnotblController::class . ':list')->add(PermissionMiddleware::class)->setName('alumnotbl/list-alumnotbl-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id_alumno}]', AlumnotblController::class . ':add')->add(PermissionMiddleware::class)->setName('alumnotbl/add-alumnotbl-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id_alumno}]', AlumnotblController::class . ':view')->add(PermissionMiddleware::class)->setName('alumnotbl/view-alumnotbl-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id_alumno}]', AlumnotblController::class . ':edit')->add(PermissionMiddleware::class)->setName('alumnotbl/edit-alumnotbl-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id_alumno}]', AlumnotblController::class . ':delete')->add(PermissionMiddleware::class)->setName('alumnotbl/delete-alumnotbl-delete-2'); // delete
        }
    );

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            throw new HttpNotFoundException($request, str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")));
        }
    );
};
