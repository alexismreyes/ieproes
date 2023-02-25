<?php

namespace PHPMaker2023\ieproes;

// Set up and run Grid object
$Grid = Container("AlumnosAsignaturaTblGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var falumnos_asignatura_tblgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { alumnos_asignatura_tbl: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("falumnos_asignatura_tblgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["fk_id_asignatura", [fields.fk_id_asignatura.visible && fields.fk_id_asignatura.required ? ew.Validators.required(fields.fk_id_asignatura.caption) : null], fields.fk_id_asignatura.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["fk_id_asignatura",false]];
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
<div id="falumnos_asignatura_tblgrid" class="ew-form ew-list-form">
<div id="gmp_alumnos_asignatura_tbl" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_alumnos_asignatura_tblgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="fk_id_asignatura" class="<?= $Grid->fk_id_asignatura->headerCellClass() ?>"><div id="elh_alumnos_asignatura_tbl_fk_id_asignatura" class="alumnos_asignatura_tbl_fk_id_asignatura"><?= $Grid->renderFieldHeader($Grid->fk_id_asignatura) ?></div></th>
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
<span id="el<?= $Grid->RowCount ?>_alumnos_asignatura_tbl_fk_id_asignatura" class="el_alumnos_asignatura_tbl_fk_id_asignatura">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        name="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        class="form-select ew-select<?= $Grid->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="falumnos_asignatura_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        data-table="alumnos_asignatura_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Grid->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_asignatura->getPlaceHolder()) ?>"
        <?= $Grid->fk_id_asignatura->editAttributes() ?>>
        <?= $Grid->fk_id_asignatura->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_asignatura") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Grid->fk_id_asignatura->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_asignatura") ?>
<script>
loadjs.ready("falumnos_asignatura_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", selectId: "falumnos_asignatura_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (falumnos_asignatura_tblgrid.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "falumnos_asignatura_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "falumnos_asignatura_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.alumnos_asignatura_tbl.fields.fk_id_asignatura.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="alumnos_asignatura_tbl" data-field="x_fk_id_asignatura" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_fk_id_asignatura" id="o<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_alumnos_asignatura_tbl_fk_id_asignatura" class="el_alumnos_asignatura_tbl_fk_id_asignatura">
    <select
        id="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        name="x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        class="form-select ew-select<?= $Grid->fk_id_asignatura->isInvalidClass() ?>"
        data-select2-id="falumnos_asignatura_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura"
        data-table="alumnos_asignatura_tbl"
        data-field="x_fk_id_asignatura"
        data-value-separator="<?= $Grid->fk_id_asignatura->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->fk_id_asignatura->getPlaceHolder()) ?>"
        <?= $Grid->fk_id_asignatura->editAttributes() ?>>
        <?= $Grid->fk_id_asignatura->selectOptionListHtml("x{$Grid->RowIndex}_fk_id_asignatura") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->fk_id_asignatura->getErrorMessage() ?></div>
<?= $Grid->fk_id_asignatura->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_fk_id_asignatura") ?>
<script>
loadjs.ready("falumnos_asignatura_tblgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", selectId: "falumnos_asignatura_tblgrid_x<?= $Grid->RowIndex ?>_fk_id_asignatura" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (falumnos_asignatura_tblgrid.lists.fk_id_asignatura?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "falumnos_asignatura_tblgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_fk_id_asignatura", form: "falumnos_asignatura_tblgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.alumnos_asignatura_tbl.fields.fk_id_asignatura.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_alumnos_asignatura_tbl_fk_id_asignatura" class="el_alumnos_asignatura_tbl_fk_id_asignatura">
<span<?= $Grid->fk_id_asignatura->viewAttributes() ?>>
<?= $Grid->fk_id_asignatura->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="alumnos_asignatura_tbl" data-field="x_fk_id_asignatura" data-hidden="1" name="falumnos_asignatura_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_asignatura" id="falumnos_asignatura_tblgrid$x<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->FormValue) ?>">
<input type="hidden" data-table="alumnos_asignatura_tbl" data-field="x_fk_id_asignatura" data-hidden="1" data-old name="falumnos_asignatura_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_asignatura" id="falumnos_asignatura_tblgrid$o<?= $Grid->RowIndex ?>_fk_id_asignatura" value="<?= HtmlEncode($Grid->fk_id_asignatura->OldValue) ?>">
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
loadjs.ready(["falumnos_asignatura_tblgrid","load"], () => falumnos_asignatura_tblgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="falumnos_asignatura_tblgrid">
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
    ew.addEventHandlers("alumnos_asignatura_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
