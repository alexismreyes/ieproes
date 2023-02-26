<?php

namespace PHPMaker2023\ieproes;

// Page object
$PromedioxasignaturaRptSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { promedioxasignatura_rpt: currentTable } });
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
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Middle Container -->
<div id="ew-middle" class="<?= $Page->MiddleContentClass ?>">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-content" class="<?= $Page->ContainerClass ?>">
<?php } ?>
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
<div id="gmp_promedioxasignatura_rpt" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<?php } ?>
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->CONCATalmnombre_alumnoalmapellidos_alumno->Visible) { ?>
    <th data-name="CONCATalmnombre_alumnoalmapellidos_alumno" class="<?= $Page->CONCATalmnombre_alumnoalmapellidos_alumno->headerCellClass() ?>"><div class="promedioxasignatura_rpt_CONCATalmnombre_alumnoalmapellidos_alumno"><?= $Page->renderFieldHeader($Page->CONCATalmnombre_alumnoalmapellidos_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->nombre_asignatura->Visible) { ?>
    <th data-name="nombre_asignatura" class="<?= $Page->nombre_asignatura->headerCellClass() ?>"><div class="promedioxasignatura_rpt_nombre_asignatura"><?= $Page->renderFieldHeader($Page->nombre_asignatura) ?></div></th>
<?php } ?>
<?php if ($Page->AVGcalnota_calificacion->Visible) { ?>
    <th data-name="AVGcalnota_calificacion" class="<?= $Page->AVGcalnota_calificacion->headerCellClass() ?>"><div class="promedioxasignatura_rpt_AVGcalnota_calificacion"><?= $Page->renderFieldHeader($Page->AVGcalnota_calificacion) ?></div></th>
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
<?php if ($Page->AVGcalnota_calificacion->Visible) { ?>
        <td data-field="AVGcalnota_calificacion"<?= $Page->AVGcalnota_calificacion->cellAttributes() ?>>
<span<?= $Page->AVGcalnota_calificacion->viewAttributes() ?>>
<?= $Page->AVGcalnota_calificacion->getViewValue() ?></span>
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
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-content -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-middle -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->promediopormateria_chart->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->promediopormateria_chart->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->alumnosporasignatura_chart->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->alumnosporasignatura_chart->render("ew-chart-bottom");
}
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if (!$DashboardReport && !$Page->isExport()) { ?>
<div class="mb-3"><a class="ew-top-link" data-ew-action="scroll-top"><?= $Language->phrase("Top") ?></a></div>
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
