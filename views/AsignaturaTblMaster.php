<?php

namespace PHPMaker2023\ieproes;

// Table
$asignatura_tbl = Container("asignatura_tbl");
?>
<?php if ($asignatura_tbl->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_asignatura_tblmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($asignatura_tbl->nombre_asignatura->Visible) { // nombre_asignatura ?>
        <tr id="r_nombre_asignatura"<?= $asignatura_tbl->nombre_asignatura->rowAttributes() ?>>
            <td class="<?= $asignatura_tbl->TableLeftColumnClass ?>"><?= $asignatura_tbl->nombre_asignatura->caption() ?></td>
            <td<?= $asignatura_tbl->nombre_asignatura->cellAttributes() ?>>
<span id="el_asignatura_tbl_nombre_asignatura">
<span<?= $asignatura_tbl->nombre_asignatura->viewAttributes() ?>>
<?= $asignatura_tbl->nombre_asignatura->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($asignatura_tbl->id_profesor->Visible) { // id_profesor ?>
        <tr id="r_id_profesor"<?= $asignatura_tbl->id_profesor->rowAttributes() ?>>
            <td class="<?= $asignatura_tbl->TableLeftColumnClass ?>"><?= $asignatura_tbl->id_profesor->caption() ?></td>
            <td<?= $asignatura_tbl->id_profesor->cellAttributes() ?>>
<span id="el_asignatura_tbl_id_profesor">
<span<?= $asignatura_tbl->id_profesor->viewAttributes() ?>>
<?= $asignatura_tbl->id_profesor->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
