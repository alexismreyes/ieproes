<?php

namespace PHPMaker2023\ieproes;

// Page object
$UsuariosTblAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { usuarios_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fusuarios_tbladd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusuarios_tbladd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["tipo_usuario", [fields.tipo_usuario.visible && fields.tipo_usuario.required ? ew.Validators.required(fields.tipo_usuario.caption) : null], fields.tipo_usuario.isInvalid],
            ["nombre_usuario", [fields.nombre_usuario.visible && fields.nombre_usuario.required ? ew.Validators.required(fields.nombre_usuario.caption) : null], fields.nombre_usuario.isInvalid],
            ["login_usuario", [fields.login_usuario.visible && fields.login_usuario.required ? ew.Validators.required(fields.login_usuario.caption) : null], fields.login_usuario.isInvalid],
            ["password_usuario", [fields.password_usuario.visible && fields.password_usuario.required ? ew.Validators.required(fields.password_usuario.caption) : null], fields.password_usuario.isInvalid],
            ["email_usuario", [fields.email_usuario.visible && fields.email_usuario.required ? ew.Validators.required(fields.email_usuario.caption) : null], fields.email_usuario.isInvalid],
            ["parent_id_usuario", [fields.parent_id_usuario.visible && fields.parent_id_usuario.required ? ew.Validators.required(fields.parent_id_usuario.caption) : null, ew.Validators.integer], fields.parent_id_usuario.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "tipo_usuario": <?= $Page->tipo_usuario->toClientList($Page) ?>,
        })
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
<form name="fusuarios_tbladd" id="fusuarios_tbladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="usuarios_tbl">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->tipo_usuario->Visible) { // tipo_usuario ?>
    <div id="r_tipo_usuario"<?= $Page->tipo_usuario->rowAttributes() ?>>
        <label id="elh_usuarios_tbl_tipo_usuario" for="x_tipo_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tipo_usuario->caption() ?><?= $Page->tipo_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tipo_usuario->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_usuarios_tbl_tipo_usuario">
