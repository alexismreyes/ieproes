<?php

namespace PHPMaker2023\ieproes;

/**
 * Chart renderer interface
 */
interface ChartRendererInterface
{

    public function getContainer($width, $height);

    public function getScript($width, $height);
}
