<?php

namespace PHPMaker2023\ieproes;

// Page object
$CalificacionTblSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { calificacion_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "search";
var currentForm;
var fcalificacion_tblsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fcalificacion_tblsearch")
        .setPageId("search")
<?php if ($Page->IsModal && $Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
            ["fk_id_alumno", [], fields.fk_id_alumno.isInvalid],
            ["nota_calificacion", [], fields.nota_calificacion.isInvalid],
            ["fk_id_evaluacion", [], fields.fk_id_evaluacion.isInvalid]
        ])
        // Validate form
        .setValidate(
            async function () {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!(await this.customValidate?.(fobj) ?? true)) {
                    this.focus();
                    return false;
                }
                return true;
            }
        )

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
            "fk_id_evaluacion": <?= $Page->fk_id_evaluacion->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
<?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = form;
<?php } else { ?>
    currentForm = form;
<?php } ?>
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
<form name="fcalificacion_tblsearch" id="fcalificacion_tblsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="calificacion_tbl">
<input type="hidden" name="action" id="action" value="search">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
    <div id="r_fk_id_alumno" class="row"<?= $Page->fk_id_alumno->rowAttributes() ?>>
        <label for="x_fk_id_alumno" class="<?= $Page->LeftColumnClass ?>"><span id="elh_calificacion_tbl_fk_id_alumno"><?= $Page->fk_id_alumno->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_fk_id_alumno" id="z_fk_id_alumno" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->fk_id_alumno->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_calificacion_tbl_fk_id_alumno" class="ew-search-field ew-search-field-single">
    <select
        id="x_fk_id_alumno"
        name="x_fk_id_alumno"
        class="form-select ew-select<?= $Page->fk_id_alumno->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblsearch_x_fk_id_alumno"
        data-table="calificacion_tbl"
        data-field="x_fk_id_alumno"
        data-value-separator="<?= $Page->fk_id_alumno->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_alumno->getPlaceHolder()) ?>"
        <?= $Page->fk_id_alumno->editAttributes() ?>>
        <?= $Page->fk_id_alumno->selectOptionListHtml("x_fk_id_alumno") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->fk_id_alumno->getErrorMessage(false) ?></div>
<?= $Page->fk_id_alumno->Lookup->getParamTag($Page, "p_x_fk_id_alumno") ?>
<script>
loadjs.ready("fcalificacion_tblsearch", function() {
    var options = { name: "x_fk_id_alumno", selectId: "fcalificacion_tblsearch_x_fk_id_alumno" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblsearch.lists.fk_id_alumno?.lookupOptions.length) {
        options.data = { id: "x_fk_id_alumno", form: "fcalificacion_tblsearch" };
    } else {
        options.ajax = { id: "x_fk_id_alumno", form: "fcalificacion_tblsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_alumno.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { // nota_calificacion ?>
    <div id="r_nota_calificacion" class="row"<?= $Page->nota_calificacion->rowAttributes() ?>>
        <label for="x_nota_calificacion" class="<?= $Page->LeftColumnClass ?>"><span id="elh_calificacion_tbl_nota_calificacion"><?= $Page->nota_calificacion->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nota_calificacion" id="z_nota_calificacion" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nota_calificacion->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_calificacion_tbl_nota_calificacion" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nota_calificacion->getInputTextType() ?>" name="x_nota_calificacion" id="x_nota_calificacion" data-table="calificacion_tbl" data-field="x_nota_calificacion" value="<?= $Page->nota_calificacion->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->nota_calificacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nota_calificacion->formatPattern()) ?>"<?= $Page->nota_calificacion->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nota_calificacion->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
    <div id="r_fk_id_evaluacion" class="row"<?= $Page->fk_id_evaluacion->rowAttributes() ?>>
        <label for="x_fk_id_evaluacion" class="<?= $Page->LeftColumnClass ?>"><span id="elh_calificacion_tbl_fk_id_evaluacion"><?= $Page->fk_id_evaluacion->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_fk_id_evaluacion" id="z_fk_id_evaluacion" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->fk_id_evaluacion->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_calificacion_tbl_fk_id_evaluacion" class="ew-search-field ew-search-field-single">
    <select
        id="x_fk_id_evaluacion"
        name="x_fk_id_evaluacion"
        class="form-select ew-select<?= $Page->fk_id_evaluacion->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblsearch_x_fk_id_evaluacion"
        data-table="calificacion_tbl"
        data-field="x_fk_id_evaluacion"
        data-value-separator="<?= $Page->fk_id_evaluacion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_evaluacion->getPlaceHolder()) ?>"
        <?= $Page->fk_id_evaluacion->editAttributes() ?>>
        <?= $Page->fk_id_evaluacion->selectOptionListHtml("x_fk_id_evaluacion") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->fk_id_evaluacion->getErrorMessage(false) ?></div>
<?= $Page->fk_id_evaluacion->Lookup->getParamTag($Page, "p_x_fk_id_evaluacion") ?>
<script>
loadjs.ready("fcalificacion_tblsearch", function() {
    var options = { name: "x_fk_id_evaluacion", selectId: "fcalificacion_tblsearch_x_fk_id_evaluacion" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblsearch.lists.fk_id_evaluacion?.lookupOptions.length) {
        options.data = { id: "x_fk_id_evaluacion", form: "fcalificacion_tblsearch" };
    } else {
        options.ajax = { id: "x_fk_id_evaluacion", form: "fcalificacion_tblsearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_evaluacion.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fcalificacion_tblsearch"><?= $Language->phrase("Search") ?></button>
        <?php if ($Page->IsModal) { ?>
        <button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fcalificacion_tblsearch"><?= $Language->phrase("Cancel") ?></button>
        <?php } else { ?>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" form="fcalificacion_tblsearch" data-ew-action="reload"><?= $Language->phrase("Reset") ?></button>
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
