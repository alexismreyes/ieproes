<?php

namespace PHPMaker2023\ieproes;

// Page object
$ProfesorTblView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fprofesor_tblview" id="fprofesor_tblview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { profesor_tbl: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fprofesor_tblview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprofesor_tblview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="profesor_tbl">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id_profesor->Visible) { // id_profesor ?>
    <tr id="r_id_profesor"<?= $Page->id_profesor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_profesor_tbl_id_profesor"><?= $Page->id_profesor->caption() ?></span></td>
        <td data-name="id_profesor"<?= $Page->id_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_id_profesor">
<span<?= $Page->id_profesor->viewAttributes() ?>>
<?= $Page->id_profesor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nombre_profesor->Visible) { // nombre_profesor ?>
    <tr id="r_nombre_profesor"<?= $Page->nombre_profesor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_profesor_tbl_nombre_profesor"><?= $Page->nombre_profesor->caption() ?></span></td>
        <td data-name="nombre_profesor"<?= $Page->nombre_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_nombre_profesor">
<span<?= $Page->nombre_profesor->viewAttributes() ?>>
<?= $Page->nombre_profesor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dui_profesor->Visible) { // dui_profesor ?>
    <tr id="r_dui_profesor"<?= $Page->dui_profesor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_profesor_tbl_dui_profesor"><?= $Page->dui_profesor->caption() ?></span></td>
        <td data-name="dui_profesor"<?= $Page->dui_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_dui_profesor">
<span<?= $Page->dui_profesor->viewAttributes() ?>>
<?= $Page->dui_profesor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->direccion_profesor->Visible) { // direccion_profesor ?>
    <tr id="r_direccion_profesor"<?= $Page->direccion_profesor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_profesor_tbl_direccion_profesor"><?= $Page->direccion_profesor->caption() ?></span></td>
        <td data-name="direccion_profesor"<?= $Page->direccion_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_direccion_profesor">
<span<?= $Page->direccion_profesor->viewAttributes() ?>>
<?= $Page->direccion_profesor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->telefono_profesor->Visible) { // telefono_profesor ?>
    <tr id="r_telefono_profesor"<?= $Page->telefono_profesor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_profesor_tbl_telefono_profesor"><?= $Page->telefono_profesor->caption() ?></span></td>
        <td data-name="telefono_profesor"<?= $Page->telefono_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_telefono_profesor">
<span<?= $Page->telefono_profesor->viewAttributes() ?>>
<?= $Page->telefono_profesor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->email_profesor->Visible) { // email_profesor ?>
    <tr id="r_email_profesor"<?= $Page->email_profesor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_profesor_tbl_email_profesor"><?= $Page->email_profesor->caption() ?></span></td>
        <td data-name="email_profesor"<?= $Page->email_profesor->cellAttributes() ?>>
<span id="el_profesor_tbl_email_profesor">
<span<?= $Page->email_profesor->viewAttributes() ?>>
<?= $Page->email_profesor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
