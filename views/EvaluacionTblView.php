<?php

namespace PHPMaker2023\ieproes;

// Page object
$EvaluacionTblView = &$Page;
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
<form name="fevaluacion_tblview" id="fevaluacion_tblview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { evaluacion_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fevaluacion_tblview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fevaluacion_tblview")
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
<input type="hidden" name="t" value="evaluacion_tbl">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->nombre_evaluacion->Visible) { // nombre_evaluacion ?>
    <tr id="r_nombre_evaluacion"<?= $Page->nombre_evaluacion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_evaluacion_tbl_nombre_evaluacion"><?= $Page->nombre_evaluacion->caption() ?></span></td>
        <td data-name="nombre_evaluacion"<?= $Page->nombre_evaluacion->cellAttributes() ?>>
<span id="el_evaluacion_tbl_nombre_evaluacion">
<span<?= $Page->nombre_evaluacion->viewAttributes() ?>>
<?= $Page->nombre_evaluacion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->descripcion_evaluacion->Visible) { // descripcion_evaluacion ?>
    <tr id="r_descripcion_evaluacion"<?= $Page->descripcion_evaluacion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_evaluacion_tbl_descripcion_evaluacion"><?= $Page->descripcion_evaluacion->caption() ?></span></td>
        <td data-name="descripcion_evaluacion"<?= $Page->descripcion_evaluacion->cellAttributes() ?>>
<span id="el_evaluacion_tbl_descripcion_evaluacion">
<span<?= $Page->descripcion_evaluacion->viewAttributes() ?>>
<?= $Page->descripcion_evaluacion->getViewValue() ?></span>
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
