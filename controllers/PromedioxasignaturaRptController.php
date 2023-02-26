<?php

namespace PHPMaker2023\ieproes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * promedioxasignatura_rpt controller
 */
class PromedioxasignaturaRptController extends ControllerBase
{
    // summary
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PromedioxasignaturaRptSummary");
    }

    // promediopormateria_chart
    public function promediopormateria_chart(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "PromedioxasignaturaRptSummary", "promediopormateria_chart");
    }

    // alumnosporasignatura_chart
    public function alumnosporasignatura_chart(Request $request, Response $response, array $args): Response
    {
        return $this->runChart($request, $response, $args, "PromedioxasignaturaRptSummary", "alumnosporasignatura_chart");
    }
}
