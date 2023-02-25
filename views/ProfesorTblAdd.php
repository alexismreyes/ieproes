<?php

namespace PHPMaker2023\ieproes;

// Page object
$ProfesorTblAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { profesor_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fprofesor_tbladd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprofesor_tbladd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["nombre_profesor", [fields.nombre_profesor.visible && fields.nombre_profesor.required ? ew.Validators.required(fields.nombre_profesor.caption) : null], fields.nombre_profesor.isInvalid],
            ["dui_profesor", [fields.dui_profesor.visible && fields.dui_profesor.required ? ew.Validators.required(fields.dui_profesor.caption) : null], fields.dui_profesor.isInvalid],
            ["direccion_profesor", [fields.direccion_profesor.visible && fields.direccion_profesor.required ? ew.Validators.required(fields.direccion_profesor.caption) : null], fields.direccion_profesor.isInvalid],
            ["telefono_profesor", [fields.telefono_profesor.visible && fields.telefono_profesor.required ? ew.Validators.required(fields.telefono_profesor.caption) : null], fields.telefono_profesor.isInvalid],
            ["email_profesor", [fields.email_profesor.visible && fields.email_profesor.required ? ew.Validators.required(fields.email_profesor.caption) : null], fields.email_profesor.isInvalid]
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
<form name="fprofesor_tbladd" id="fprofesor_tbladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="profesor_tbl">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nombre_profesor->Visible) { // nombre_profesor ?>
    <div id="r_nombre_profesor"<?= $Page->nombre_profesor->rowAttributes() ?>>
        <label id="elh_profesor_tbl_nombre_profesor" for="x_nombre_profesor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombre_profesor->caption() ?><?= $Page->nombre_profesor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nombre_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_nombre_profesor">
<input type="<?= $Page->nombre_profesor->getInputTextType() ?>" name="x_nombre_profesor" id="x_nombre_profesor" data-table="profesor_tbl" data-field="x_nombre_profesor" value="<?= $Page->nombre_profesor->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nombre_profesor->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nombre_profesor->formatPattern()) ?>"<?= $Page->nombre_profesor->editAttributes() ?> aria-describedby="x_nombre_profesor_help">
<?= $Page->nombre_profesor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_profesor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dui_profesor->Visible) { // dui_profesor ?>
    <div id="r_dui_profesor"<?= $Page->dui_profesor->rowAttributes() ?>>
        <label id="elh_profesor_tbl_dui_profesor" for="x_dui_profesor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dui_profesor->caption() ?><?= $Page->dui_profesor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dui_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_dui_profesor">
<input type="<?= $Page->dui_profesor->getInputTextType() ?>" name="x_dui_profesor" id="x_dui_profesor" data-table="profesor_tbl" data-field="x_dui_profesor" value="<?= $Page->dui_profesor->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->dui_profesor->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->dui_profesor->formatPattern()) ?>"<?= $Page->dui_profesor->editAttributes() ?> aria-describedby="x_dui_profesor_help">
<?= $Page->dui_profesor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dui_profesor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->direccion_profesor->Visible) { // direccion_profesor ?>
    <div id="r_direccion_profesor"<?= $Page->direccion_profesor->rowAttributes() ?>>
        <label id="elh_profesor_tbl_direccion_profesor" for="x_direccion_profesor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->direccion_profesor->caption() ?><?= $Page->direccion_profesor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->direccion_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_direccion_profesor">
<input type="<?= $Page->direccion_profesor->getInputTextType() ?>" name="x_direccion_profesor" id="x_direccion_profesor" data-table="profesor_tbl" data-field="x_direccion_profesor" value="<?= $Page->direccion_profesor->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->direccion_profesor->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->direccion_profesor->formatPattern()) ?>"<?= $Page->direccion_profesor->editAttributes() ?> aria-describedby="x_direccion_profesor_help">
<?= $Page->direccion_profesor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->direccion_profesor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->telefono_profesor->Visible) { // telefono_profesor ?>
    <div id="r_telefono_profesor"<?= $Page->telefono_profesor->rowAttributes() ?>>
        <label id="elh_profesor_tbl_telefono_profesor" for="x_telefono_profesor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->telefono_profesor->caption() ?><?= $Page->telefono_profesor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->telefono_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_telefono_profesor">
<input type="<?= $Page->telefono_profesor->getInputTextType() ?>" name="x_telefono_profesor" id="x_telefono_profesor" data-table="profesor_tbl" data-field="x_telefono_profesor" value="<?= $Page->telefono_profesor->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->telefono_profesor->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->telefono_profesor->formatPattern()) ?>"<?= $Page->telefono_profesor->editAttributes() ?> aria-describedby="x_telefono_profesor_help">
<?= $Page->telefono_profesor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->telefono_profesor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->email_profesor->Visible) { // email_profesor ?>
    <div id="r_email_profesor"<?= $Page->email_profesor->rowAttributes() ?>>
        <label id="elh_profesor_tbl_email_profesor" for="x_email_profesor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email_profesor->caption() ?><?= $Page->email_profesor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->email_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_email_profesor">
<input type="<?= $Page->email_profesor->getInputTextType() ?>" name="x_email_profesor" id="x_email_profesor" data-table="profesor_tbl" data-field="x_email_profesor" value="<?= $Page->email_profesor->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->email_profesor->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->email_profesor->formatPattern()) ?>"<?= $Page->email_profesor->editAttributes() ?> aria-describedby="x_email_profesor_help">
<?= $Page->email_profesor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->email_profesor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fprofesor_tbladd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fprofesor_tbladd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("profesor_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
