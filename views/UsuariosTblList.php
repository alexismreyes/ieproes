<?php

namespace PHPMaker2023\ieproes;

// Page object
$UsuariosTblList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { usuarios_tbl: currentTable } });
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
<form name="fusuarios_tblsrch" id="fusuarios_tblsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fusuarios_tblsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { usuarios_tbl: currentTable } });
var currentForm;
var fusuarios_tblsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fusuarios_tblsrch")
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fusuarios_tblsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fusuarios_tblsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fusuarios_tblsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fusuarios_tblsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="usuarios_tbl">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_usuarios_tbl" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_usuarios_tbllist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
        <th data-name="id_usuario" class="<?= $Page->id_usuario->headerCellClass() ?>"><div id="elh_usuarios_tbl_id_usuario" class="usuarios_tbl_id_usuario"><?= $Page->renderFieldHeader($Page->id_usuario) ?></div></th>
<?php } ?>
<?php if ($Page->tipo_usuario->Visible) { // tipo_usuario ?>
        <th data-name="tipo_usuario" class="<?= $Page->tipo_usuario->headerCellClass() ?>"><div id="elh_usuarios_tbl_tipo_usuario" class="usuarios_tbl_tipo_usuario"><?= $Page->renderFieldHeader($Page->tipo_usuario) ?></div></th>
<?php } ?>
<?php if ($Page->nombre_usuario->Visible) { // nombre_usuario ?>
        <th data-name="nombre_usuario" class="<?= $Page->nombre_usuario->headerCellClass() ?>"><div id="elh_usuarios_tbl_nombre_usuario" class="usuarios_tbl_nombre_usuario"><?= $Page->renderFieldHeader($Page->nombre_usuario) ?></div></th>
<?php } ?>
<?php if ($Page->login_usuario->Visible) { // login_usuario ?>
        <th data-name="login_usuario" class="<?= $Page->login_usuario->headerCellClass() ?>"><div id="elh_usuarios_tbl_login_usuario" class="usuarios_tbl_login_usuario"><?= $Page->renderFieldHeader($Page->login_usuario) ?></div></th>
<?php } ?>
<?php if ($Page->password_usuario->Visible) { // password_usuario ?>
        <th data-name="password_usuario" class="<?= $Page->password_usuario->headerCellClass() ?>"><div id="elh_usuarios_tbl_password_usuario" class="usuarios_tbl_password_usuario"><?= $Page->renderFieldHeader($Page->password_usuario) ?></div></th>
<?php } ?>
<?php if ($Page->email_usuario->Visible) { // email_usuario ?>
        <th data-name="email_usuario" class="<?= $Page->email_usuario->headerCellClass() ?>"><div id="elh_usuarios_tbl_email_usuario" class="usuarios_tbl_email_usuario"><?= $Page->renderFieldHeader($Page->email_usuario) ?></div></th>
<?php } ?>
<?php if ($Page->parent_id_usuario->Visible) { // parent_id_usuario ?>
        <th data-name="parent_id_usuario" class="<?= $Page->parent_id_usuario->headerCellClass() ?>"><div id="elh_usuarios_tbl_parent_id_usuario" class="usuarios_tbl_parent_id_usuario"><?= $Page->renderFieldHeader($Page->parent_id_usuario) ?></div></th>
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
    <?php if ($Page->id_usuario->Visible) { // id_usuario ?>
        <td data-name="id_usuario"<?= $Page->id_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_id_usuario" class="el_usuarios_tbl_id_usuario">
<span<?= $Page->id_usuario->viewAttributes() ?>>
<?= $Page->id_usuario->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tipo_usuario->Visible) { // tipo_usuario ?>
        <td data-name="tipo_usuario"<?= $Page->tipo_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_tipo_usuario" class="el_usuarios_tbl_tipo_usuario">
<span<?= $Page->tipo_usuario->viewAttributes() ?>>
<?= $Page->tipo_usuario->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nombre_usuario->Visible) { // nombre_usuario ?>
        <td data-name="nombre_usuario"<?= $Page->nombre_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_nombre_usuario" class="el_usuarios_tbl_nombre_usuario">
<span<?= $Page->nombre_usuario->viewAttributes() ?>>
<?= $Page->nombre_usuario->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->login_usuario->Visible) { // login_usuario ?>
        <td data-name="login_usuario"<?= $Page->login_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_login_usuario" class="el_usuarios_tbl_login_usuario">
<span<?= $Page->login_usuario->viewAttributes() ?>>
<?= $Page->login_usuario->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->password_usuario->Visible) { // password_usuario ?>
        <td data-name="password_usuario"<?= $Page->password_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_password_usuario" class="el_usuarios_tbl_password_usuario">
<span<?= $Page->password_usuario->viewAttributes() ?>>
<?= $Page->password_usuario->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->email_usuario->Visible) { // email_usuario ?>
        <td data-name="email_usuario"<?= $Page->email_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_email_usuario" class="el_usuarios_tbl_email_usuario">
<span<?= $Page->email_usuario->viewAttributes() ?>>
<?= $Page->email_usuario->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->parent_id_usuario->Visible) { // parent_id_usuario ?>
        <td data-name="parent_id_usuario"<?= $Page->parent_id_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_tbl_parent_id_usuario" class="el_usuarios_tbl_parent_id_usuario">
<span<?= $Page->parent_id_usuario->viewAttributes() ?>>
<?= $Page->parent_id_usuario->getViewValue() ?></span>
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
    ew.addEventHandlers("usuarios_tbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
