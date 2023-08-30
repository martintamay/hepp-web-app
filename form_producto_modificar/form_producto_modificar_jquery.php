
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
  scEventControl_data["orden_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["codigo_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["descripcion_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["orden_grupo_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["unidad_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["factor_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["unidad_factor_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["imagen1_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["orden_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["orden_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["codigo_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["codigo_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descripcion_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descripcion_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["orden_grupo_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["orden_grupo_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["unidad_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["unidad_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["factor_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["factor_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["unidad_factor_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["unidad_factor_" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_active_all() {
  for (var i = 1; i < iAjaxNewLine; i++) {
    if (scEventControl_active(i)) {
      return true;
    }
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
  $('#id_sc_field_orden_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_orden__onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_producto_modificar_orden__onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_producto_modificar_orden__onfocus(this, iSeqRow) });
  $('#id_sc_field_codigo_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_codigo__onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_producto_modificar_codigo__onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_producto_modificar_codigo__onfocus(this, iSeqRow) });
  $('#id_sc_field_descripcion_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_descripcion__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_producto_modificar_descripcion__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_producto_modificar_descripcion__onfocus(this, iSeqRow) });
  $('#id_sc_field_unidad_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_unidad__onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_producto_modificar_unidad__onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_producto_modificar_unidad__onfocus(this, iSeqRow) });
  $('#id_sc_field_orden_grupo_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_orden_grupo__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_producto_modificar_orden_grupo__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_producto_modificar_orden_grupo__onfocus(this, iSeqRow) });
  $('#id_sc_field_factor_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_factor__onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_producto_modificar_factor__onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_producto_modificar_factor__onfocus(this, iSeqRow) });
  $('#id_sc_field_unidad_factor_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_unidad_factor__onblur(this, iSeqRow) })
                                            .bind('change', function() { sc_form_producto_modificar_unidad_factor__onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_form_producto_modificar_unidad_factor__onfocus(this, iSeqRow) });
  $('#id_sc_field_imagen1_' + iSeqRow).bind('blur', function() { sc_form_producto_modificar_imagen1__onblur(this, iSeqRow) })
                                      .bind('change', function() { sc_form_producto_modificar_imagen1__onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_producto_modificar_imagen1__onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_producto_modificar_orden__onblur(oThis, iSeqRow) {
  do_ajax_form_producto_modificar_validate_orden_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_orden__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_orden__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_producto_modificar_codigo__onblur(oThis, iSeqRow) {
  do_ajax_form_producto_modificar_validate_codigo_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_codigo__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_codigo__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_producto_modificar_descripcion__onblur(oThis, iSeqRow) {
  do_ajax_form_producto_modificar_validate_descripcion_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_descripcion__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_descripcion__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_producto_modificar_unidad__onblur(oThis, iSeqRow) {
  do_ajax_form_producto_modificar_validate_unidad_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_unidad__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_unidad__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_producto_modificar_orden_grupo__onblur(oThis, iSeqRow) {
  do_ajax_form_producto_modificar_validate_orden_grupo_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_orden_grupo__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_orden_grupo__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_producto_modificar_factor__onblur(oThis, iSeqRow) {
  do_ajax_form_producto_modificar_validate_factor_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_factor__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_factor__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_producto_modificar_unidad_factor__onblur(oThis, iSeqRow) {
  do_ajax_form_producto_modificar_validate_unidad_factor_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_unidad_factor__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_unidad_factor__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_producto_modificar_imagen1__onblur(oThis, iSeqRow) {
  scCssBlur(oThis, iSeqRow);
}

function sc_form_producto_modificar_imagen1__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_producto_modificar_imagen1__onfocus(oThis, iSeqRow) {
  scCssFocus(oThis, iSeqRow);
}

var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_vencimiento_" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_vencimiento_" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ['<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>'],
    dayNamesMin: ['<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>'],
    monthNamesShort: ['<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>','<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>'],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['vencimiento_']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true
  });

} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_imagen1_" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_producto_modificar_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'app_dir', value: '<?php echo $this->Ini->path_aplicacao; ?>'},
        {name: 'app_name', value: 'form_producto_modificar'},
        {name: 'upload_dir', value: '<?php echo $this->Ini->root . $this->Ini->path_imag_temp; ?>/'},
        {name: 'upload_url', value: '<?php echo $this->Ini->path_imag_temp; ?>/'},
        {name: 'upload_url', value: '<?php echo $this->Ini->path_imag_temp; ?>/'},
        {name: 'upload_type', value: 'single'},
        {name: 'param_name', value: 'imagen1_' + iSeqRow},
        {name: 'upload_file_height', value: '50'},
        {name: 'upload_file_width', value: '50'},
        {name: 'upload_file_aspect', value: 'N'},
        {name: 'upload_file_type', value: 'I'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_imagen1_" + iSeqRow);
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_imagen1_" + iSeqRow);
        loader.show();
      }
    },
    done: function(e, data) {
      var fileData, thumbDisplay, checkDisplay, var_ajax_img_thumb;
      if (data.result[0].body) {
        fileData = $.parseJSON(data.result[0].body.innerText);
      }
      else {
        fileData = eval(data.result);
      }
      $("#id_sc_field_imagen1_" + iSeqRow).val("");
      $("#id_sc_field_imagen1__ul_name" + iSeqRow).val(fileData[0].sc_random_prot);
      $("#id_sc_field_imagen1__ul_type" + iSeqRow).val(fileData[0].type);
      eval("var_ajax_img_imagen1_" + iSeqRow + " = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_random_prot");
      var_ajax_img_imagen1_ = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_random_prot;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_imagen1_) ? "none" : "";
      $("#id_ajax_img_imagen1_" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_imagen1_" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_imagen1_) {
        document.F1.temp_out_imagen1_.value = var_ajax_img_thumb;
        document.F1.temp_out1_imagen1_.value = var_ajax_img_imagen1_;
      }
      else if (document.F1.temp_out_imagen1_) {
        document.F1.temp_out_imagen1_.value = var_ajax_img_imagen1_;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_imagen1_" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_imagen1_" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
      $("#txt_ajax_img_imagen1_" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_imagen1_" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_imagen1_" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_imagen1_" + iSeqRow).hide();
      }
    }
  });

} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

