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
$sideMenu->addMenuItem(1, "mi_alumnotbl", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "AlumnotblList", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
