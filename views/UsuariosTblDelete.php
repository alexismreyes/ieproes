<?php

namespace PHPMaker2023\ieproes;

// Page object
$UsuariosTblDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { usuarios_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fusuarios_tbldelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusuarios_tbldelete")
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
<form name="fusuarios_tbldelete" id="fusuarios_tbldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="usuarios_tbl">
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
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
        <th class="<?= $Page->id_usuario->headerCellClass() ?>"><span id="elh_usuarios_tbl_id_usuario" class="usuarios_tbl_id_usuario"><?= $Page->id_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tipo_usuario->Visible) { // tipo_usuario ?>
        <th class="<?= $Page->tipo_usuario->headerCellClass() ?>"><span id="elh_usuarios_tbl_tipo_usuario" class="usuarios_tbl_tipo_usuario"><?= $Page->tipo_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nombre_usuario->Visible) { // nombre_usuario ?>
        <th class="<?= $Page->nombre_usuario->headerCellClass() ?>"><span id="elh_usuarios_tbl_nombre_usuario" class="usuarios_tbl_nombre_usuario"><?= $Page->nombre_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($Page->login_usuario->Visible) { // login_usuario ?>
        <th class="<?= $Page->login_usuario->headerCellClass() ?>"><span id="elh_usuarios_tbl_login_usuario" class="usuarios_tbl_login_usuario"><?= $Page->login_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($Page->password_usuario->Visible) { // password_usuario ?>
        <th class="<?= $Page->password_usuario->headerCellClass() ?>"><span id="elh_usuarios_tbl_password_usuario" class="usuarios_tbl_password_usuario"><?= $Page->password_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email_usuario->Visible) { // email_usuario ?>
        <th class="<?= $Page->email_usuario->headerCellClass() ?>"><span id="elh_usuarios_tbl_email_usuario" class="usuarios_tbl_email_usuario"><?= $Page->email_usuario->caption() ?></span></th>
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
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
        <td<?= $Page->id_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_id_usuario" class="el_usuarios_tbl_id_usuario">
<span<?= $Page->id_usuario->viewAttributes() ?>>
<?= $Page->id_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tipo_usuario->Visible) { // tipo_usuario ?>
        <td<?= $Page->tipo_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_tipo_usuario" class="el_usuarios_tbl_tipo_usuario">
<span<?= $Page->tipo_usuario->viewAttributes() ?>>
<?= $Page->tipo_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nombre_usuario->Visible) { // nombre_usuario ?>
        <td<?= $Page->nombre_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_nombre_usuario" class="el_usuarios_tbl_nombre_usuario">
<span<?= $Page->nombre_usuario->viewAttributes() ?>>
<?= $Page->nombre_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->login_usuario->Visible) { // login_usuario ?>
        <td<?= $Page->login_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_login_usuario" class="el_usuarios_tbl_login_usuario">
<span<?= $Page->login_usuario->viewAttributes() ?>>
<?= $Page->login_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->password_usuario->Visible) { // password_usuario ?>
        <td<?= $Page->password_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_password_usuario" class="el_usuarios_tbl_password_usuario">
<span<?= $Page->password_usuario->viewAttributes() ?>>
<?= $Page->password_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->email_usuario->Visible) { // email_usuario ?>
        <td<?= $Page->email_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_email_usuario" class="el_usuarios_tbl_email_usuario">
<span<?= $Page->email_usuario->viewAttributes() ?>>
<?= $Page->email_usuario->getViewValue() ?></span>
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
