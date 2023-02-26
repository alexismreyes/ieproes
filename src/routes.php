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

    // asignatura_tbl
    $app->map(["GET","POST","OPTIONS"], '/AsignaturaTblList[/{id_asignatura}]', AsignaturaTblController::class . ':list')->add(PermissionMiddleware::class)->setName('AsignaturaTblList-asignatura_tbl-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AsignaturaTblAdd[/{id_asignatura}]', AsignaturaTblController::class . ':add')->add(PermissionMiddleware::class)->setName('AsignaturaTblAdd-asignatura_tbl-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AsignaturaTblEdit[/{id_asignatura}]', AsignaturaTblController::class . ':edit')->add(PermissionMiddleware::class)->setName('AsignaturaTblEdit-asignatura_tbl-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AsignaturaTblDelete[/{id_asignatura}]', AsignaturaTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('AsignaturaTblDelete-asignatura_tbl-delete'); // delete
    $app->group(
        '/asignatura_tbl',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_asignatura}]', AsignaturaTblController::class . ':list')->add(PermissionMiddleware::class)->setName('asignatura_tbl/list-asignatura_tbl-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id_asignatura}]', AsignaturaTblController::class . ':add')->add(PermissionMiddleware::class)->setName('asignatura_tbl/add-asignatura_tbl-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id_asignatura}]', AsignaturaTblController::class . ':edit')->add(PermissionMiddleware::class)->setName('asignatura_tbl/edit-asignatura_tbl-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id_asignatura}]', AsignaturaTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('asignatura_tbl/delete-asignatura_tbl-delete-2'); // delete
        }
    );

    // calificacion_tbl
    $app->map(["GET","POST","OPTIONS"], '/CalificacionTblList[/{id_calificacion}]', CalificacionTblController::class . ':list')->add(PermissionMiddleware::class)->setName('CalificacionTblList-calificacion_tbl-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CalificacionTblAdd[/{id_calificacion}]', CalificacionTblController::class . ':add')->add(PermissionMiddleware::class)->setName('CalificacionTblAdd-calificacion_tbl-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CalificacionTblDelete[/{id_calificacion}]', CalificacionTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('CalificacionTblDelete-calificacion_tbl-delete'); // delete
    $app->group(
        '/calificacion_tbl',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_calificacion}]', CalificacionTblController::class . ':list')->add(PermissionMiddleware::class)->setName('calificacion_tbl/list-calificacion_tbl-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id_calificacion}]', CalificacionTblController::class . ':add')->add(PermissionMiddleware::class)->setName('calificacion_tbl/add-calificacion_tbl-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id_calificacion}]', CalificacionTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('calificacion_tbl/delete-calificacion_tbl-delete-2'); // delete
        }
    );

    // usuarios_tbl
    $app->map(["GET","POST","OPTIONS"], '/UsuariosTblList[/{id_usuario}]', UsuariosTblController::class . ':list')->add(PermissionMiddleware::class)->setName('UsuariosTblList-usuarios_tbl-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UsuariosTblAdd[/{id_usuario}]', UsuariosTblController::class . ':add')->add(PermissionMiddleware::class)->setName('UsuariosTblAdd-usuarios_tbl-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UsuariosTblEdit[/{id_usuario}]', UsuariosTblController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsuariosTblEdit-usuarios_tbl-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UsuariosTblDelete[/{id_usuario}]', UsuariosTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsuariosTblDelete-usuarios_tbl-delete'); // delete
    $app->group(
        '/usuarios_tbl',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_usuario}]', UsuariosTblController::class . ':list')->add(PermissionMiddleware::class)->setName('usuarios_tbl/list-usuarios_tbl-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id_usuario}]', UsuariosTblController::class . ':add')->add(PermissionMiddleware::class)->setName('usuarios_tbl/add-usuarios_tbl-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id_usuario}]', UsuariosTblController::class . ':edit')->add(PermissionMiddleware::class)->setName('usuarios_tbl/edit-usuarios_tbl-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id_usuario}]', UsuariosTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('usuarios_tbl/delete-usuarios_tbl-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsList[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsList-userlevelpermissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsAdd[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsAdd-userlevelpermissions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsView[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsView-userlevelpermissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsEdit[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsEdit-userlevelpermissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsDelete[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsDelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsList[/{UserLevelID}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelsList-userlevels-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsAdd[/{UserLevelID}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelsAdd-userlevels-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsEdit[/{UserLevelID}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelsEdit-userlevels-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsDelete[/{UserLevelID}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelsDelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{UserLevelID}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{UserLevelID}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{UserLevelID}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{UserLevelID}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // alumnos_asignatura_tbl
    $app->map(["GET","POST","OPTIONS"], '/AlumnosAsignaturaTblList[/{id_alumnosasignatura}]', AlumnosAsignaturaTblController::class . ':list')->add(PermissionMiddleware::class)->setName('AlumnosAsignaturaTblList-alumnos_asignatura_tbl-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AlumnosAsignaturaTblAdd[/{id_alumnosasignatura}]', AlumnosAsignaturaTblController::class . ':add')->add(PermissionMiddleware::class)->setName('AlumnosAsignaturaTblAdd-alumnos_asignatura_tbl-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AlumnosAsignaturaTblDelete[/{id_alumnosasignatura}]', AlumnosAsignaturaTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('AlumnosAsignaturaTblDelete-alumnos_asignatura_tbl-delete'); // delete
    $app->group(
        '/alumnos_asignatura_tbl',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_alumnosasignatura}]', AlumnosAsignaturaTblController::class . ':list')->add(PermissionMiddleware::class)->setName('alumnos_asignatura_tbl/list-alumnos_asignatura_tbl-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id_alumnosasignatura}]', AlumnosAsignaturaTblController::class . ':add')->add(PermissionMiddleware::class)->setName('alumnos_asignatura_tbl/add-alumnos_asignatura_tbl-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id_alumnosasignatura}]', AlumnosAsignaturaTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('alumnos_asignatura_tbl/delete-alumnos_asignatura_tbl-delete-2'); // delete
        }
    );

    // alumnosporasigntura_vw
    $app->map(["GET","POST","OPTIONS"], '/AlumnosporasignturaVwList[/{id_alumno}]', AlumnosporasignturaVwController::class . ':list')->add(PermissionMiddleware::class)->setName('AlumnosporasignturaVwList-alumnosporasigntura_vw-list'); // list
    $app->group(
        '/alumnosporasigntura_vw',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_alumno}]', AlumnosporasignturaVwController::class . ':list')->add(PermissionMiddleware::class)->setName('alumnosporasigntura_vw/list-alumnosporasigntura_vw-list-2'); // list
        }
    );

    // evaluacion_tbl
    $app->map(["GET","POST","OPTIONS"], '/EvaluacionTblList[/{id_evaluacion}]', EvaluacionTblController::class . ':list')->add(PermissionMiddleware::class)->setName('EvaluacionTblList-evaluacion_tbl-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/EvaluacionTblAdd[/{id_evaluacion}]', EvaluacionTblController::class . ':add')->add(PermissionMiddleware::class)->setName('EvaluacionTblAdd-evaluacion_tbl-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/EvaluacionTblAddopt', EvaluacionTblController::class . ':addopt')->add(PermissionMiddleware::class)->setName('EvaluacionTblAddopt-evaluacion_tbl-addopt'); // addopt
    $app->map(["GET","POST","OPTIONS"], '/EvaluacionTblView[/{id_evaluacion}]', EvaluacionTblController::class . ':view')->add(PermissionMiddleware::class)->setName('EvaluacionTblView-evaluacion_tbl-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/EvaluacionTblEdit[/{id_evaluacion}]', EvaluacionTblController::class . ':edit')->add(PermissionMiddleware::class)->setName('EvaluacionTblEdit-evaluacion_tbl-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/EvaluacionTblDelete[/{id_evaluacion}]', EvaluacionTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('EvaluacionTblDelete-evaluacion_tbl-delete'); // delete
    $app->group(
        '/evaluacion_tbl',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_evaluacion}]', EvaluacionTblController::class . ':list')->add(PermissionMiddleware::class)->setName('evaluacion_tbl/list-evaluacion_tbl-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id_evaluacion}]', EvaluacionTblController::class . ':add')->add(PermissionMiddleware::class)->setName('evaluacion_tbl/add-evaluacion_tbl-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADDOPT_ACTION') . '', EvaluacionTblController::class . ':addopt')->add(PermissionMiddleware::class)->setName('evaluacion_tbl/addopt-evaluacion_tbl-addopt-2'); // addopt
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id_evaluacion}]', EvaluacionTblController::class . ':view')->add(PermissionMiddleware::class)->setName('evaluacion_tbl/view-evaluacion_tbl-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id_evaluacion}]', EvaluacionTblController::class . ':edit')->add(PermissionMiddleware::class)->setName('evaluacion_tbl/edit-evaluacion_tbl-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id_evaluacion}]', EvaluacionTblController::class . ':delete')->add(PermissionMiddleware::class)->setName('evaluacion_tbl/delete-evaluacion_tbl-delete-2'); // delete
        }
    );

    // asignaturas_vw
    $app->map(["GET","POST","OPTIONS"], '/AsignaturasVwList[/{id_asignatura}]', AsignaturasVwController::class . ':list')->add(PermissionMiddleware::class)->setName('AsignaturasVwList-asignaturas_vw-list'); // list
    $app->group(
        '/asignaturas_vw',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id_asignatura}]', AsignaturasVwController::class . ':list')->add(PermissionMiddleware::class)->setName('asignaturas_vw/list-asignaturas_vw-list-2'); // list
        }
    );

    // calificacionesxalumno_vw
    $app->map(["GET","POST","OPTIONS"], '/CalificacionesxalumnoVwList', CalificacionesxalumnoVwController::class . ':list')->add(PermissionMiddleware::class)->setName('CalificacionesxalumnoVwList-calificacionesxalumno_vw-list'); // list
    $app->group(
        '/calificacionesxalumno_vw',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '', CalificacionesxalumnoVwController::class . ':list')->add(PermissionMiddleware::class)->setName('calificacionesxalumno_vw/list-calificacionesxalumno_vw-list-2'); // list
        }
    );

    // calificacionesxalumno_rpt
    $app->map(["GET", "POST", "OPTIONS"], '/CalificacionesxalumnoRpt', CalificacionesxalumnoRptController::class . ':summary')->add(PermissionMiddleware::class)->setName('CalificacionesxalumnoRpt-calificacionesxalumno_rpt-summary'); // summary

    // promedioxasignatura_vw
    $app->map(["GET","POST","OPTIONS"], '/PromedioxasignaturaVwList', PromedioxasignaturaVwController::class . ':list')->add(PermissionMiddleware::class)->setName('PromedioxasignaturaVwList-promedioxasignatura_vw-list'); // list
    $app->group(
        '/promedioxasignatura_vw',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '', PromedioxasignaturaVwController::class . ':list')->add(PermissionMiddleware::class)->setName('promedioxasignatura_vw/list-promedioxasignatura_vw-list-2'); // list
        }
    );

    // promedioxasignatura_rpt
    $app->map(["GET", "POST", "OPTIONS"], '/PromedioxasignaturaRpt/promediopormateria_chart', PromedioxasignaturaRptController::class . ':promediopormateria_chart')->add(PermissionMiddleware::class)->setName('PromedioxasignaturaRpt-promedioxasignatura_rpt-summary-promediopormateria_chart'); // promediopormateria_chart
    $app->map(["GET", "POST", "OPTIONS"], '/PromedioxasignaturaRpt/alumnosporasignatura_chart', PromedioxasignaturaRptController::class . ':alumnosporasignatura_chart')->add(PermissionMiddleware::class)->setName('PromedioxasignaturaRpt-promedioxasignatura_rpt-summary-alumnosporasignatura_chart'); // alumnosporasignatura_chart
    $app->map(["GET", "POST", "OPTIONS"], '/PromedioxasignaturaRpt', PromedioxasignaturaRptController::class . ':summary')->add(PermissionMiddleware::class)->setName('PromedioxasignaturaRpt-promedioxasignatura_rpt-summary'); // summary

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login[/{provider}]', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // userpriv
    $app->map(["GET","POST","OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

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
