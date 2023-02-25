<?php

namespace PHPMaker2023\ieproes;

// Page object
$AlumnosAsignaturaTblEdit = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="falumnos_asignatura_tbledit" id="falumnos_asignatura_tbledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnos_asignatura_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var falumnos_asignatura_tbledit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("falumnos_asignatura_tbledit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["fk_id_asignatura", [fields.fk_id_asignatura.visible && fields.fk_id_asignatura.required ? ew.Validators.required(fields.fk_id_asignatura.caption) : null], fields.fk_id_asignatura.isInvalid],
            ["fk_id_alumno", [fields.fk_id_alumno.visible && fields.fk_id_alumno.required ? ew.Validators.required(fields.fk_id_alumno.caption) : null], fields.fk_id_alumno.isInvalid]
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
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="alumnos_asignatura_tbl">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "asignatura_tbl") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="asignatura_tbl">
<input type="hidden" name="fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
    <div id="r_fk_id_asignatura"<?= $Page->fk_id_asignatura->rowAttributes() ?>>
        <label id="elh_alumnos_asignatura_tbl_fk_id_asignatura" for="x_fk_id_asignatura" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fk_id_asignatura->caption() ?><?= $Page->fk_id_asignatura->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<?php if ($Page->fk_id_asignatura->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_asignatura->getDisplayValue($Page->fk_id_asignatura->ViewValue) ?></span></span>
<input type="hidden" id="x_fk_id_asignatura" name="x_fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_alumnos_asignatura_tbl_fk_id_asignatura">
    <select
        id="x_fk_id_asignatura"
        name="x_fk_id_asignatura"
        class="form-select ew-select<?= $Page->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="falumnos_asignatura_tbledit_x_fk_id_asignatura"
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
loadjs.ready("falumnos_asignatura_tbledit", function() {
    var options = { name: "x_fk_id_asignatura", selectId: "falumnos_asignatura_tbledit_x_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (falumnos_asignatura_tbledit.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x_fk_id_asignatura", form: "falumnos_asignatura_tbledit" };
    } else {
        options.ajax = { id: "x_fk_id_asignatura", form: "falumnos_asignatura_tbledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.alumnos_asignatura_tbl.fields.fk_id_asignatura.selectOptions);
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
        <label id="elh_alumnos_asignatura_tbl_fk_id_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fk_id_alumno->caption() ?><?= $Page->fk_id_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fk_id_alumno->cellAttributes() ?>>
<span id="el_alumnos_asignatura_tbl_fk_id_alumno">
<?php
if (IsRTL()) {
    $Page->fk_id_alumno->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_fk_id_alumno" class="ew-auto-suggest">
    <input type="<?= $Page->fk_id_alumno->getInputTextType() ?>" class="form-control" name="sv_x_fk_id_alumno" id="sv_x_fk_id_alumno" value="<?= RemoveHtml($Page->fk_id_alumno->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->fk_id_alumno->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->fk_id_alumno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->fk_id_alumno->formatPattern()) ?>"<?= $Page->fk_id_alumno->editAttributes() ?> aria-describedby="x_fk_id_alumno_help">
</span>
<selection-list hidden class="form-control" data-table="alumnos_asignatura_tbl" data-field="x_fk_id_alumno" data-input="sv_x_fk_id_alumno" data-value-separator="<?= $Page->fk_id_alumno->displayValueSeparatorAttribute() ?>" name="x_fk_id_alumno" id="x_fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->CurrentValue) ?>"></selection-list>
<?= $Page->fk_id_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fk_id_alumno->getErrorMessage() ?></div>
<script>
loadjs.ready("falumnos_asignatura_tbledit", function() {
    falumnos_asignatura_tbledit.createAutoSuggest(Object.assign({"id":"x_fk_id_alumno","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->fk_id_alumno->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.alumnos_asignatura_tbl.fields.fk_id_alumno.autoSuggestOptions));
});
</script>
<?= $Page->fk_id_alumno->Lookup->getParamTag($Page, "p_x_fk_id_alumno") ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="alumnos_asignatura_tbl" data-field="x_id_alumnosasignatura" data-hidden="1" name="x_id_alumnosasignatura" id="x_id_alumnosasignatura" value="<?= HtmlEncode($Page->id_alumnosasignatura->CurrentValue) ?>">
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="falumnos_asignatura_tbledit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="falumnos_asignatura_tbledit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
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
