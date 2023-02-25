<?php

namespace PHPMaker2023\ieproes;

// Page object
$EvaluacionTblAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { evaluacion_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fevaluacion_tbladd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fevaluacion_tbladd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["nombre_evaluacion", [fields.nombre_evaluacion.visible && fields.nombre_evaluacion.required ? ew.Validators.required(fields.nombre_evaluacion.caption) : null], fields.nombre_evaluacion.isInvalid],
            ["descripcion_evaluacion", [fields.descripcion_evaluacion.visible && fields.descripcion_evaluacion.required ? ew.Validators.required(fields.descripcion_evaluacion.caption) : null], fields.descripcion_evaluacion.isInvalid]
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
<form name="fevaluacion_tbladd" id="fevaluacion_tbladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="evaluacion_tbl">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nombre_evaluacion->Visible) { // nombre_evaluacion ?>
    <div id="r_nombre_evaluacion"<?= $Page->nombre_evaluacion->rowAttributes() ?>>
        <label id="elh_evaluacion_tbl_nombre_evaluacion" for="x_nombre_evaluacion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombre_evaluacion->caption() ?><?= $Page->nombre_evaluacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nombre_evaluacion->cellAttributes() ?>>
<span id="el_evaluacion_tbl_nombre_evaluacion">
<input type="<?= $Page->nombre_evaluacion->getInputTextType() ?>" name="x_nombre_evaluacion" id="x_nombre_evaluacion" data-table="evaluacion_tbl" data-field="x_nombre_evaluacion" value="<?= $Page->nombre_evaluacion->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nombre_evaluacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nombre_evaluacion->formatPattern()) ?>"<?= $Page->nombre_evaluacion->editAttributes() ?> aria-describedby="x_nombre_evaluacion_help">
<?= $Page->nombre_evaluacion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_evaluacion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->descripcion_evaluacion->Visible) { // descripcion_evaluacion ?>
    <div id="r_descripcion_evaluacion"<?= $Page->descripcion_evaluacion->rowAttributes() ?>>
        <label id="elh_evaluacion_tbl_descripcion_evaluacion" for="x_descripcion_evaluacion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->descripcion_evaluacion->caption() ?><?= $Page->descripcion_evaluacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->descripcion_evaluacion->cellAttributes() ?>>
<span id="el_evaluacion_tbl_descripcion_evaluacion">
<textarea data-table="evaluacion_tbl" data-field="x_descripcion_evaluacion" name="x_descripcion_evaluacion" id="x_descripcion_evaluacion" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->descripcion_evaluacion->getPlaceHolder()) ?>"<?= $Page->descripcion_evaluacion->editAttributes() ?> aria-describedby="x_descripcion_evaluacion_help"><?= $Page->descripcion_evaluacion->EditValue ?></textarea>
<?= $Page->descripcion_evaluacion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->descripcion_evaluacion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fevaluacion_tbladd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fevaluacion_tbladd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("evaluacion_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
