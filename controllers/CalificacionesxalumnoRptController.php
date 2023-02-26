<?php

namespace PHPMaker2023\ieproes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * calificacionesxalumno_rpt controller
 */
class CalificacionesxalumnoRptController extends ControllerBase
{
    // summary
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "CalificacionesxalumnoRptSummary");
    }
}
