<?php

namespace PHPMaker2023\ieproes;

// Page object
$EvaluacionTblAddopt = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { evaluacion_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "addopt";
var currentForm;
var fevaluacion_tbladdopt;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fevaluacion_tbladdopt")
        .setPageId("addopt")

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
<form name="fevaluacion_tbladdopt" id="fevaluacion_tbladdopt" class="ew-form" action="<?= HtmlEncode(GetUrl(Config("API_URL"))) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="<?= Config("API_ACTION_NAME") ?>" id="<?= Config("API_ACTION_NAME") ?>" value="<?= Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?= Config("API_OBJECT_NAME") ?>" id="<?= Config("API_OBJECT_NAME") ?>" value="evaluacion_tbl">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($Page->nombre_evaluacion->Visible) { // nombre_evaluacion ?>
    <div<?= $Page->nombre_evaluacion->rowAttributes() ?>>
        <label class="col-sm-2 col-form-label ew-label" for="x_nombre_evaluacion"><?= $Page->nombre_evaluacion->caption() ?><?= $Page->nombre_evaluacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10"><div<?= $Page->nombre_evaluacion->cellAttributes() ?>>
<input type="<?= $Page->nombre_evaluacion->getInputTextType() ?>" name="x_nombre_evaluacion" id="x_nombre_evaluacion" data-table="evaluacion_tbl" data-field="x_nombre_evaluacion" value="<?= $Page->nombre_evaluacion->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nombre_evaluacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nombre_evaluacion->formatPattern()) ?>"<?= $Page->nombre_evaluacion->editAttributes() ?> aria-describedby="x_nombre_evaluacion_help">
<?= $Page->nombre_evaluacion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_evaluacion->getErrorMessage() ?></div>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->descripcion_evaluacion->Visible) { // descripcion_evaluacion ?>
    <div<?= $Page->descripcion_evaluacion->rowAttributes() ?>>
        <label class="col-sm-2 col-form-label ew-label" for="x_descripcion_evaluacion"><?= $Page->descripcion_evaluacion->caption() ?><?= $Page->descripcion_evaluacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10"><div<?= $Page->descripcion_evaluacion->cellAttributes() ?>>
<textarea data-table="evaluacion_tbl" data-field="x_descripcion_evaluacion" name="x_descripcion_evaluacion" id="x_descripcion_evaluacion" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->descripcion_evaluacion->getPlaceHolder()) ?>"<?= $Page->descripcion_evaluacion->editAttributes() ?> aria-describedby="x_descripcion_evaluacion_help"><?= $Page->descripcion_evaluacion->EditValue ?></textarea>
<?= $Page->descripcion_evaluacion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->descripcion_evaluacion->getErrorMessage() ?></div>
</div></div>
    </div>
<?php } ?>
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
