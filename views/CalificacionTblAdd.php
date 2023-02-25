<?php

namespace PHPMaker2023\ieproes;

// Page object
$CalificacionTblAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { calificacion_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fcalificacion_tbladd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcalificacion_tbladd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["fk_id_asignatura", [fields.fk_id_asignatura.visible && fields.fk_id_asignatura.required ? ew.Validators.required(fields.fk_id_asignatura.caption) : null], fields.fk_id_asignatura.isInvalid],
            ["fk_id_alumno", [fields.fk_id_alumno.visible && fields.fk_id_alumno.required ? ew.Validators.required(fields.fk_id_alumno.caption) : null], fields.fk_id_alumno.isInvalid],
            ["nota_calificacion", [fields.nota_calificacion.visible && fields.nota_calificacion.required ? ew.Validators.required(fields.nota_calificacion.caption) : null], fields.nota_calificacion.isInvalid],
            ["observacion_calificacion", [fields.observacion_calificacion.visible && fields.observacion_calificacion.required ? ew.Validators.required(fields.observacion_calificacion.caption) : null], fields.observacion_calificacion.isInvalid],
            ["fk_id_evaluacion", [fields.fk_id_evaluacion.visible && fields.fk_id_evaluacion.required ? ew.Validators.required(fields.fk_id_evaluacion.caption) : null], fields.fk_id_evaluacion.isInvalid]
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
            "fk_id_asignatura": <?= $Page->fk_id_asignatura->toClientList($Page) ?>,
            "fk_id_alumno": <?= $Page->fk_id_alumno->toClientList($Page) ?>,
            "fk_id_evaluacion": <?= $Page->fk_id_evaluacion->toClientList($Page) ?>,
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
<form name="fcalificacion_tbladd" id="fcalificacion_tbladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="calificacion_tbl">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "alumnotbl") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="alumnotbl">
<input type="hidden" name="fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "asignatura_tbl") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="asignatura_tbl">
<input type="hidden" name="fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
    <div id="r_fk_id_asignatura"<?= $Page->fk_id_asignatura->rowAttributes() ?>>
        <label id="elh_calificacion_tbl_fk_id_asignatura" for="x_fk_id_asignatura" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fk_id_asignatura->caption() ?><?= $Page->fk_id_asignatura->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<?php if ($Page->fk_id_asignatura->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_asignatura->getDisplayValue($Page->fk_id_asignatura->ViewValue) ?></span></span>
<input type="hidden" id="x_fk_id_asignatura" name="x_fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_calificacion_tbl_fk_id_asignatura">
    <select
        id="x_fk_id_asignatura"
        name="x_fk_id_asignatura"
        class="form-select ew-select<?= $Page->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tbladd_x_fk_id_asignatura"
        data-table="calificacion_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Page->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_asignatura->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->fk_id_asignatura->editAttributes() ?>>
        <?= $Page->fk_id_asignatura->selectOptionListHtml("x_fk_id_asignatura") ?>
    </select>
    <?= $Page->fk_id_asignatura->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Page->fk_id_asignatura->Lookup->getParamTag($Page, "p_x_fk_id_asignatura") ?>
<script>
loadjs.ready("fcalificacion_tbladd", function() {
    var options = { name: "x_fk_id_asignatura", selectId: "fcalificacion_tbladd_x_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tbladd.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x_fk_id_asignatura", form: "fcalificacion_tbladd" };
    } else {
        options.ajax = { id: "x_fk_id_asignatura", form: "fcalificacion_tbladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_asignatura.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
    <div id="r_fk_id_alumno"<?= $Page->fk_id_alumno->rowAttributes() ?>>
        <label id="elh_calificacion_tbl_fk_id_alumno" for="x_fk_id_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fk_id_alumno->caption() ?><?= $Page->fk_id_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fk_id_alumno->cellAttributes() ?>>
<?php if ($Page->fk_id_alumno->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_alumno->getDisplayValue($Page->fk_id_alumno->ViewValue) ?></span></span>
<input type="hidden" id="x_fk_id_alumno" name="x_fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_calificacion_tbl_fk_id_alumno">
    <select
        id="x_fk_id_alumno"
        name="x_fk_id_alumno"
        class="form-select ew-select<?= $Page->fk_id_alumno->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tbladd_x_fk_id_alumno"
        data-table="calificacion_tbl"
        data-field="x_fk_id_alumno"
        data-value-separator="<?= $Page->fk_id_alumno->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_alumno->getPlaceHolder()) ?>"
        <?= $Page->fk_id_alumno->editAttributes() ?>>
        <?= $Page->fk_id_alumno->selectOptionListHtml("x_fk_id_alumno") ?>
    </select>
    <?= $Page->fk_id_alumno->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->fk_id_alumno->getErrorMessage() ?></div>
<?= $Page->fk_id_alumno->Lookup->getParamTag($Page, "p_x_fk_id_alumno") ?>
<script>
loadjs.ready("fcalificacion_tbladd", function() {
    var options = { name: "x_fk_id_alumno", selectId: "fcalificacion_tbladd_x_fk_id_alumno" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tbladd.lists.fk_id_alumno?.lookupOptions.length) {
        options.data = { id: "x_fk_id_alumno", form: "fcalificacion_tbladd" };
    } else {
        options.ajax = { id: "x_fk_id_alumno", form: "fcalificacion_tbladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_alumno.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { // nota_calificacion ?>
    <div id="r_nota_calificacion"<?= $Page->nota_calificacion->rowAttributes() ?>>
        <label id="elh_calificacion_tbl_nota_calificacion" for="x_nota_calificacion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nota_calificacion->caption() ?><?= $Page->nota_calificacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nota_calificacion->cellAttributes() ?>>
<span id="el_calificacion_tbl_nota_calificacion">
<input type="<?= $Page->nota_calificacion->getInputTextType() ?>" name="x_nota_calificacion" id="x_nota_calificacion" data-table="calificacion_tbl" data-field="x_nota_calificacion" value="<?= $Page->nota_calificacion->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->nota_calificacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nota_calificacion->formatPattern()) ?>"<?= $Page->nota_calificacion->editAttributes() ?> aria-describedby="x_nota_calificacion_help">
<?= $Page->nota_calificacion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nota_calificacion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->observacion_calificacion->Visible) { // observacion_calificacion ?>
    <div id="r_observacion_calificacion"<?= $Page->observacion_calificacion->rowAttributes() ?>>
        <label id="elh_calificacion_tbl_observacion_calificacion" for="x_observacion_calificacion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->observacion_calificacion->caption() ?><?= $Page->observacion_calificacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->observacion_calificacion->cellAttributes() ?>>
<span id="el_calificacion_tbl_observacion_calificacion">
<textarea data-table="calificacion_tbl" data-field="x_observacion_calificacion" name="x_observacion_calificacion" id="x_observacion_calificacion" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->observacion_calificacion->getPlaceHolder()) ?>"<?= $Page->observacion_calificacion->editAttributes() ?> aria-describedby="x_observacion_calificacion_help"><?= $Page->observacion_calificacion->EditValue ?></textarea>
<?= $Page->observacion_calificacion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->observacion_calificacion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
    <div id="r_fk_id_evaluacion"<?= $Page->fk_id_evaluacion->rowAttributes() ?>>
        <label id="elh_calificacion_tbl_fk_id_evaluacion" for="x_fk_id_evaluacion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fk_id_evaluacion->caption() ?><?= $Page->fk_id_evaluacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fk_id_evaluacion->cellAttributes() ?>>
<span id="el_calificacion_tbl_fk_id_evaluacion">
<div class="input-group flex-nowrap">
    <select
        id="x_fk_id_evaluacion"
        name="x_fk_id_evaluacion"
        class="form-select ew-select<?= $Page->fk_id_evaluacion->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tbladd_x_fk_id_evaluacion"
        data-table="calificacion_tbl"
        data-field="x_fk_id_evaluacion"
        data-value-separator="<?= $Page->fk_id_evaluacion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_evaluacion->getPlaceHolder()) ?>"
        <?= $Page->fk_id_evaluacion->editAttributes() ?>>
        <?= $Page->fk_id_evaluacion->selectOptionListHtml("x_fk_id_evaluacion") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "evaluacion_tbl") && !$Page->fk_id_evaluacion->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_fk_id_evaluacion" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->fk_id_evaluacion->caption() ?>" data-title="<?= $Page->fk_id_evaluacion->caption() ?>" data-ew-action="add-option" data-el="x_fk_id_evaluacion" data-url="<?= GetUrl("EvaluacionTblAddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<?= $Page->fk_id_evaluacion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fk_id_evaluacion->getErrorMessage() ?></div>
<?= $Page->fk_id_evaluacion->Lookup->getParamTag($Page, "p_x_fk_id_evaluacion") ?>
<script>
loadjs.ready("fcalificacion_tbladd", function() {
    var options = { name: "x_fk_id_evaluacion", selectId: "fcalificacion_tbladd_x_fk_id_evaluacion" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tbladd.lists.fk_id_evaluacion?.lookupOptions.length) {
        options.data = { id: "x_fk_id_evaluacion", form: "fcalificacion_tbladd" };
    } else {
        options.ajax = { id: "x_fk_id_evaluacion", form: "fcalificacion_tbladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_evaluacion.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fcalificacion_tbladd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fcalificacion_tbladd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("calificacion_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
