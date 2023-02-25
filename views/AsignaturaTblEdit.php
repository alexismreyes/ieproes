<?php

namespace PHPMaker2023\ieproes;

// Page object
$AsignaturaTblEdit = &$Page;
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
<form name="fasignatura_tbledit" id="fasignatura_tbledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { asignatura_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fasignatura_tbledit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fasignatura_tbledit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["nombre_asignatura", [fields.nombre_asignatura.visible && fields.nombre_asignatura.required ? ew.Validators.required(fields.nombre_asignatura.caption) : null], fields.nombre_asignatura.isInvalid],
            ["id_profesor", [fields.id_profesor.visible && fields.id_profesor.required ? ew.Validators.required(fields.id_profesor.caption) : null], fields.id_profesor.isInvalid]
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
            "id_profesor": <?= $Page->id_profesor->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="asignatura_tbl">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nombre_asignatura->Visible) { // nombre_asignatura ?>
    <div id="r_nombre_asignatura"<?= $Page->nombre_asignatura->rowAttributes() ?>>
        <label id="elh_asignatura_tbl_nombre_asignatura" for="x_nombre_asignatura" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombre_asignatura->caption() ?><?= $Page->nombre_asignatura->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nombre_asignatura->cellAttributes() ?>>
<span id="el_asignatura_tbl_nombre_asignatura">
<input type="<?= $Page->nombre_asignatura->getInputTextType() ?>" name="x_nombre_asignatura" id="x_nombre_asignatura" data-table="asignatura_tbl" data-field="x_nombre_asignatura" value="<?= $Page->nombre_asignatura->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->nombre_asignatura->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nombre_asignatura->formatPattern()) ?>"<?= $Page->nombre_asignatura->editAttributes() ?> aria-describedby="x_nombre_asignatura_help">
<?= $Page->nombre_asignatura->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_asignatura->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_profesor->Visible) { // id_profesor ?>
    <div id="r_id_profesor"<?= $Page->id_profesor->rowAttributes() ?>>
        <label id="elh_asignatura_tbl_id_profesor" for="x_id_profesor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_profesor->caption() ?><?= $Page->id_profesor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id_profesor->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("edit")) { // Non system admin ?>
<span id="el_asignatura_tbl_id_profesor">
    <select
        id="x_id_profesor"
        name="x_id_profesor"
        class="form-select ew-select<?= $Page->id_profesor->isInvalidClass() ?>"
        data-select2-id="fasignatura_tbledit_x_id_profesor"
        data-table="asignatura_tbl"
        data-field="x_id_profesor"
        data-value-separator="<?= $Page->id_profesor->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->id_profesor->getPlaceHolder()) ?>"
        <?= $Page->id_profesor->editAttributes() ?>>
        <?= $Page->id_profesor->selectOptionListHtml("x_id_profesor") ?>
    </select>
    <?= $Page->id_profesor->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->id_profesor->getErrorMessage() ?></div>
<?= $Page->id_profesor->Lookup->getParamTag($Page, "p_x_id_profesor") ?>
<script>
loadjs.ready("fasignatura_tbledit", function() {
    var options = { name: "x_id_profesor", selectId: "fasignatura_tbledit_x_id_profesor" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fasignatura_tbledit.lists.id_profesor?.lookupOptions.length) {
        options.data = { id: "x_id_profesor", form: "fasignatura_tbledit" };
    } else {
        options.ajax = { id: "x_id_profesor", form: "fasignatura_tbledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.asignatura_tbl.fields.id_profesor.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el_asignatura_tbl_id_profesor">
    <select
        id="x_id_profesor"
        name="x_id_profesor"
        class="form-select ew-select<?= $Page->id_profesor->isInvalidClass() ?>"
        data-select2-id="fasignatura_tbledit_x_id_profesor"
        data-table="asignatura_tbl"
        data-field="x_id_profesor"
        data-value-separator="<?= $Page->id_profesor->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->id_profesor->getPlaceHolder()) ?>"
        <?= $Page->id_profesor->editAttributes() ?>>
        <?= $Page->id_profesor->selectOptionListHtml("x_id_profesor") ?>
    </select>
    <?= $Page->id_profesor->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->id_profesor->getErrorMessage() ?></div>
<?= $Page->id_profesor->Lookup->getParamTag($Page, "p_x_id_profesor") ?>
<script>
loadjs.ready("fasignatura_tbledit", function() {
    var options = { name: "x_id_profesor", selectId: "fasignatura_tbledit_x_id_profesor" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fasignatura_tbledit.lists.id_profesor?.lookupOptions.length) {
        options.data = { id: "x_id_profesor", form: "fasignatura_tbledit" };
    } else {
        options.ajax = { id: "x_id_profesor", form: "fasignatura_tbledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.asignatura_tbl.fields.id_profesor.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="asignatura_tbl" data-field="x_id_asignatura" data-hidden="1" name="x_id_asignatura" id="x_id_asignatura" value="<?= HtmlEncode($Page->id_asignatura->CurrentValue) ?>">
<?php
    if (in_array("calificacion_tbl", explode(",", $Page->getCurrentDetailTable())) && $calificacion_tbl->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("calificacion_tbl", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "CalificacionTblGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fasignatura_tbledit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fasignatura_tbledit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("asignatura_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
