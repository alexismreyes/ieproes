<?php

namespace PHPMaker2023\ieproes;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_alumnotbl", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "AlumnotblList", -1, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnotbl'), false, false, "", "", false, true);
$sideMenu->addMenuItem(2, "mi_asignatura_tbl", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "AsignaturaTblList", -1, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignatura_tbl'), false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_evaluacion_tbl", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "EvaluacionTblList", -1, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}evaluacion_tbl'), false, false, "", "", false, true);
$sideMenu->addMenuItem(26, "mci_Reportes", $MenuLanguage->MenuPhrase("26", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(13, "mi_calificacionesxalumno_rpt", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "CalificacionesxalumnoRpt", 26, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacionesxalumno_rpt'), false, false, "", "", false, true);
$sideMenu->addMenuItem(15, "mi_promedioxasignatura_rpt", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "PromedioxasignaturaRpt", 26, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}promedioxasignatura_rpt'), false, false, "", "", false, true);
$sideMenu->addMenuItem(5, "mi_usuarios_tbl", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "UsuariosTblList", -1, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}usuarios_tbl'), false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "UserlevelpermissionsList", -1, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevelpermissions'), false, false, "", "", false, true);
$sideMenu->addMenuItem(7, "mi_userlevels", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "UserlevelsList", -1, "", AllowListMenu('{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevels'), false, false, "", "", false, true);
echo $sideMenu->toScript();
