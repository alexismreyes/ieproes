<?php

namespace PHPMaker2023\ieproes;

// Page object
$AlumnotblDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnotbl: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var falumnotbldelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("falumnotbldelete")
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
<form name="falumnotbldelete" id="falumnotbldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="alumnotbl">
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
<?php if ($Page->nombre_alumno->Visible) { // nombre_alumno ?>
        <th class="<?= $Page->nombre_alumno->headerCellClass() ?>"><span id="elh_alumnotbl_nombre_alumno" class="alumnotbl_nombre_alumno"><?= $Page->nombre_alumno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->apellidos_alumno->Visible) { // apellidos_alumno ?>
        <th class="<?= $Page->apellidos_alumno->headerCellClass() ?>"><span id="elh_alumnotbl_apellidos_alumno" class="alumnotbl_apellidos_alumno"><?= $Page->apellidos_alumno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->numcarnet_alumno->Visible) { // numcarnet_alumno ?>
        <th class="<?= $Page->numcarnet_alumno->headerCellClass() ?>"><span id="elh_alumnotbl_numcarnet_alumno" class="alumnotbl_numcarnet_alumno"><?= $Page->numcarnet_alumno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->genero_alumno->Visible) { // genero_alumno ?>
        <th class="<?= $Page->genero_alumno->headerCellClass() ?>"><span id="elh_alumnotbl_genero_alumno" class="alumnotbl_genero_alumno"><?= $Page->genero_alumno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fechanac_alumno->Visible) { // fechanac_alumno ?>
        <th class="<?= $Page->fechanac_alumno->headerCellClass() ?>"><span id="elh_alumnotbl_fechanac_alumno" class="alumnotbl_fechanac_alumno"><?= $Page->fechanac_alumno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->direccion_alumno->Visible) { // direccion_alumno ?>
        <th class="<?= $Page->direccion_alumno->headerCellClass() ?>"><span id="elh_alumnotbl_direccion_alumno" class="alumnotbl_direccion_alumno"><?= $Page->direccion_alumno->caption() ?></span></th>
<?php } ?>
<?php if ($Page->telefono_alumno->Visible) { // telefono_alumno ?>
        <th class="<?= $Page->telefono_alumno->headerCellClass() ?>"><span id="elh_alumnotbl_telefono_alumno" class="alumnotbl_telefono_alumno"><?= $Page->telefono_alumno->caption() ?></span></th>
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
<?php if ($Page->nombre_alumno->Visible) { // nombre_alumno ?>
        <td<?= $Page->nombre_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnotbl_nombre_alumno" class="el_alumnotbl_nombre_alumno">
<span<?= $Page->nombre_alumno->viewAttributes() ?>>
<?= $Page->nombre_alumno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->apellidos_alumno->Visible) { // apellidos_alumno ?>
        <td<?= $Page->apellidos_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnotbl_apellidos_alumno" class="el_alumnotbl_apellidos_alumno">
<span<?= $Page->apellidos_alumno->viewAttributes() ?>>
<?= $Page->apellidos_alumno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->numcarnet_alumno->Visible) { // numcarnet_alumno ?>
        <td<?= $Page->numcarnet_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnotbl_numcarnet_alumno" class="el_alumnotbl_numcarnet_alumno">
<span<?= $Page->numcarnet_alumno->viewAttributes() ?>>
<?= $Page->numcarnet_alumno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->genero_alumno->Visible) { // genero_alumno ?>
        <td<?= $Page->genero_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnotbl_genero_alumno" class="el_alumnotbl_genero_alumno">
<span<?= $Page->genero_alumno->viewAttributes() ?>>
<?= $Page->genero_alumno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fechanac_alumno->Visible) { // fechanac_alumno ?>
        <td<?= $Page->fechanac_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnotbl_fechanac_alumno" class="el_alumnotbl_fechanac_alumno">
<span<?= $Page->fechanac_alumno->viewAttributes() ?>>
<?= $Page->fechanac_alumno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->direccion_alumno->Visible) { // direccion_alumno ?>
        <td<?= $Page->direccion_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnotbl_direccion_alumno" class="el_alumnotbl_direccion_alumno">
<span<?= $Page->direccion_alumno->viewAttributes() ?>>
<?= $Page->direccion_alumno->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->telefono_alumno->Visible) { // telefono_alumno ?>
        <td<?= $Page->telefono_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnotbl_telefono_alumno" class="el_alumnotbl_telefono_alumno">
<span<?= $Page->telefono_alumno->viewAttributes() ?>>
<?= $Page->telefono_alumno->getViewValue() ?></span>
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
