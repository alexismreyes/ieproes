<?php

namespace PHPMaker2023\ieproes;

// Page object
$AsignaturaTblView = &$Page;
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
<form name="fasignatura_tblview" id="fasignatura_tblview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { asignatura_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fasignatura_tblview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fasignatura_tblview")
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
<input type="hidden" name="t" value="asignatura_tbl">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->nombre_asignatura->Visible) { // nombre_asignatura ?>
    <tr id="r_nombre_asignatura"<?= $Page->nombre_asignatura->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_asignatura_tbl_nombre_asignatura"><?= $Page->nombre_asignatura->caption() ?></span></td>
        <td data-name="nombre_asignatura"<?= $Page->nombre_asignatura->cellAttributes() ?>>
<span id="el_asignatura_tbl_nombre_asignatura">
<span<?= $Page->nombre_asignatura->viewAttributes() ?>>
<?= $Page->nombre_asignatura->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_profesor->Visible) { // id_profesor ?>
    <tr id="r_id_profesor"<?= $Page->id_profesor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_asignatura_tbl_id_profesor"><?= $Page->id_profesor->caption() ?></span></td>
        <td data-name="id_profesor"<?= $Page->id_profesor->cellAttributes() ?>>
<span id="el_asignatura_tbl_id_profesor">
<span<?= $Page->id_profesor->viewAttributes() ?>>
<?= $Page->id_profesor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("calificacion_tbl", explode(",", $Page->getCurrentDetailTable())) && $calificacion_tbl->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("calificacion_tbl", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "CalificacionTblGrid.php" ?>
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
