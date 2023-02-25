<?php

namespace PHPMaker2023\ieproes;

// Page object
$AlumnosporasignturaVwList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnosporasigntura_vw: currentTable } });
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
<?php if (!$Page->IsModal) { ?>
<form name="falumnosporasigntura_vwsrch" id="falumnosporasigntura_vwsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="falumnosporasigntura_vwsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnosporasigntura_vw: currentTable } });
var currentForm;
var falumnosporasigntura_vwsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("falumnosporasigntura_vwsrch")
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="falumnosporasigntura_vwsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="falumnosporasigntura_vwsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="falumnosporasigntura_vwsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="falumnosporasigntura_vwsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="alumnosporasigntura_vw">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_alumnosporasigntura_vw" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_alumnosporasigntura_vwlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->nombre_alumno->Visible) { // nombre_alumno ?>
        <th data-name="nombre_alumno" class="<?= $Page->nombre_alumno->headerCellClass() ?>"><div id="elh_alumnosporasigntura_vw_nombre_alumno" class="alumnosporasigntura_vw_nombre_alumno"><?= $Page->renderFieldHeader($Page->nombre_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->apellidos_alumno->Visible) { // apellidos_alumno ?>
        <th data-name="apellidos_alumno" class="<?= $Page->apellidos_alumno->headerCellClass() ?>"><div id="elh_alumnosporasigntura_vw_apellidos_alumno" class="alumnosporasigntura_vw_apellidos_alumno"><?= $Page->renderFieldHeader($Page->apellidos_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->numcarnet_alumno->Visible) { // numcarnet_alumno ?>
        <th data-name="numcarnet_alumno" class="<?= $Page->numcarnet_alumno->headerCellClass() ?>"><div id="elh_alumnosporasigntura_vw_numcarnet_alumno" class="alumnosporasigntura_vw_numcarnet_alumno"><?= $Page->renderFieldHeader($Page->numcarnet_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->id_alumno->Visible) { // id_alumno ?>
        <th data-name="id_alumno" class="<?= $Page->id_alumno->headerCellClass() ?>"><div id="elh_alumnosporasigntura_vw_id_alumno" class="alumnosporasigntura_vw_id_alumno"><?= $Page->renderFieldHeader($Page->id_alumno) ?></div></th>
<?php } ?>
<?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <th data-name="fk_id_asignatura" class="<?= $Page->fk_id_asignatura->headerCellClass() ?>"><div id="elh_alumnosporasigntura_vw_fk_id_asignatura" class="alumnosporasigntura_vw_fk_id_asignatura"><?= $Page->renderFieldHeader($Page->fk_id_asignatura) ?></div></th>
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
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->nombre_alumno->Visible) { // nombre_alumno ?>
        <td data-name="nombre_alumno"<?= $Page->nombre_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnosporasigntura_vw_nombre_alumno" class="el_alumnosporasigntura_vw_nombre_alumno">
<span<?= $Page->nombre_alumno->viewAttributes() ?>>
<?= $Page->nombre_alumno->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->apellidos_alumno->Visible) { // apellidos_alumno ?>
        <td data-name="apellidos_alumno"<?= $Page->apellidos_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnosporasigntura_vw_apellidos_alumno" class="el_alumnosporasigntura_vw_apellidos_alumno">
<span<?= $Page->apellidos_alumno->viewAttributes() ?>>
<?= $Page->apellidos_alumno->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->numcarnet_alumno->Visible) { // numcarnet_alumno ?>
        <td data-name="numcarnet_alumno"<?= $Page->numcarnet_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnosporasigntura_vw_numcarnet_alumno" class="el_alumnosporasigntura_vw_numcarnet_alumno">
<span<?= $Page->numcarnet_alumno->viewAttributes() ?>>
<?= $Page->numcarnet_alumno->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_alumno->Visible) { // id_alumno ?>
        <td data-name="id_alumno"<?= $Page->id_alumno->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnosporasigntura_vw_id_alumno" class="el_alumnosporasigntura_vw_id_alumno">
<span<?= $Page->id_alumno->viewAttributes() ?>>
<?= $Page->id_alumno->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fk_id_asignatura->Visible) { // fk_id_asignatura ?>
        <td data-name="fk_id_asignatura"<?= $Page->fk_id_asignatura->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_alumnosporasigntura_vw_fk_id_asignatura" class="el_alumnosporasigntura_vw_fk_id_asignatura">
<span<?= $Page->fk_id_asignatura->viewAttributes() ?>>
<?= $Page->fk_id_asignatura->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
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
    ew.addEventHandlers("alumnosporasigntura_vw");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
