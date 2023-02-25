<?php

namespace PHPMaker2023\ieproes;

// Page object
$AlumnosAsignaturaTblAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnos_asignatura_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var falumnos_asignatura_tbladd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("falumnos_asignatura_tbladd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["fk_id_alumno", [fields.fk_id_alumno.visible && fields.fk_id_alumno.required ? ew.Validators.required(fields.fk_id_alumno.caption) : null], fields.fk_id_alumno.isInvalid],
            ["fk_id_asignatura", [fields.fk_id_asignatura.visible && fields.fk_id_asignatura.required ? ew.Validators.required(fields.fk_id_asignatura.caption) : null], fields.fk_id_asignatura.isInvalid]
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
            "fk_id_alumno": <?= $Page->fk_id_alumno->toClientList($Page) ?>,
            "fk_id_asignatura": <?= $Page->fk_id_asignatura->toClientList($Page) ?>,
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
<form name="falumnos_asignatura_tbladd" id="falumnos_asignatura_tbladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="alumnos_asignatura_tbl">
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
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
    <div id="r_fk_id_alumno"<?= $Page->fk_id_alumno->rowAttributes() ?>>
        <label id="elh_alumnos_asignatura_tbl_fk_id_alumno" for="x_fk_id_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fk_id_alumno->caption() ?><?= $Page->fk_id_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fk_id_alumno->cellAttributes() ?>>
<?php if ($Page->fk_id_alumno->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_alumno->getDisplayValue($Page->fk_id_alumno->ViewValue) ?></span></span>
<input type="hidden" id="x_fk_id_alumno" name="x_fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_alumnos_asignatura_tbl_fk_id_alumno">
    <select
        id="x_fk_id_alumno"
        name="x_fk_id_alumno"
        class="form-select ew-select<?= $Page->fk_id_alumno->isInvalidClass() ?>"
        data-select2-id="falumnos_asignatura_tbladd_x_fk_id_alumno"
        data-table="alumnos_asignatura_tbl"
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
loadjs.ready("falumnos_asignatura_tbladd", function() {
    var options = { name: "x_fk_id_alumno", selectId: "falumnos_asignatura_tbladd_x_fk_id_alumno" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (falumnos_asignatura_tbladd.lists.fk_id_alumno?.lookupOptions.length) {
        options.data = { id: "x_fk_id_alumno", form: "falumnos_asignatura_tbladd" };
    } else {
        options.ajax = { id: "x_fk_id_alumno", form: "falumnos_asignatura_tbladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.alumnos_asignatura_tbl.fields.fk_id_alumno.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
    <div id="r_fk_id_asignatura"<?= $Page->fk_id_asignatura->rowAttributes() ?>>
        <label id="elh_alumnos_asignatura_tbl_fk_id_asignatura" for="x_fk_id_asignatura" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fk_id_asignatura->caption() ?><?= $Page->fk_id_asignatura->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<span id="el_alumnos_asignatura_tbl_fk_id_asignatura">
    <select
        id="x_fk_id_asignatura"
        name="x_fk_id_asignatura"
        class="form-select ew-select<?= $Page->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="falumnos_asignatura_tbladd_x_fk_id_asignatura"
        data-table="alumnos_asignatura_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Page->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_asignatura->getPlaceHolder()) ?>"
        <?= $Page->fk_id_asignatura->editAttributes() ?>>
        <?= $Page->fk_id_asignatura->selectOptionListHtml("x_fk_id_asignatura") ?>
    </select>
    <?= $Page->fk_id_asignatura->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Page->fk_id_asignatura->Lookup->getParamTag($Page, "p_x_fk_id_asignatura") ?>
<script>
loadjs.ready("falumnos_asignatura_tbladd", function() {
    var options = { name: "x_fk_id_asignatura", selectId: "falumnos_asignatura_tbladd_x_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (falumnos_asignatura_tbladd.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x_fk_id_asignatura", form: "falumnos_asignatura_tbladd" };
    } else {
        options.ajax = { id: "x_fk_id_asignatura", form: "falumnos_asignatura_tbladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.alumnos_asignatura_tbl.fields.fk_id_asignatura.selectOptions);
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="falumnos_asignatura_tbladd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="falumnos_asignatura_tbladd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("alumnos_asignatura_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
