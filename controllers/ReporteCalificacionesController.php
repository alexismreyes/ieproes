<?php

namespace PHPMaker2023\ieproes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * ReporteCalificaciones controller
 */
class ReporteCalificacionesController extends ControllerBase
{
    // summary
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReporteCalificacionesSummary");
    }
}
