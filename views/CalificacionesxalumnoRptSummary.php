<?php

namespace PHPMaker2023\ieproes;

// Page object
$CalificacionesxalumnoRptSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { calificacionesxalumno_rpt: currentTable } });
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
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->ShowReport) { ?>
<!-- Summary report (begin) -->
<?php if (!$Page->isExport("pdf")) { ?>
<main class="report-summary<?= ($Page->TotalGroups == 0) ? " ew-no-record" : "" ?>">
<?php } ?>
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<?php if (!$Page->isExport("pdf")) { ?>
<div class="<?= $Page->ReportContainerClass ?>">
<?php } ?>
<?php if (!$Page->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_calificacionesxalumno_rpt" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<?php } ?>
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->CONCATalmnombre_alumnoalmapellidos_alumno->Visible) { ?>
    <th data-name="CONCATalmnombre_alumnoalmapellidos_alumno" class="<?= $Page->CONCATalmnombre_alumnoalmapellidos_alumno->headerCellClass() ?>"><div class="calificacionesxalumno_rpt_CONCATalmnombre_alumnoalmapellidos_alumno"><?= $Page->renderFieldHeader($Page->CONCATalmnombre_alumnoalmapellidos_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->nombre_asignatura->Visible) { ?>
    <th data-name="nombre_asignatura" class="<?= $Page->nombre_asignatura->headerCellClass() ?>"><div class="calificacionesxalumno_rpt_nombre_asignatura"><?= $Page->renderFieldHeader($Page->nombre_asignatura) ?></div></th>
<?php } ?>
<?php if ($Page->nombre_evaluacion->Visible) { ?>
    <th data-name="nombre_evaluacion" class="<?= $Page->nombre_evaluacion->headerCellClass() ?>"><div class="calificacionesxalumno_rpt_nombre_evaluacion"><?= $Page->renderFieldHeader($Page->nombre_evaluacion) ?></div></th>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { ?>
    <th data-name="nota_calificacion" class="<?= $Page->nota_calificacion->headerCellClass() ?>"><div class="calificacionesxalumno_rpt_nota_calificacion"><?= $Page->renderFieldHeader($Page->nota_calificacion) ?></div></th>
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
<?php if ($Page->CONCATalmnombre_alumnoalmapellidos_alumno->Visible) { ?>
        <td data-field="CONCATalmnombre_alumnoalmapellidos_alumno"<?= $Page->CONCATalmnombre_alumnoalmapellidos_alumno->cellAttributes() ?>>
<span<?= $Page->CONCATalmnombre_alumnoalmapellidos_alumno->viewAttributes() ?>>
<?= $Page->CONCATalmnombre_alumnoalmapellidos_alumno->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nombre_asignatura->Visible) { ?>
        <td data-field="nombre_asignatura"<?= $Page->nombre_asignatura->cellAttributes() ?>>
<span<?= $Page->nombre_asignatura->viewAttributes() ?>>
<?= $Page->nombre_asignatura->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nombre_evaluacion->Visible) { ?>
        <td data-field="nombre_evaluacion"<?= $Page->nombre_evaluacion->cellAttributes() ?>>
<span<?= $Page->nombre_evaluacion->viewAttributes() ?>>
<?= $Page->nombre_evaluacion->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nota_calificacion->Visible) { ?>
        <td data-field="nota_calificacion"<?= $Page->nota_calificacion->cellAttributes() ?>>
<span<?= $Page->nota_calificacion->viewAttributes() ?>>
<?= $Page->nota_calificacion->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
<?php if (!$Page->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<?php if (!$Page->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Page->isExport("pdf")) { ?>
</main>
<!-- /.report-summary -->
<?php } ?>
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
