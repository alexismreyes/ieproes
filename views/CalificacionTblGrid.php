<?php

namespace PHPMaker2023\ieproes;

// Set up and run Grid object
$Grid = Container("CalificacionTblGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fcalificacion_tblgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { calificacion_tbl: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcalificacion_tblgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

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
            "fk_id_asignatura": <?= $Grid->fk_id_asignatura->toClientList($Grid) ?>,
            "fk_id_alumno": <?= $Grid->fk_id_alumno->toClientList($Grid) ?>,
            "fk_id_evaluacion": <?= $Grid->fk_id_evaluacion->toClientList($Grid) ?>,
        })
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list<?= ($Grid->TotalRecords == 0 && !$Grid->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<div id="fcalificacion_tblgrid" class="ew-form ew-list-form">
<div id="gmp_calificacion_tbl" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_calificacion_tblgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <th data-name="fk_id_asignatura" class="<?= $Grid->fk_id_asignatura->headerCellClass() ?>"><div id="elh_calificacion_tbl_fk_id_asignatura" class="calificacion_tbl_fk_id_asignatura"><?= $Grid->renderFieldHeader($Grid->fk_id_asignatura) ?></div></th>
<?php } ?>
<?php if ($Grid->fk_id_alumno->Visible) { // fk_id_alumno ?>
        <th data-name="fk_id_alumno" class="<?= $Grid->fk_id_alumno->headerCellClass() ?>"><div id="elh_calificacion_tbl_fk_id_alumno" class="calificacion_tbl_fk_id_alumno"><?= $Grid->renderFieldHeader($Grid->fk_id_alumno) ?></div></th>
<?php } ?>
<?php if ($Grid->nota_calificacion->Visible) { // nota_calificacion ?>
        <th data-name="nota_calificacion" class="<?= $Grid->nota_calificacion->headerCellClass() ?>"><div id="elh_calificacion_tbl_nota_calificacion" class="calificacion_tbl_nota_calificacion"><?= $Grid->renderFieldHeader($Grid->nota_calificacion) ?></div></th>
<?php } ?>
<?php if ($Grid->observacion_calificacion->Visible) { // observacion_calificacion ?>
        <th data-name="observacion_calificacion" class="<?= $Grid->observacion_calificacion->headerCellClass() ?>"><div id="elh_calificacion_tbl_observacion_calificacion" class="calificacion_tbl_observacion_calificacion"><?= $Grid->renderFieldHeader($Grid->observacion_calificacion) ?></div></th>
<?php } ?>
<?php if ($Grid->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
        <th data-name="fk_id_evaluacion" class="<?= $Grid->fk_id_evaluacion->headerCellClass() ?>"><div id="elh_calificacion_tbl_fk_id_evaluacion" class="calificacion_tbl_fk_id_evaluacion"><?= $Grid->renderFieldHeader($Grid->fk_id_evaluacion) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Grid->getPageNumber() ?>">
<?php
$Grid->setupGrid();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Grid->RowAction != "delete" &&
            $Grid->RowAction != "insertdelete" &&
            !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow()) &&
            $Grid->RowAction != "hide"
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <td data-name="fk_id_asignatura"<?= $Grid->fk_id_asignatura->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->fk_id_asignatura->getSessionValue() != "") { ?>
<span<?= $Grid->fk_id_asignatura->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->fk_id_asignatura->getDisplayValue($Grid->fk_id_asignatura->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_fk_id_asignatura" name="x<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_asignatura" class="el_calificacion_tbl_fk_id_asignatura">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        name="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        class="form-select ew-select<?= $Grid->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        data-table="calificacion_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Grid->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_asignatura->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->fk_id_asignatura->editAttributes() ?>>
        <?= $Grid->fk_id_asignatura->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_asignatura") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Grid->fk_id_asignatura->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_asignatura") ?>
<script>
loadjs.ready("fcalificacion_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", selectId: "fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblgrid.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "fcalificacion_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "fcalificacion_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_asignatura.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_asignatura" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_fk_id_asignatura" id="o<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->fk_id_asignatura->getSessionValue() != "") { ?>
<span<?= $Grid->fk_id_asignatura->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->fk_id_asignatura->getDisplayValue($Grid->fk_id_asignatura->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_fk_id_asignatura" name="x<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_asignatura" class="el_calificacion_tbl_fk_id_asignatura">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        name="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        class="form-select ew-select<?= $Grid->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        data-table="calificacion_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Grid->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_asignatura->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->fk_id_asignatura->editAttributes() ?>>
        <?= $Grid->fk_id_asignatura->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_asignatura") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Grid->fk_id_asignatura->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_asignatura") ?>
<script>
loadjs.ready("fcalificacion_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", selectId: "fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblgrid.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "fcalificacion_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "fcalificacion_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_asignatura.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_asignatura" class="el_calificacion_tbl_fk_id_asignatura">
<span<?= $Grid->fk_id_asignatura->viewAttributes() ?>>
<?= $Grid->fk_id_asignatura->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_asignatura" data-hidden="1" name="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_asignatura" id="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->FormValue) ?>">
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_asignatura" data-hidden="1" data-old name="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_asignatura" id="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->fk_id_alumno->Visible) { // fk_id_alumno ?>
        <td data-name="fk_id_alumno"<?= $Grid->fk_id_alumno->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_alumno" class="el_calificacion_tbl_fk_id_alumno">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_alumno"
        name="x<?= $Grid->RowIndex ?>_fk_id_alumno"
        class="form-select ew-select<?= $Grid->fk_id_alumno->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_alumno"
        data-table="calificacion_tbl"
        data-field="x_fk_id_alumno"
        data-value-separator="<?= $Grid->fk_id_alumno->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_alumno->getPlaceHolder()) ?>"
        <?= $Grid->fk_id_alumno->editAttributes() ?>>
        <?= $Grid->fk_id_alumno->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_alumno") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->fk_id_alumno->getErrorMessage() ?></div>
<?= $Grid->fk_id_alumno->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_alumno") ?>
<script>
loadjs.ready("fcalificacion_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_alumno", selectId: "fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_alumno" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblgrid.lists.fk_id_alumno?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_alumno", form: "fcalificacion_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_alumno", form: "fcalificacion_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_alumno.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_alumno" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_fk_id_alumno" id="o<?= $Grid->RowIndex ?>_fk_id_alumno" value="<?= HtmlEncode($Grid->fk_id_alumno->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_alumno" class="el_calificacion_tbl_fk_id_alumno">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_alumno"
        name="x<?= $Grid->RowIndex ?>_fk_id_alumno"
        class="form-select ew-select<?= $Grid->fk_id_alumno->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_alumno"
        data-table="calificacion_tbl"
        data-field="x_fk_id_alumno"
        data-value-separator="<?= $Grid->fk_id_alumno->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_alumno->getPlaceHolder()) ?>"
        <?= $Grid->fk_id_alumno->editAttributes() ?>>
        <?= $Grid->fk_id_alumno->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_alumno") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->fk_id_alumno->getErrorMessage() ?></div>
<?= $Grid->fk_id_alumno->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_alumno") ?>
<script>
loadjs.ready("fcalificacion_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_alumno", selectId: "fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_alumno" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblgrid.lists.fk_id_alumno?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_alumno", form: "fcalificacion_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_alumno", form: "fcalificacion_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_alumno.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_alumno" class="el_calificacion_tbl_fk_id_alumno">
<span<?= $Grid->fk_id_alumno->viewAttributes() ?>>
<?= $Grid->fk_id_alumno->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_alumno" data-hidden="1" name="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_alumno" id="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_alumno" value="<?= HtmlEncode($Grid->fk_id_alumno->FormValue) ?>">
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_alumno" data-hidden="1" data-old name="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_alumno" id="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_alumno" value="<?= HtmlEncode($Grid->fk_id_alumno->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nota_calificacion->Visible) { // nota_calificacion ?>
        <td data-name="nota_calificacion"<?= $Grid->nota_calificacion->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_nota_calificacion" class="el_calificacion_tbl_nota_calificacion">
<input type="<?= $Grid->nota_calificacion->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nota_calificacion" id="x<?= $Grid->RowIndex ?>_nota_calificacion" data-table="calificacion_tbl" data-field="x_nota_calificacion" value="<?= $Grid->nota_calificacion->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->nota_calificacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->nota_calificacion->formatPattern()) ?>"<?= $Grid->nota_calificacion->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nota_calificacion->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="calificacion_tbl" data-field="x_nota_calificacion" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_nota_calificacion" id="o<?= $Grid->RowIndex ?>_nota_calificacion" value="<?= HtmlEncode($Grid->nota_calificacion->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_nota_calificacion" class="el_calificacion_tbl_nota_calificacion">
<input type="<?= $Grid->nota_calificacion->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nota_calificacion" id="x<?= $Grid->RowIndex ?>_nota_calificacion" data-table="calificacion_tbl" data-field="x_nota_calificacion" value="<?= $Grid->nota_calificacion->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Grid->nota_calificacion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->nota_calificacion->formatPattern()) ?>"<?= $Grid->nota_calificacion->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nota_calificacion->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_nota_calificacion" class="el_calificacion_tbl_nota_calificacion">
<span<?= $Grid->nota_calificacion->viewAttributes() ?>>
<?= $Grid->nota_calificacion->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_nota_calificacion" data-hidden="1" name="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_nota_calificacion" id="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_nota_calificacion" value="<?= HtmlEncode($Grid->nota_calificacion->FormValue) ?>">
<input type="hidden" data-table="calificacion_tbl" data-field="x_nota_calificacion" data-hidden="1" data-old name="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_nota_calificacion" id="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_nota_calificacion" value="<?= HtmlEncode($Grid->nota_calificacion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->observacion_calificacion->Visible) { // observacion_calificacion ?>
        <td data-name="observacion_calificacion"<?= $Grid->observacion_calificacion->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_observacion_calificacion" class="el_calificacion_tbl_observacion_calificacion">
<textarea data-table="calificacion_tbl" data-field="x_observacion_calificacion" name="x<?= $Grid->RowIndex ?>_observacion_calificacion" id="x<?= $Grid->RowIndex ?>_observacion_calificacion" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->observacion_calificacion->getPlaceHolder()) ?>"<?= $Grid->observacion_calificacion->editAttributes() ?>><?= $Grid->observacion_calificacion->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->observacion_calificacion->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="calificacion_tbl" data-field="x_observacion_calificacion" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_observacion_calificacion" id="o<?= $Grid->RowIndex ?>_observacion_calificacion" value="<?= HtmlEncode($Grid->observacion_calificacion->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_observacion_calificacion" class="el_calificacion_tbl_observacion_calificacion">
<textarea data-table="calificacion_tbl" data-field="x_observacion_calificacion" name="x<?= $Grid->RowIndex ?>_observacion_calificacion" id="x<?= $Grid->RowIndex ?>_observacion_calificacion" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->observacion_calificacion->getPlaceHolder()) ?>"<?= $Grid->observacion_calificacion->editAttributes() ?>><?= $Grid->observacion_calificacion->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->observacion_calificacion->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_observacion_calificacion" class="el_calificacion_tbl_observacion_calificacion">
<span<?= $Grid->observacion_calificacion->viewAttributes() ?>>
<?= $Grid->observacion_calificacion->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_observacion_calificacion" data-hidden="1" name="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_observacion_calificacion" id="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_observacion_calificacion" value="<?= HtmlEncode($Grid->observacion_calificacion->FormValue) ?>">
<input type="hidden" data-table="calificacion_tbl" data-field="x_observacion_calificacion" data-hidden="1" data-old name="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_observacion_calificacion" id="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_observacion_calificacion" value="<?= HtmlEncode($Grid->observacion_calificacion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
        <td data-name="fk_id_evaluacion"<?= $Grid->fk_id_evaluacion->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_evaluacion" class="el_calificacion_tbl_fk_id_evaluacion">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_evaluacion"
        name="x<?= $Grid->RowIndex ?>_fk_id_evaluacion"
        class="form-select ew-select<?= $Grid->fk_id_evaluacion->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_evaluacion"
        data-table="calificacion_tbl"
        data-field="x_fk_id_evaluacion"
        data-value-separator="<?= $Grid->fk_id_evaluacion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_evaluacion->getPlaceHolder()) ?>"
        <?= $Grid->fk_id_evaluacion->editAttributes() ?>>
        <?= $Grid->fk_id_evaluacion->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_evaluacion") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "evaluacion_tbl") && !$Grid->fk_id_evaluacion->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fk_id_evaluacion" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fk_id_evaluacion->caption() ?>" data-title="<?= $Grid->fk_id_evaluacion->caption() ?>" data-ew-action="add-option" data-el="x<?= $Grid->RowIndex ?>_fk_id_evaluacion" data-url="<?= GetUrl("EvaluacionTblAddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Grid->fk_id_evaluacion->getErrorMessage() ?></div>
<?= $Grid->fk_id_evaluacion->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_evaluacion") ?>
<script>
loadjs.ready("fcalificacion_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_evaluacion", selectId: "fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_evaluacion" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblgrid.lists.fk_id_evaluacion?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_evaluacion", form: "fcalificacion_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_evaluacion", form: "fcalificacion_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_evaluacion.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_evaluacion" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_fk_id_evaluacion" id="o<?= $Grid->RowIndex ?>_fk_id_evaluacion" value="<?= HtmlEncode($Grid->fk_id_evaluacion->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_evaluacion" class="el_calificacion_tbl_fk_id_evaluacion">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_evaluacion"
        name="x<?= $Grid->RowIndex ?>_fk_id_evaluacion"
        class="form-select ew-select<?= $Grid->fk_id_evaluacion->isInvalidClass() ?>"
        data-select2-id="fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_evaluacion"
        data-table="calificacion_tbl"
        data-field="x_fk_id_evaluacion"
        data-value-separator="<?= $Grid->fk_id_evaluacion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_evaluacion->getPlaceHolder()) ?>"
        <?= $Grid->fk_id_evaluacion->editAttributes() ?>>
        <?= $Grid->fk_id_evaluacion->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_evaluacion") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "evaluacion_tbl") && !$Grid->fk_id_evaluacion->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_fk_id_evaluacion" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->fk_id_evaluacion->caption() ?>" data-title="<?= $Grid->fk_id_evaluacion->caption() ?>" data-ew-action="add-option" data-el="x<?= $Grid->RowIndex ?>_fk_id_evaluacion" data-url="<?= GetUrl("EvaluacionTblAddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Grid->fk_id_evaluacion->getErrorMessage() ?></div>
<?= $Grid->fk_id_evaluacion->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_evaluacion") ?>
<script>
loadjs.ready("fcalificacion_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_evaluacion", selectId: "fcalificacion_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_evaluacion" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fcalificacion_tblgrid.lists.fk_id_evaluacion?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_evaluacion", form: "fcalificacion_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_evaluacion", form: "fcalificacion_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.calificacion_tbl.fields.fk_id_evaluacion.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_calificacion_tbl_fk_id_evaluacion" class="el_calificacion_tbl_fk_id_evaluacion">
<span<?= $Grid->fk_id_evaluacion->viewAttributes() ?>>
<?= $Grid->fk_id_evaluacion->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_evaluacion" data-hidden="1" name="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_evaluacion" id="fcalificacion_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_evaluacion" value="<?= HtmlEncode($Grid->fk_id_evaluacion->FormValue) ?>">
<input type="hidden" data-table="calificacion_tbl" data-field="x_fk_id_evaluacion" data-hidden="1" data-old name="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_evaluacion" id="fcalificacion_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_evaluacion" value="<?= HtmlEncode($Grid->fk_id_evaluacion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["fcalificacion_tblgrid","load"], () => fcalificacion_tblgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (
        $Grid->Recordset &&
        !$Grid->Recordset->EOF &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        (!(($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0))
    ) {
        $Grid->Recordset->moveNext();
    }
    // Reset for template row
    if ($Grid->RowIndex === '$rowindex$') {
        $Grid->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0) {
        $Grid->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcalificacion_tblgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php if (!$Grid->isExport()) { ?>
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
