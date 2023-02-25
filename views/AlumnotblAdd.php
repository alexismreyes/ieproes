<?php

namespace PHPMaker2023\ieproes;

// Page object
$AlumnotblAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { alumnotbl: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var falumnotbladd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("falumnotbladd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["nombre_alumno", [fields.nombre_alumno.visible && fields.nombre_alumno.required ? ew.Validators.required(fields.nombre_alumno.caption) : null], fields.nombre_alumno.isInvalid],
            ["apellidos_alumno", [fields.apellidos_alumno.visible && fields.apellidos_alumno.required ? ew.Validators.required(fields.apellidos_alumno.caption) : null], fields.apellidos_alumno.isInvalid],
            ["numcarnet_alumno", [fields.numcarnet_alumno.visible && fields.numcarnet_alumno.required ? ew.Validators.required(fields.numcarnet_alumno.caption) : null], fields.numcarnet_alumno.isInvalid],
            ["genero_alumno", [fields.genero_alumno.visible && fields.genero_alumno.required ? ew.Validators.required(fields.genero_alumno.caption) : null], fields.genero_alumno.isInvalid],
            ["fechanac_alumno", [fields.fechanac_alumno.visible && fields.fechanac_alumno.required ? ew.Validators.required(fields.fechanac_alumno.caption) : null, ew.Validators.datetime(fields.fechanac_alumno.clientFormatPattern)], fields.fechanac_alumno.isInvalid],
            ["direccion_alumno", [fields.direccion_alumno.visible && fields.direccion_alumno.required ? ew.Validators.required(fields.direccion_alumno.caption) : null], fields.direccion_alumno.isInvalid],
            ["telefono_alumno", [fields.telefono_alumno.visible && fields.telefono_alumno.required ? ew.Validators.required(fields.telefono_alumno.caption) : null], fields.telefono_alumno.isInvalid]
        ])

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
            "genero_alumno": <?= $Page->genero_alumno->toClientList($Page) ?>,
        })
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="falumnotbladd" id="falumnotbladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="alumnotbl">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nombre_alumno->Visible) { // nombre_alumno ?>
    <div id="r_nombre_alumno"<?= $Page->nombre_alumno->rowAttributes() ?>>
        <label id="elh_alumnotbl_nombre_alumno" for="x_nombre_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombre_alumno->caption() ?><?= $Page->nombre_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nombre_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_nombre_alumno">
