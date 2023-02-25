<?php

namespace PHPMaker2023\ieproes;

// Page object
$CalificacionTblView = &$Page;
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
<form name="fcalificacion_tblview" id="fcalificacion_tblview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { calificacion_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fcalificacion_tblview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcalificacion_tblview")
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
<input type="hidden" name="t" value="calificacion_tbl">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
    <tr id="r_fk_id_asignatura"<?= $Page->fk_id_asignatura->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_calificacion_tbl_fk_id_asignatura"><?= $Page->fk_id_asignatura->caption() ?></span></td>
        <td data-name="fk_id_asignatura"<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<span id="el_calificacion_tbl_fk_id_asignatura">
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<?= $Page->fk_id_asignatura->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
    <tr id="r_fk_id_alumno"<?= $Page->fk_id_alumno->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_calificacion_tbl_fk_id_alumno"><?= $Page->fk_id_alumno->caption() ?></span></td>
        <td data-name="fk_id_alumno"<?= $Page->fk_id_alumno->cellAttributes() ?>>
<span id="el_calificacion_tbl_fk_id_alumno">
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<?= $Page->fk_id_alumno->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { // nota_calificacion ?>
    <tr id="r_nota_calificacion"<?= $Page->nota_calificacion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_calificacion_tbl_nota_calificacion"><?= $Page->nota_calificacion->caption() ?></span></td>
        <td data-name="nota_calificacion"<?= $Page->nota_calificacion->cellAttributes() ?>>
<span id="el_calificacion_tbl_nota_calificacion">
<span<?= $Page->nota_calificacion->viewAttributes() ?>>
<?= $Page->nota_calificacion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->observacion_calificacion->Visible) { // observacion_calificacion ?>
    <tr id="r_observacion_calificacion"<?= $Page->observacion_calificacion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_calificacion_tbl_observacion_calificacion"><?= $Page->observacion_calificacion->caption() ?></span></td>
        <td data-name="observacion_calificacion"<?= $Page->observacion_calificacion->cellAttributes() ?>>
<span id="el_calificacion_tbl_observacion_calificacion">
<span<?= $Page->observacion_calificacion->viewAttributes() ?>>
<?= $Page->observacion_calificacion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
    <tr id="r_fk_id_evaluacion"<?= $Page->fk_id_evaluacion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_calificacion_tbl_fk_id_evaluacion"><?= $Page->fk_id_evaluacion->caption() ?></span></td>
        <td data-name="fk_id_evaluacion"<?= $Page->fk_id_evaluacion->cellAttributes() ?>>
<span id="el_calificacion_tbl_fk_id_evaluacion">
<span<?= $Page->fk_id_evaluacion->viewAttributes() ?>>
<?= $Page->fk_id_evaluacion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
