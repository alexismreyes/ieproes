<?php

namespace PHPMaker2023\ieproes;

// Page object
$UsuariosTblView = &$Page;
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
<form name="fusuarios_tblview" id="fusuarios_tblview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { usuarios_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fusuarios_tblview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusuarios_tblview")
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
<input type="hidden" name="t" value="usuarios_tbl">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
    <tr id="r_id_usuario"<?= $Page->id_usuario->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_tbl_id_usuario"><?= $Page->id_usuario->caption() ?></span></td>
        <td data-name="id_usuario"<?= $Page->id_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_id_usuario">
<span<?= $Page->id_usuario->viewAttributes() ?>>
<?= $Page->id_usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tipo_usuario->Visible) { // tipo_usuario ?>
    <tr id="r_tipo_usuario"<?= $Page->tipo_usuario->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_tbl_tipo_usuario"><?= $Page->tipo_usuario->caption() ?></span></td>
        <td data-name="tipo_usuario"<?= $Page->tipo_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_tipo_usuario">
<span<?= $Page->tipo_usuario->viewAttributes() ?>>
<?= $Page->tipo_usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nombre_usuario->Visible) { // nombre_usuario ?>
    <tr id="r_nombre_usuario"<?= $Page->nombre_usuario->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_tbl_nombre_usuario"><?= $Page->nombre_usuario->caption() ?></span></td>
        <td data-name="nombre_usuario"<?= $Page->nombre_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_nombre_usuario">
<span<?= $Page->nombre_usuario->viewAttributes() ?>>
<?= $Page->nombre_usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->login_usuario->Visible) { // login_usuario ?>
    <tr id="r_login_usuario"<?= $Page->login_usuario->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_tbl_login_usuario"><?= $Page->login_usuario->caption() ?></span></td>
        <td data-name="login_usuario"<?= $Page->login_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_login_usuario">
<span<?= $Page->login_usuario->viewAttributes() ?>>
<?= $Page->login_usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->password_usuario->Visible) { // password_usuario ?>
    <tr id="r_password_usuario"<?= $Page->password_usuario->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_tbl_password_usuario"><?= $Page->password_usuario->caption() ?></span></td>
        <td data-name="password_usuario"<?= $Page->password_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_password_usuario">
<span<?= $Page->password_usuario->viewAttributes() ?>>
<?= $Page->password_usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->email_usuario->Visible) { // email_usuario ?>
    <tr id="r_email_usuario"<?= $Page->email_usuario->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_tbl_email_usuario"><?= $Page->email_usuario->caption() ?></span></td>
        <td data-name="email_usuario"<?= $Page->email_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_email_usuario">
<span<?= $Page->email_usuario->viewAttributes() ?>>
<?= $Page->email_usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->parent_id_usuario->Visible) { // parent_id_usuario ?>
    <tr id="r_parent_id_usuario"<?= $Page->parent_id_usuario->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_tbl_parent_id_usuario"><?= $Page->parent_id_usuario->caption() ?></span></td>
        <td data-name="parent_id_usuario"<?= $Page->parent_id_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_parent_id_usuario">
<span<?= $Page->parent_id_usuario->viewAttributes() ?>>
<?= $Page->parent_id_usuario->getViewValue() ?></span>
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
