<?php

namespace PHPMaker2023\ieproes;

// Page object
$AlumnosAsignaturaTblDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnos_asignatura_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var falumnos_asignatura_tbldelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("falumnos_asignatura_tbldelete")
        .setPageId("delete")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="falumnos_asignatura_tbldelete" id="falumnos_asignatura_tbldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="alumnos_asignatura_tbl">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <th class="<?= $Page->fk_id_asignatura->headerCellClass() ?>"><span id="elh_alumnos_asignatura_tbl_fk_id_asignatura" class="alumnos_asignatura_tbl_fk_id_asignatura"><?= $Page->fk_id_asignatura->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
        <th class="<?= $Page->fk_id_alumno->headerCellClass() ?>"><span id="elh_alumnos_asignatura_tbl_fk_id_alumno" class="alumnos_asignatura_tbl_fk_id_alumno"><?= $Page->fk_id_alumno->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <td<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnos_asignatura_tbl_fk_id_asignatura" class="el_alumnos_asignatura_tbl_fk_id_asignatura">
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<?= $Page->fk_id_asignatura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
        <td<?= $Page->fk_id_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnos_asignatura_tbl_fk_id_alumno" class="el_alumnos_asignatura_tbl_fk_id_alumno">
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<?= $Page->fk_id_alumno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
