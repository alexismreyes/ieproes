<?php

namespace PHPMaker2023\ieproes;

// Page object
$CalificacionTblList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { calificacion_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["fk_id_asignatura", [fields.fk_id_asignatura.visible && fields.fk_id_asignatura.required ? ew.Validators.required(fields.fk_id_asignatura.caption) : null], fields.fk_id_asignatura.isInvalid],
            ["fk_id_alumno", [fields.fk_id_alumno.visible && fields.fk_id_alumno.required ? ew.Validators.required(fields.fk_id_alumno.caption) : null], fields.fk_id_alumno.isInvalid],
            ["nota_calificacion", [fields.nota_calificacion.visible && fields.nota_calificacion.required ? ew.Validators.required(fields.nota_calificacion.caption) : null], fields.nota_calificacion.isInvalid],
            ["observacion_calificacion", [fields.observacion_calificacion.visible && fields.observacion_calificacion.required ? ew.Validators.required(fields.observacion_calificacion.caption) : null], fields.observacion_calificacion.isInvalid],
            ["fk_id_evaluacion", [fields.fk_id_evaluacion.visible && fields.fk_id_evaluacion.required ? ew.Validators.required(fields.fk_id_evaluacion.caption) : null], fields.fk_id_evaluacion.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["fk_id_asignatura",false],["fk_id_alumno",false],["nota_calificacion",false],["observacion_calificacion",false],["fk_id_evaluacion",false]];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
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
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "alumnotbl") {
    if ($Page->MasterRecordExists) {
        include_once "views/AlumnotblMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "asignatura_tbl") {
    if ($Page->MasterRecordExists) {
        include_once "views/AsignaturaTblMaster.php";
    }
}
?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fcalificacion_tblsrch" id="fcalificacion_tblsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fcalificacion_tblsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { calificacion_tbl: currentTable } });
var currentForm;
var fcalificacion_tblsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fcalificacion_tblsrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fcalificacion_tblsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fcalificacion_tblsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fcalificacion_tblsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fcalificacion_tblsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
<?php } ?>
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="calificacion_tbl">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "alumnotbl" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="alumnotbl">
<input type="hidden" name="fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "asignatura_tbl" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="asignatura_tbl">
<input type="hidden" name="fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_calificacion_tbl" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_calificacion_tbllist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <th data-name="fk_id_asignatura" class="<?= $Page->fk_id_asignatura->headerCellClass() ?>"><div id="elh_calificacion_tbl_fk_id_asignatura" class="calificacion_tbl_fk_id_asignatura"><?= $Page->renderFieldHeader($Page->fk_id_asignatura) ?></div></th>
<?php } ?>
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
        <th data-name="fk_id_alumno" class="<?= $Page->fk_id_alumno->headerCellClass() ?>"><div id="elh_calificacion_tbl_fk_id_alumno" class="calificacion_tbl_fk_id_alumno"><?= $Page->renderFieldHeader($Page->fk_id_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { // nota_calificacion ?>
        <th data-name="nota_calificacion" class="<?= $Page->nota_calificacion->headerCellClass() ?>"><div id="elh_calificacion_tbl_nota_calificacion" class="calificacion_tbl_nota_calificacion"><?= $Page->renderFieldHeader($Page->nota_calificacion) ?></div></th>
<?php } ?>
<?php if ($Page->observacion_calificacion->Visible) { // observacion_calificacion ?>
        <th data-name="observacion_calificacion" class="<?= $Page->observacion_calificacion->headerCellClass() ?>"><div id="elh_calificacion_tbl_observacion_calificacion" class="calificacion_tbl_observacion_calificacion"><?= $Page->renderFieldHeader($Page->observacion_calificacion) ?></div></th>
<?php } ?>
<?php if ($Page->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
        <th data-name="fk_id_evaluacion" class="<?= $Page->fk_id_evaluacion->headerCellClass() ?>"><div id="elh_calificacion_tbl_fk_id_evaluacion" class="calificacion_tbl_fk_id_evaluacion"><?= $Page->renderFieldHeader($Page->fk_id_evaluacion) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Page->RowAction != "delete" &&
            $Page->RowAction != "insertdelete" &&
            !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow()) &&
            $Page->RowAction != "hide"
        ) {
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <td data-name="fk_id_asignatura"<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->fk_id_asignatura->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_asignatura->getDisplayValue($Page->fk_id_asignatura->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_fk_id_asignatura" name="x<?= $Page->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_asignatura" class="el_calificacion_tbl_fk_id_asignatura">
    <select
        id="x<?= $Page->RowIndex ?>_fk_id_asignatura"
        name="x<?= $Page->RowIndex ?>_fk_id_asignatura"
        class="form-select ew-select<?= $Page->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_asignatura"
        data-table="calificacion_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Page->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_asignatura->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->fk_id_asignatura->editAttributes() ?>>
        <?= $Page->fk_id_asignatura->selectOptionListHtml("x{$Page->RowIndex}_fk_id_asignatura") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Page->fk_id_asignatura->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_fk_id_asignatura") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_fk_id_asignatura", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_fk_id_asignatura", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_fk_id_asignatura", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_asignatura.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_asignatura" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_fk_id_asignatura" id="o<?= $Page->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Page->fk_id_asignatura->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_asignatura->getDisplayValue($Page->fk_id_asignatura->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_fk_id_asignatura" name="x<?= $Page->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Page->fk_id_asignatura->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_asignatura" class="el_calificacion_tbl_fk_id_asignatura">
    <select
        id="x<?= $Page->RowIndex ?>_fk_id_asignatura"
        name="x<?= $Page->RowIndex ?>_fk_id_asignatura"
        class="form-select ew-select<?= $Page->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_asignatura"
        data-table="calificacion_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Page->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_asignatura->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->fk_id_asignatura->editAttributes() ?>>
        <?= $Page->fk_id_asignatura->selectOptionListHtml("x{$Page->RowIndex}_fk_id_asignatura") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Page->fk_id_asignatura->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_fk_id_asignatura") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_fk_id_asignatura", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_fk_id_asignatura", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_fk_id_asignatura", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_asignatura.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_asignatura" class="el_calificacion_tbl_fk_id_asignatura">
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<?= $Page->fk_id_asignatura->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
        <td data-name="fk_id_alumno"<?= $Page->fk_id_alumno->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->fk_id_alumno->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_alumno->getDisplayValue($Page->fk_id_alumno->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_fk_id_alumno" name="x<?= $Page->RowIndex ?>_fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_alumno" class="el_calificacion_tbl_fk_id_alumno">
    <select
        id="x<?= $Page->RowIndex ?>_fk_id_alumno"
        name="x<?= $Page->RowIndex ?>_fk_id_alumno"
        class="form-select ew-select<?= $Page->fk_id_alumno->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_alumno"
        data-table="calificacion_tbl"
        data-field="x_fk_id_alumno"
        data-value-separator="<?= $Page->fk_id_alumno->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_alumno->getPlaceHolder()) ?>"
        <?= $Page->fk_id_alumno->editAttributes() ?>>
        <?= $Page->fk_id_alumno->selectOptionListHtml("x{$Page->RowIndex}_fk_id_alumno") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->fk_id_alumno->getErrorMessage() ?></div>
<?= $Page->fk_id_alumno->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_fk_id_alumno") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_fk_id_alumno", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_alumno" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.fk_id_alumno?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_fk_id_alumno", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_fk_id_alumno", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_alumno.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_alumno" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_fk_id_alumno" id="o<?= $Page->RowIndex ?>_fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Page->fk_id_alumno->getSessionValue() != "") { ?>
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->fk_id_alumno->getDisplayValue($Page->fk_id_alumno->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_fk_id_alumno" name="x<?= $Page->RowIndex ?>_fk_id_alumno" value="<?= HtmlEncode($Page->fk_id_alumno->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_alumno" class="el_calificacion_tbl_fk_id_alumno">
    <select
        id="x<?= $Page->RowIndex ?>_fk_id_alumno"
        name="x<?= $Page->RowIndex ?>_fk_id_alumno"
        class="form-select ew-select<?= $Page->fk_id_alumno->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_alumno"
        data-table="calificacion_tbl"
        data-field="x_fk_id_alumno"
        data-value-separator="<?= $Page->fk_id_alumno->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_alumno->getPlaceHolder()) ?>"
        <?= $Page->fk_id_alumno->editAttributes() ?>>
        <?= $Page->fk_id_alumno->selectOptionListHtml("x{$Page->RowIndex}_fk_id_alumno") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->fk_id_alumno->getErrorMessage() ?></div>
<?= $Page->fk_id_alumno->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_fk_id_alumno") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_fk_id_alumno", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_alumno" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.fk_id_alumno?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_fk_id_alumno", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_fk_id_alumno", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_alumno.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_alumno" class="el_calificacion_tbl_fk_id_alumno">
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<?= $Page->fk_id_alumno->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->nota_calificacion->Visible) { // nota_calificacion ?>
        <td data-name="nota_calificacion"<?= $Page->nota_calificacion->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_nota_calificacion" class="el_calificacion_tbl_nota_calificacion">
<input type="<?= $Page->nota_calificacion->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_nota_calificacion" id="x<?= $Page->RowIndex ?>_nota_calificacion" data-table="calificacion_tbl" data-field="x_nota_calificacion" value="<?= $Page->nota_calificacion->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->nota_calificacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nota_calificacion->formatPattern()) ?>"<?= $Page->nota_calificacion->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nota_calificacion->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="calificacion_tbl" data-field="x_nota_calificacion" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_nota_calificacion" id="o<?= $Page->RowIndex ?>_nota_calificacion" value="<?= HtmlEncode($Page->nota_calificacion->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_nota_calificacion" class="el_calificacion_tbl_nota_calificacion">
<input type="<?= $Page->nota_calificacion->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_nota_calificacion" id="x<?= $Page->RowIndex ?>_nota_calificacion" data-table="calificacion_tbl" data-field="x_nota_calificacion" value="<?= $Page->nota_calificacion->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->nota_calificacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nota_calificacion->formatPattern()) ?>"<?= $Page->nota_calificacion->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nota_calificacion->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_nota_calificacion" class="el_calificacion_tbl_nota_calificacion">
<span<?= $Page->nota_calificacion->viewAttributes() ?>>
<?= $Page->nota_calificacion->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->observacion_calificacion->Visible) { // observacion_calificacion ?>
        <td data-name="observacion_calificacion"<?= $Page->observacion_calificacion->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_observacion_calificacion" class="el_calificacion_tbl_observacion_calificacion">
<textarea data-table="calificacion_tbl" data-field="x_observacion_calificacion" name="x<?= $Page->RowIndex ?>_observacion_calificacion" id="x<?= $Page->RowIndex ?>_observacion_calificacion" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->observacion_calificacion->getPlaceHolder()) ?>"<?= $Page->observacion_calificacion->editAttributes() ?>><?= $Page->observacion_calificacion->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->observacion_calificacion->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="calificacion_tbl" data-field="x_observacion_calificacion" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_observacion_calificacion" id="o<?= $Page->RowIndex ?>_observacion_calificacion" value="<?= HtmlEncode($Page->observacion_calificacion->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_observacion_calificacion" class="el_calificacion_tbl_observacion_calificacion">
<textarea data-table="calificacion_tbl" data-field="x_observacion_calificacion" name="x<?= $Page->RowIndex ?>_observacion_calificacion" id="x<?= $Page->RowIndex ?>_observacion_calificacion" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->observacion_calificacion->getPlaceHolder()) ?>"<?= $Page->observacion_calificacion->editAttributes() ?>><?= $Page->observacion_calificacion->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->observacion_calificacion->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_observacion_calificacion" class="el_calificacion_tbl_observacion_calificacion">
<span<?= $Page->observacion_calificacion->viewAttributes() ?>>
<?= $Page->observacion_calificacion->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
        <td data-name="fk_id_evaluacion"<?= $Page->fk_id_evaluacion->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_evaluacion" class="el_calificacion_tbl_fk_id_evaluacion">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Page->RowIndex ?>_fk_id_evaluacion"
        name="x<?= $Page->RowIndex ?>_fk_id_evaluacion"
        class="form-select ew-select<?= $Page->fk_id_evaluacion->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_evaluacion"
        data-table="calificacion_tbl"
        data-field="x_fk_id_evaluacion"
        data-value-separator="<?= $Page->fk_id_evaluacion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_evaluacion->getPlaceHolder()) ?>"
        <?= $Page->fk_id_evaluacion->editAttributes() ?>>
        <?= $Page->fk_id_evaluacion->selectOptionListHtml("x{$Page->RowIndex}_fk_id_evaluacion") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "evaluacion_tbl") && !$Page->fk_id_evaluacion->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_fk_id_evaluacion" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->fk_id_evaluacion->caption() ?>" data-title="<?= $Page->fk_id_evaluacion->caption() ?>" data-ew-action="add-option" data-el="x<?= $Page->RowIndex ?>_fk_id_evaluacion" data-url="<?= GetUrl("EvaluacionTblAddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Page->fk_id_evaluacion->getErrorMessage() ?></div>
<?= $Page->fk_id_evaluacion->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_fk_id_evaluacion") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_fk_id_evaluacion", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_evaluacion" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.fk_id_evaluacion?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_fk_id_evaluacion", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_fk_id_evaluacion", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_evaluacion.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_evaluacion" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_fk_id_evaluacion" id="o<?= $Page->RowIndex ?>_fk_id_evaluacion" value="<?= HtmlEncode($Page->fk_id_evaluacion->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_evaluacion" class="el_calificacion_tbl_fk_id_evaluacion">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Page->RowIndex ?>_fk_id_evaluacion"
        name="x<?= $Page->RowIndex ?>_fk_id_evaluacion"
        class="form-select ew-select<?= $Page->fk_id_evaluacion->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_evaluacion"
        data-table="calificacion_tbl"
        data-field="x_fk_id_evaluacion"
        data-value-separator="<?= $Page->fk_id_evaluacion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->fk_id_evaluacion->getPlaceHolder()) ?>"
        <?= $Page->fk_id_evaluacion->editAttributes() ?>>
        <?= $Page->fk_id_evaluacion->selectOptionListHtml("x{$Page->RowIndex}_fk_id_evaluacion") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "evaluacion_tbl") && !$Page->fk_id_evaluacion->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_fk_id_evaluacion" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->fk_id_evaluacion->caption() ?>" data-title="<?= $Page->fk_id_evaluacion->caption() ?>" data-ew-action="add-option" data-el="x<?= $Page->RowIndex ?>_fk_id_evaluacion" data-url="<?= GetUrl("EvaluacionTblAddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Page->fk_id_evaluacion->getErrorMessage() ?></div>
<?= $Page->fk_id_evaluacion->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_fk_id_evaluacion") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_fk_id_evaluacion", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_fk_id_evaluacion" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.fk_id_evaluacion?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_fk_id_evaluacion", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_fk_id_evaluacion", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_evaluacion.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_calificacion_tbl_fk_id_evaluacion" class="el_calificacion_tbl_fk_id_evaluacion">
<span<?= $Page->fk_id_evaluacion->viewAttributes() ?>>
<?= $Page->fk_id_evaluacion->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Page->RowIndex ?>">
loadjs.ready(["<?= $Page->FormName ?>","load"], () => <?= $Page->FormName ?>.updateLists(<?= $Page->RowIndex ?><?= $Page->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (
        $Page->Recordset &&
        !$Page->Recordset->EOF &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        (!(($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0))
    ) {
        $Page->Recordset->moveNext();
    }
    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($Page->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?= $Page->MultiSelectKey ?>
<?php } ?>
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
<?php } ?>