<input type="<?= $Page->nombre_alumno->getInputTextType() ?>" name="x_nombre_alumno" id="x_nombre_alumno" data-table="alumnotbl" data-field="x_nombre_alumno" value="<?= $Page->nombre_alumno->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->nombre_alumno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nombre_alumno->formatPattern()) ?>"<?= $Page->nombre_alumno->editAttributes() ?> aria-describedby="x_nombre_alumno_help">
<?= $Page->nombre_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_alumno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->apellidos_alumno->Visible) { // apellidos_alumno ?>
    <div id="r_apellidos_alumno"<?= $Page->apellidos_alumno->rowAttributes() ?>>
        <label id="elh_alumnotbl_apellidos_alumno" for="x_apellidos_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->apellidos_alumno->caption() ?><?= $Page->apellidos_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->apellidos_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_apellidos_alumno">
<input type="<?= $Page->apellidos_alumno->getInputTextType() ?>" name="x_apellidos_alumno" id="x_apellidos_alumno" data-table="alumnotbl" data-field="x_apellidos_alumno" value="<?= $Page->apellidos_alumno->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->apellidos_alumno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->apellidos_alumno->formatPattern()) ?>"<?= $Page->apellidos_alumno->editAttributes() ?> aria-describedby="x_apellidos_alumno_help">
<?= $Page->apellidos_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->apellidos_alumno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->numcarnet_alumno->Visible) { // numcarnet_alumno ?>
    <div id="r_numcarnet_alumno"<?= $Page->numcarnet_alumno->rowAttributes() ?>>
        <label id="elh_alumnotbl_numcarnet_alumno" for="x_numcarnet_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->numcarnet_alumno->caption() ?><?= $Page->numcarnet_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->numcarnet_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_numcarnet_alumno">
<input type="<?= $Page->numcarnet_alumno->getInputTextType() ?>" name="x_numcarnet_alumno" id="x_numcarnet_alumno" data-table="alumnotbl" data-field="x_numcarnet_alumno" value="<?= $Page->numcarnet_alumno->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->numcarnet_alumno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->numcarnet_alumno->formatPattern()) ?>"<?= $Page->numcarnet_alumno->editAttributes() ?> aria-describedby="x_numcarnet_alumno_help">
<?= $Page->numcarnet_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->numcarnet_alumno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->genero_alumno->Visible) { // genero_alumno ?>
    <div id="r_genero_alumno"<?= $Page->genero_alumno->rowAttributes() ?>>
        <label id="elh_alumnotbl_genero_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->genero_alumno->caption() ?><?= $Page->genero_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->genero_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_genero_alumno">
<template id="tp_x_genero_alumno">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="alumnotbl" data-field="x_genero_alumno" name="x_genero_alumno" id="x_genero_alumno"<?= $Page->genero_alumno->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_genero_alumno" class="ew-item-list"></div>
<selection-list hidden
    id="x_genero_alumno"
    name="x_genero_alumno"
    value="<?= HtmlEncode($Page->genero_alumno->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_genero_alumno"
    data-target="dsl_x_genero_alumno"
    data-repeatcolumn="5"
    class="form-control<?= $Page->genero_alumno->isInvalidClass() ?>"
    data-table="alumnotbl"
    data-field="x_genero_alumno"
    data-value-separator="<?= $Page->genero_alumno->displayValueSeparatorAttribute() ?>"
    <?= $Page->genero_alumno->editAttributes() ?>></selection-list>
<?= $Page->genero_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->genero_alumno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fechanac_alumno->Visible) { // fechanac_alumno ?>
    <div id="r_fechanac_alumno"<?= $Page->fechanac_alumno->rowAttributes() ?>>
        <label id="elh_alumnotbl_fechanac_alumno" for="x_fechanac_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fechanac_alumno->caption() ?><?= $Page->fechanac_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fechanac_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_fechanac_alumno">
<input type="<?= $Page->fechanac_alumno->getInputTextType() ?>" name="x_fechanac_alumno" id="x_fechanac_alumno" data-table="alumnotbl" data-field="x_fechanac_alumno" value="<?= $Page->fechanac_alumno->EditValue ?>" placeholder="<?= HtmlEncode($Page->fechanac_alumno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->fechanac_alumno->formatPattern()) ?>"<?= $Page->fechanac_alumno->editAttributes() ?> aria-describedby="x_fechanac_alumno_help">
<?= $Page->fechanac_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fechanac_alumno->getErrorMessage() ?></div>
<?php if (!$Page->fechanac_alumno->ReadOnly && !$Page->fechanac_alumno->Disabled && !isset($Page->fechanac_alumno->EditAttrs["readonly"]) && !isset($Page->fechanac_alumno->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["falumnotbladd", "datetimepicker"], function () {
    let format = "<?= DateFormat(14) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("falumnotbladd", "x_fechanac_alumno", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->direccion_alumno->Visible) { // direccion_alumno ?>
    <div id="r_direccion_alumno"<?= $Page->direccion_alumno->rowAttributes() ?>>
        <label id="elh_alumnotbl_direccion_alumno" for="x_direccion_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->direccion_alumno->caption() ?><?= $Page->direccion_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->direccion_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_direccion_alumno">
<input type="<?= $Page->direccion_alumno->getInputTextType() ?>" name="x_direccion_alumno" id="x_direccion_alumno" data-table="alumnotbl" data-field="x_direccion_alumno" value="<?= $Page->direccion_alumno->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->direccion_alumno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->direccion_alumno->formatPattern()) ?>"<?= $Page->direccion_alumno->editAttributes() ?> aria-describedby="x_direccion_alumno_help">
<?= $Page->direccion_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->direccion_alumno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->telefono_alumno->Visible) { // telefono_alumno ?>
    <div id="r_telefono_alumno"<?= $Page->telefono_alumno->rowAttributes() ?>>
        <label id="elh_alumnotbl_telefono_alumno" for="x_telefono_alumno" class="<?= $Page->LeftColumnClass ?>"><?= $Page->telefono_alumno->caption() ?><?= $Page->telefono_alumno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->telefono_alumno->cellAttributes() ?>>
<span id="el_alumnotbl_telefono_alumno">
<input type="<?= $Page->telefono_alumno->getInputTextType() ?>" name="x_telefono_alumno" id="x_telefono_alumno" data-table="alumnotbl" data-field="x_telefono_alumno" value="<?= $Page->telefono_alumno->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->telefono_alumno->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->telefono_alumno->formatPattern()) ?>"<?= $Page->telefono_alumno->editAttributes() ?> aria-describedby="x_telefono_alumno_help">
<?= $Page->telefono_alumno->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->telefono_alumno->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("alumnos_asignatura_tbl", explode(",", $Page->getCurrentDetailTable())) && $alumnos_asignatura_tbl->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("alumnos_asignatura_tbl", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AlumnosAsignaturaTblGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="falumnotbladd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="falumnotbladd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("alumnotbl");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
