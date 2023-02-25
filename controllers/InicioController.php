<?php

namespace PHPMaker2023\ieproes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * inicio controller
 */
class InicioController extends ControllerBase
{
    // custom
    public function custom(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Inicio");
    }
}
