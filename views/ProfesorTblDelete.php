<?php

namespace PHPMaker2023\ieproes;

// Page object
$ProfesorTblDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { profesor_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fprofesor_tbldelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprofesor_tbldelete")
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
<form name="fprofesor_tbldelete" id="fprofesor_tbldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="profesor_tbl">
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
<?php if ($Page->id_profesor->Visible) { // id_profesor ?>
        <th class="<?= $Page->id_profesor->headerCellClass() ?>"><span id="elh_profesor_tbl_id_profesor" class="profesor_tbl_id_profesor"><?= $Page->id_profesor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nombre_profesor->Visible) { // nombre_profesor ?>
        <th class="<?= $Page->nombre_profesor->headerCellClass() ?>"><span id="elh_profesor_tbl_nombre_profesor" class="profesor_tbl_nombre_profesor"><?= $Page->nombre_profesor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dui_profesor->Visible) { // dui_profesor ?>
        <th class="<?= $Page->dui_profesor->headerCellClass() ?>"><span id="elh_profesor_tbl_dui_profesor" class="profesor_tbl_dui_profesor"><?= $Page->dui_profesor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->direccion_profesor->Visible) { // direccion_profesor ?>
        <th class="<?= $Page->direccion_profesor->headerCellClass() ?>"><span id="elh_profesor_tbl_direccion_profesor" class="profesor_tbl_direccion_profesor"><?= $Page->direccion_profesor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->telefono_profesor->Visible) { // telefono_profesor ?>
        <th class="<?= $Page->telefono_profesor->headerCellClass() ?>"><span id="elh_profesor_tbl_telefono_profesor" class="profesor_tbl_telefono_profesor"><?= $Page->telefono_profesor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email_profesor->Visible) { // email_profesor ?>
        <th class="<?= $Page->email_profesor->headerCellClass() ?>"><span id="elh_profesor_tbl_email_profesor" class="profesor_tbl_email_profesor"><?= $Page->email_profesor->caption() ?></span></th>
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
<?php if ($Page->id_profesor->Visible) { // id_profesor ?>
        <td<?= $Page->id_profesor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_profesor_tbl_id_profesor" class="el_profesor_tbl_id_profesor">
<span<?= $Page->id_profesor->viewAttributes() ?>>
<?= $Page->id_profesor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nombre_profesor->Visible) { // nombre_profesor ?>
        <td<?= $Page->nombre_profesor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_profesor_tbl_nombre_profesor" class="el_profesor_tbl_nombre_profesor">
<span<?= $Page->nombre_profesor->viewAttributes() ?>>
<?= $Page->nombre_profesor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dui_profesor->Visible) { // dui_profesor ?>
        <td<?= $Page->dui_profesor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_profesor_tbl_dui_profesor" class="el_profesor_tbl_dui_profesor">
<span<?= $Page->dui_profesor->viewAttributes() ?>>
<?= $Page->dui_profesor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->direccion_profesor->Visible) { // direccion_profesor ?>
        <td<?= $Page->direccion_profesor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_profesor_tbl_direccion_profesor" class="el_profesor_tbl_direccion_profesor">
<span<?= $Page->direccion_profesor->viewAttributes() ?>>
<?= $Page->direccion_profesor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->telefono_profesor->Visible) { // telefono_profesor ?>
        <td<?= $Page->telefono_profesor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_profesor_tbl_telefono_profesor" class="el_profesor_tbl_telefono_profesor">
<span<?= $Page->telefono_profesor->viewAttributes() ?>>
<?= $Page->telefono_profesor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->email_profesor->Visible) { // email_profesor ?>
        <td<?= $Page->email_profesor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_profesor_tbl_email_profesor" class="el_profesor_tbl_email_profesor">
<span<?= $Page->email_profesor->viewAttributes() ?>>
<?= $Page->email_profesor->getViewValue() ?></span>
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
