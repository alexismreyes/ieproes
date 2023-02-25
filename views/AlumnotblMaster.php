<?php

namespace PHPMaker2023\ieproes;

// Table
$alumnotbl = Container("alumnotbl");
?>
<?php if ($alumnotbl->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_alumnotblmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($alumnotbl->nombre_alumno->Visible) { // nombre_alumno ?>
        <tr id="r_nombre_alumno"<?= $alumnotbl->nombre_alumno->rowAttributes() ?>>
            <td class="<?= $alumnotbl->TableLeftColumnClass ?>"><?= $alumnotbl->nombre_alumno->caption() ?></td>
            <td<?= $alumnotbl->nombre_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_nombre_alumno">
<span<?= $alumnotbl->nombre_alumno->viewAttributes() ?>>
<?= $alumnotbl->nombre_alumno->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($alumnotbl->apellidos_alumno->Visible) { // apellidos_alumno ?>
        <tr id="r_apellidos_alumno"<?= $alumnotbl->apellidos_alumno->rowAttributes() ?>>
            <td class="<?= $alumnotbl->TableLeftColumnClass ?>"><?= $alumnotbl->apellidos_alumno->caption() ?></td>
            <td<?= $alumnotbl->apellidos_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_apellidos_alumno">
<span<?= $alumnotbl->apellidos_alumno->viewAttributes() ?>>
<?= $alumnotbl->apellidos_alumno->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($alumnotbl->numcarnet_alumno->Visible) { // numcarnet_alumno ?>
        <tr id="r_numcarnet_alumno"<?= $alumnotbl->numcarnet_alumno->rowAttributes() ?>>
            <td class="<?= $alumnotbl->TableLeftColumnClass ?>"><?= $alumnotbl->numcarnet_alumno->caption() ?></td>
            <td<?= $alumnotbl->numcarnet_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_numcarnet_alumno">
<span<?= $alumnotbl->numcarnet_alumno->viewAttributes() ?>>
<?= $alumnotbl->numcarnet_alumno->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($alumnotbl->genero_alumno->Visible) { // genero_alumno ?>
        <tr id="r_genero_alumno"<?= $alumnotbl->genero_alumno->rowAttributes() ?>>
            <td class="<?= $alumnotbl->TableLeftColumnClass ?>"><?= $alumnotbl->genero_alumno->caption() ?></td>
            <td<?= $alumnotbl->genero_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_genero_alumno">
<span<?= $alumnotbl->genero_alumno->viewAttributes() ?>>
<?= $alumnotbl->genero_alumno->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($alumnotbl->fechanac_alumno->Visible) { // fechanac_alumno ?>
        <tr id="r_fechanac_alumno"<?= $alumnotbl->fechanac_alumno->rowAttributes() ?>>
            <td class="<?= $alumnotbl->TableLeftColumnClass ?>"><?= $alumnotbl->fechanac_alumno->caption() ?></td>
            <td<?= $alumnotbl->fechanac_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_fechanac_alumno">
<span<?= $alumnotbl->fechanac_alumno->viewAttributes() ?>>
<?= $alumnotbl->fechanac_alumno->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($alumnotbl->direccion_alumno->Visible) { // direccion_alumno ?>
        <tr id="r_direccion_alumno"<?= $alumnotbl->direccion_alumno->rowAttributes() ?>>
            <td class="<?= $alumnotbl->TableLeftColumnClass ?>"><?= $alumnotbl->direccion_alumno->caption() ?></td>
            <td<?= $alumnotbl->direccion_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_direccion_alumno">
<span<?= $alumnotbl->direccion_alumno->viewAttributes() ?>>
<?= $alumnotbl->direccion_alumno->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($alumnotbl->telefono_alumno->Visible) { // telefono_alumno ?>
        <tr id="r_telefono_alumno"<?= $alumnotbl->telefono_alumno->rowAttributes() ?>>
            <td class="<?= $alumnotbl->TableLeftColumnClass ?>"><?= $alumnotbl->telefono_alumno->caption() ?></td>
            <td<?= $alumnotbl->telefono_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_telefono_alumno">
<span<?= $alumnotbl->telefono_alumno->viewAttributes() ?>>
<?= $alumnotbl->telefono_alumno->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
