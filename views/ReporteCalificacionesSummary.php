<?php

namespace PHPMaker2023\ieproes;

// Page object
$ReporteCalificacionesSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ReporteCalificaciones: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<form name="fReporteCalificacionessrch" id="fReporteCalificacionessrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fReporteCalificacionessrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ReporteCalificaciones: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
var fReporteCalificacionessrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fReporteCalificacionessrch")
        .setPageId("summary")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
            ["fk_id_asignatura", [], fields.fk_id_asignatura.isInvalid],
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

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->fk_id_alumno->Visible) { // fk_id_alumno ?>
<?php
if (!$Page->fk_id_alumno->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_fk_id_alumno" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->fk_id_alumno->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_fk_id_alumno"
            name="x_fk_id_alumno[]"
            class="form-control ew-select<?= $Page->fk_id_alumno->isInvalidClass() ?>"
            data-select2-id="fReporteCalificacionessrch_x_fk_id_alumno"
            data-table="ReporteCalificaciones"
            data-field="x_fk_id_alumno"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->fk_id_alumno->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->fk_id_alumno->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->fk_id_alumno->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->fk_id_alumno->editAttributes() ?>>
            <?= $Page->fk_id_alumno->selectOptionListHtml("x_fk_id_alumno", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->fk_id_alumno->getErrorMessage() ?></div>
        <?= $Page->fk_id_alumno->Lookup->getParamTag($Page, "p_x_fk_id_alumno") ?>
        <script>
        loadjs.ready("fReporteCalificacionessrch", function() {
            var options = {
                name: "x_fk_id_alumno",
                selectId: "fReporteCalificacionessrch_x_fk_id_alumno",
                ajax: { id: "x_fk_id_alumno", form: "fReporteCalificacionessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.ReporteCalificaciones.fields.fk_id_alumno.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->fk_id_evaluacion->Visible) { // fk_id_evaluacion ?>
<?php
if (!$Page->fk_id_evaluacion->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_fk_id_evaluacion" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->fk_id_evaluacion->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_fk_id_evaluacion"
            name="x_fk_id_evaluacion[]"
            class="form-control ew-select<?= $Page->fk_id_evaluacion->isInvalidClass() ?>"
            data-select2-id="fReporteCalificacionessrch_x_fk_id_evaluacion"
            data-table="ReporteCalificaciones"
            data-field="x_fk_id_evaluacion"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->fk_id_evaluacion->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->fk_id_evaluacion->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->fk_id_evaluacion->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->fk_id_evaluacion->editAttributes() ?>>
            <?= $Page->fk_id_evaluacion->selectOptionListHtml("x_fk_id_evaluacion", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->fk_id_evaluacion->getErrorMessage() ?></div>
        <?= $Page->fk_id_evaluacion->Lookup->getParamTag($Page, "p_x_fk_id_evaluacion") ?>
        <script>
        loadjs.ready("fReporteCalificacionessrch", function() {
            var options = {
                name: "x_fk_id_evaluacion",
                selectId: "fReporteCalificacionessrch_x_fk_id_evaluacion",
                ajax: { id: "x_fk_id_evaluacion", form: "fReporteCalificacionessrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.ReporteCalificaciones.fields.fk_id_evaluacion.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SearchColumnCount > 0) { ?>
   <div class="col-sm-auto mb-3">
       <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
   </div>
<?php } ?>
</div><!-- /.row -->
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
<?php if ($Page->ShowReport) { ?>
<!-- Summary report (begin) -->
<main class="report-summary<?= ($Page->TotalGroups == 0) ? " ew-no-record" : "" ?>">
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?= $Page->ReportContainerClass ?>">
<!-- Report grid (begin) -->
<div id="gmp_ReporteCalificaciones" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->fk_id_asignatura->Visible) { ?>
    <th data-name="fk_id_asignatura" class="<?= $Page->fk_id_asignatura->headerCellClass() ?>"><div class="ReporteCalificaciones_fk_id_asignatura"><?= $Page->renderFieldHeader($Page->fk_id_asignatura) ?></div></th>
<?php } ?>
<?php if ($Page->fk_id_alumno->Visible) { ?>
    <th data-name="fk_id_alumno" class="<?= $Page->fk_id_alumno->headerCellClass() ?>"><div class="ReporteCalificaciones_fk_id_alumno"><?= $Page->renderFieldHeader($Page->fk_id_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { ?>
    <th data-name="nota_calificacion" class="<?= $Page->nota_calificacion->headerCellClass() ?>"><div class="ReporteCalificaciones_nota_calificacion"><?= $Page->renderFieldHeader($Page->nota_calificacion) ?></div></th>
<?php } ?>
<?php if ($Page->fk_id_evaluacion->Visible) { ?>
    <th data-name="fk_id_evaluacion" class="<?= $Page->fk_id_evaluacion->headerCellClass() ?>"><div class="ReporteCalificaciones_fk_id_evaluacion"><?= $Page->renderFieldHeader($Page->fk_id_evaluacion) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->fk_id_asignatura->Visible) { ?>
        <td data-field="fk_id_asignatura"<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<?= $Page->fk_id_asignatura->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->fk_id_alumno->Visible) { ?>
        <td data-field="fk_id_alumno"<?= $Page->fk_id_alumno->cellAttributes() ?>>
<span<?= $Page->fk_id_alumno->viewAttributes() ?>>
<?= $Page->fk_id_alumno->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { ?>
        <td data-field="nota_calificacion"<?= $Page->nota_calificacion->cellAttributes() ?>>
<span<?= $Page->nota_calificacion->viewAttributes() ?>>
<?= $Page->nota_calificacion->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->fk_id_evaluacion->Visible) { ?>
        <td data-field="fk_id_evaluacion"<?= $Page->fk_id_evaluacion->cellAttributes() ?>>
<span<?= $Page->fk_id_evaluacion->viewAttributes() ?>>
<?= $Page->fk_id_evaluacion->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GRAND;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</main>
<!-- /.report-summary -->
<!-- Summary report (end) -->
<?php } ?>
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
