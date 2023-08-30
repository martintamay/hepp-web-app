
function scJQGeneralAdd() {
  $('input:text.sc-js-input').listen();
  $('input:password.sc-js-input').listen();
  $('input:checkbox.sc-js-input').listen();
  $('select.sc-js-input').listen();
  $('textarea.sc-js-input').listen();

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if (false == scSetFocusOnField($oField) && 0 < $("#id_ac_" + sField).length) {
    scSetFocusOnField($("#id_ac_" + sField));
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if (0 < $oField.length && 0 < $oField[0].offsetHeight && 0 < $oField[0].offsetWidth && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["idpedido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["cliente_cuenta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["cantidad" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["fraccionado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["subtotal" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["ordenproducto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["idpedido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["idpedido" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliente_cuenta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliente_cuenta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cantidad" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cantidad" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fraccionado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fraccionado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["subtotal" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["subtotal" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ordenproducto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ordenproducto" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_idpedido' + iSeqRow).bind('blur', function() { sc_form_pedido_idpedido_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_pedido_idpedido_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliente_cuenta' + iSeqRow).bind('blur', function() { sc_form_pedido_cliente_cuenta_onblur(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_pedido_cliente_cuenta_onfocus(this, iSeqRow) });
  $('#id_sc_field_cantidad' + iSeqRow).bind('blur', function() { sc_form_pedido_cantidad_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_pedido_cantidad_onfocus(this, iSeqRow) });
  $('#id_sc_field_fraccionado' + iSeqRow).bind('blur', function() { sc_form_pedido_fraccionado_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_pedido_fraccionado_onfocus(this, iSeqRow) });
  $('#id_sc_field_subtotal' + iSeqRow).bind('blur', function() { sc_form_pedido_subtotal_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_pedido_subtotal_onfocus(this, iSeqRow) });
  $('#id_sc_field_ordenproducto' + iSeqRow).bind('blur', function() { sc_form_pedido_ordenproducto_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_pedido_ordenproducto_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_pedido_idpedido_onblur(oThis, iSeqRow) {
  do_ajax_form_pedido_validate_idpedido();
  scCssBlur(oThis);
}

function sc_form_pedido_idpedido_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pedido_cliente_cuenta_onblur(oThis, iSeqRow) {
  do_ajax_form_pedido_validate_cliente_cuenta();
  scCssBlur(oThis);
}

function sc_form_pedido_cliente_cuenta_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pedido_cantidad_onblur(oThis, iSeqRow) {
  do_ajax_form_pedido_validate_cantidad();
  scCssBlur(oThis);
}

function sc_form_pedido_cantidad_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pedido_fraccionado_onblur(oThis, iSeqRow) {
  do_ajax_form_pedido_validate_fraccionado();
  scCssBlur(oThis);
}

function sc_form_pedido_fraccionado_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pedido_subtotal_onblur(oThis, iSeqRow) {
  do_ajax_form_pedido_validate_subtotal();
  scCssBlur(oThis);
}

function sc_form_pedido_subtotal_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pedido_ordenproducto_onblur(oThis, iSeqRow) {
  do_ajax_form_pedido_validate_ordenproducto();
  scCssBlur(oThis);
}

function sc_form_pedido_ordenproducto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