<span class="form-control-plaintext"><?= $Page->tipo_usuario->getDisplayValue($Page->tipo_usuario->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_usuarios_tbl_tipo_usuario">
    <select
        id="x_tipo_usuario"
        name="x_tipo_usuario"
        class="form-select ew-select<?= $Page->tipo_usuario->isInvalidClass() ?>"
        data-select2-id="fusuarios_tbladd_x_tipo_usuario"
        data-table="usuarios_tbl"
        data-field="x_tipo_usuario"
        data-value-separator="<?= $Page->tipo_usuario->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->tipo_usuario->getPlaceHolder()) ?>"
        <?= $Page->tipo_usuario->editAttributes() ?>>
        <?= $Page->tipo_usuario->selectOptionListHtml("x_tipo_usuario") ?>
    </select>
    <?= $Page->tipo_usuario->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->tipo_usuario->getErrorMessage() ?></div>
<?= $Page->tipo_usuario->Lookup->getParamTag($Page, "p_x_tipo_usuario") ?>
<script>
loadjs.ready("fusuarios_tbladd", function() {
    var options = { name: "x_tipo_usuario", selectId: "fusuarios_tbladd_x_tipo_usuario" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fusuarios_tbladd.lists.tipo_usuario?.lookupOptions.length) {
        options.data = { id: "x_tipo_usuario", form: "fusuarios_tbladd" };
    } else {
        options.ajax = { id: "x_tipo_usuario", form: "fusuarios_tbladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.usuarios_tbl.fields.tipo_usuario.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nombre_usuario->Visible) { // nombre_usuario ?>
    <div id="r_nombre_usuario"<?= $Page->nombre_usuario->rowAttributes() ?>>
        <label id="elh_usuarios_tbl_nombre_usuario" for="x_nombre_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombre_usuario->caption() ?><?= $Page->nombre_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nombre_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_nombre_usuario">
<input type="<?= $Page->nombre_usuario->getInputTextType() ?>" name="x_nombre_usuario" id="x_nombre_usuario" data-table="usuarios_tbl" data-field="x_nombre_usuario" value="<?= $Page->nombre_usuario->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nombre_usuario->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nombre_usuario->formatPattern()) ?>"<?= $Page->nombre_usuario->editAttributes() ?> aria-describedby="x_nombre_usuario_help">
<?= $Page->nombre_usuario->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_usuario->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->login_usuario->Visible) { // login_usuario ?>
    <div id="r_login_usuario"<?= $Page->login_usuario->rowAttributes() ?>>
        <label id="elh_usuarios_tbl_login_usuario" for="x_login_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->login_usuario->caption() ?><?= $Page->login_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->login_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_login_usuario">
<input type="<?= $Page->login_usuario->getInputTextType() ?>" name="x_login_usuario" id="x_login_usuario" data-table="usuarios_tbl" data-field="x_login_usuario" value="<?= $Page->login_usuario->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->login_usuario->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->login_usuario->formatPattern()) ?>"<?= $Page->login_usuario->editAttributes() ?> aria-describedby="x_login_usuario_help">
<?= $Page->login_usuario->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->login_usuario->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->password_usuario->Visible) { // password_usuario ?>
    <div id="r_password_usuario"<?= $Page->password_usuario->rowAttributes() ?>>
        <label id="elh_usuarios_tbl_password_usuario" for="x_password_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->password_usuario->caption() ?><?= $Page->password_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->password_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_password_usuario">
<div class="input-group">
    <input type="password" name="x_password_usuario" id="x_password_usuario" autocomplete="new-password" data-field="x_password_usuario" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->password_usuario->getPlaceHolder()) ?>"<?= $Page->password_usuario->editAttributes() ?> aria-describedby="x_password_usuario_help">
    <button type="button" class="btn btn-default ew-toggle-password rounded-end" data-ew-action="password"><i class="fa-solid fa-eye"></i></button>
</div>
<?= $Page->password_usuario->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->password_usuario->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->email_usuario->Visible) { // email_usuario ?>
    <div id="r_email_usuario"<?= $Page->email_usuario->rowAttributes() ?>>
        <label id="elh_usuarios_tbl_email_usuario" for="x_email_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email_usuario->caption() ?><?= $Page->email_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->email_usuario->cellAttributes() ?>>
<span id="el_usuarios_tbl_email_usuario">
<input type="<?= $Page->email_usuario->getInputTextType() ?>" name="x_email_usuario" id="x_email_usuario" data-table="usuarios_tbl" data-field="x_email_usuario" value="<?= $Page->email_usuario->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->email_usuario->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->email_usuario->formatPattern()) ?>"<?= $Page->email_usuario->editAttributes() ?> aria-describedby="x_email_usuario_help">
<?= $Page->email_usuario->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->email_usuario->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->parent_id_usuario->Visible) { // parent_id_usuario ?>
    <div id="r_parent_id_usuario"<?= $Page->parent_id_usuario->rowAttributes() ?>>
        <label id="elh_usuarios_tbl_parent_id_usuario" for="x_parent_id_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->parent_id_usuario->caption() ?><?= $Page->parent_id_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->parent_id_usuario->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_usuarios_tbl_parent_id_usuario">
    <select
        id="x_parent_id_usuario"
        name="x_parent_id_usuario"
        class="form-select ew-select<?= $Page->parent_id_usuario->isInvalidClass() ?>"
        data-select2-id="fusuarios_tbladd_x_parent_id_usuario"
        data-table="usuarios_tbl"
        data-field="x_parent_id_usuario"
        data-value-separator="<?= $Page->parent_id_usuario->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->parent_id_usuario->getPlaceHolder()) ?>"
        <?= $Page->parent_id_usuario->editAttributes() ?>>
        <?= $Page->parent_id_usuario->selectOptionListHtml("x_parent_id_usuario") ?>
    </select>
    <?= $Page->parent_id_usuario->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->parent_id_usuario->getErrorMessage() ?></div>
<script>
loadjs.ready("fusuarios_tbladd", function() {
    var options = { name: "x_parent_id_usuario", selectId: "fusuarios_tbladd_x_parent_id_usuario" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fusuarios_tbladd.lists.parent_id_usuario?.lookupOptions.length) {
        options.data = { id: "x_parent_id_usuario", form: "fusuarios_tbladd" };
    } else {
        options.ajax = { id: "x_parent_id_usuario", form: "fusuarios_tbladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.usuarios_tbl.fields.parent_id_usuario.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el_usuarios_tbl_parent_id_usuario">
<input type="<?= $Page->parent_id_usuario->getInputTextType() ?>" name="x_parent_id_usuario" id="x_parent_id_usuario" data-table="usuarios_tbl" data-field="x_parent_id_usuario" value="<?= $Page->parent_id_usuario->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->parent_id_usuario->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->parent_id_usuario->formatPattern()) ?>"<?= $Page->parent_id_usuario->editAttributes() ?> aria-describedby="x_parent_id_usuario_help">
<?= $Page->parent_id_usuario->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->parent_id_usuario->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fusuarios_tbladd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fusuarios_tbladd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("usuarios_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
