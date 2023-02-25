<?php

namespace PHPMaker2023\ieproes;

// Page object
$AlumnotblView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="falumnotblview" id="falumnotblview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnotbl: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var falumnotblview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("falumnotblview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="alumnotbl">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->nombre_alumno->Visible) { // nombre_alumno ?>
    <tr id="r_nombre_alumno"<?= $Page->nombre_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_alumnotbl_nombre_alumno"><?= $Page->nombre_alumno->caption() ?></span></td>
        <td data-name="nombre_alumno"<?= $Page->nombre_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_nombre_alumno">
<span<?= $Page->nombre_alumno->viewAttributes() ?>>
<?= $Page->nombre_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->apellidos_alumno->Visible) { // apellidos_alumno ?>
    <tr id="r_apellidos_alumno"<?= $Page->apellidos_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_alumnotbl_apellidos_alumno"><?= $Page->apellidos_alumno->caption() ?></span></td>
        <td data-name="apellidos_alumno"<?= $Page->apellidos_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_apellidos_alumno">
<span<?= $Page->apellidos_alumno->viewAttributes() ?>>
<?= $Page->apellidos_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->numcarnet_alumno->Visible) { // numcarnet_alumno ?>
    <tr id="r_numcarnet_alumno"<?= $Page->numcarnet_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_alumnotbl_numcarnet_alumno"><?= $Page->numcarnet_alumno->caption() ?></span></td>
        <td data-name="numcarnet_alumno"<?= $Page->numcarnet_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_numcarnet_alumno">
<span<?= $Page->numcarnet_alumno->viewAttributes() ?>>
<?= $Page->numcarnet_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->genero_alumno->Visible) { // genero_alumno ?>
    <tr id="r_genero_alumno"<?= $Page->genero_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_alumnotbl_genero_alumno"><?= $Page->genero_alumno->caption() ?></span></td>
        <td data-name="genero_alumno"<?= $Page->genero_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_genero_alumno">
<span<?= $Page->genero_alumno->viewAttributes() ?>>
<?= $Page->genero_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fechanac_alumno->Visible) { // fechanac_alumno ?>
    <tr id="r_fechanac_alumno"<?= $Page->fechanac_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_alumnotbl_fechanac_alumno"><?= $Page->fechanac_alumno->caption() ?></span></td>
        <td data-name="fechanac_alumno"<?= $Page->fechanac_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_fechanac_alumno">
<span<?= $Page->fechanac_alumno->viewAttributes() ?>>
<?= $Page->fechanac_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->direccion_alumno->Visible) { // direccion_alumno ?>
    <tr id="r_direccion_alumno"<?= $Page->direccion_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_alumnotbl_direccion_alumno"><?= $Page->direccion_alumno->caption() ?></span></td>
        <td data-name="direccion_alumno"<?= $Page->direccion_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_direccion_alumno">
<span<?= $Page->direccion_alumno->viewAttributes() ?>>
<?= $Page->direccion_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->telefono_alumno->Visible) { // telefono_alumno ?>
    <tr id="r_telefono_alumno"<?= $Page->telefono_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_alumnotbl_telefono_alumno"><?= $Page->telefono_alumno->caption() ?></span></td>
        <td data-name="telefono_alumno"<?= $Page->telefono_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_telefono_alumno">
<span<?= $Page->telefono_alumno->viewAttributes() ?>>
<?= $Page->telefono_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("alumnos_asignatura_tbl", explode(",", $Page->getCurrentDetailTable())) && $alumnos_asignatura_tbl->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("alumnos_asignatura_tbl", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AlumnosAsignaturaTblGrid.php" ?>
<?php } ?>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
