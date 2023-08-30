
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
  scEventControl_data["idpag" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["titulo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["contenido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["img" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["idpag" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["idpag" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["titulo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["titulo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["contenido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["contenido" + iSeqRow]["change"]) {
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
  $('#id_sc_field_idpag' + iSeqRow).bind('blur', function() { sc_form_pag_idpag_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_pag_idpag_onfocus(this, iSeqRow) });
  $('#id_sc_field_titulo' + iSeqRow).bind('blur', function() { sc_form_pag_titulo_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_pag_titulo_onfocus(this, iSeqRow) });
  $('#id_sc_field_contenido' + iSeqRow).bind('blur', function() { sc_form_pag_contenido_onblur(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_pag_contenido_onfocus(this, iSeqRow) });
  $('#id_sc_field_img' + iSeqRow).bind('blur', function() { sc_form_pag_img_onblur(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_pag_img_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_pag_idpag_onblur(oThis, iSeqRow) {
  do_ajax_form_pag_mob_validate_idpag();
  scCssBlur(oThis);
}

function sc_form_pag_idpag_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pag_titulo_onblur(oThis, iSeqRow) {
  do_ajax_form_pag_mob_validate_titulo();
  scCssBlur(oThis);
}

function sc_form_pag_titulo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pag_contenido_onblur(oThis, iSeqRow) {
  do_ajax_form_pag_mob_validate_contenido();
  scCssBlur(oThis);
}

function sc_form_pag_contenido_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_pag_img_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_pag_img_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_img" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_pag_mob_ul_save.php",
    dropZone: $("#hidden_field_data_img" + iSeqRow),
    formData: function() {
      return [
        {name: 'app_dir', value: '<?php echo $this->Ini->path_aplicacao; ?>'},
        {name: 'app_name', value: 'form_pag_mob'},
        {name: 'upload_dir', value: '<?php echo $this->Ini->root . $this->Ini->path_imag_temp; ?>/'},
        {name: 'upload_url', value: '<?php echo $this->Ini->path_imag_temp; ?>/'},
        {name: 'upload_url', value: '<?php echo $this->Ini->path_imag_temp; ?>/'},
        {name: 'upload_type', value: 'single'},
        {name: 'param_name', value: 'img' + iSeqRow},
        {name: 'upload_file_height', value: '300'},
        {name: 'upload_file_width', value: '300'},
        {name: 'upload_file_aspect', value: 'S'},
        {name: 'upload_file_type', value: 'I'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_img" + iSeqRow);
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_img" + iSeqRow);
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
      $("#id_sc_field_img" + iSeqRow).val("");
      $("#id_sc_field_img_ul_name" + iSeqRow).val(fileData[0].sc_random_prot);
      $("#id_sc_field_img_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_img = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_random_prot;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_img) ? "none" : "";
      $("#id_ajax_img_img" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_img" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_img) {
        document.F1.temp_out_img.value = var_ajax_img_thumb;
        document.F1.temp_out1_img.value = var_ajax_img_img;
      }
      else if (document.F1.temp_out_img) {
        document.F1.temp_out_img.value = var_ajax_img_img;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_img" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_img" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
      $("#txt_ajax_img_img" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_img" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_img" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_img" + iSeqRow).hide();
      }
    }
  });

} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

var scBtnGrpStatus = {};
function scBtnGrpShow(sGroup) {
  var btnPos = $('#sc_btgp_btn_' + sGroup).offset();
  scBtnGrpStatus[sGroup] = 'open';
  $('#sc_btgp_btn_' + sGroup).mouseout(function() {
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  });
  $('#sc_btgp_div_' + sGroup + ' span a').click(function() {
    scBtnGrpStatus[sGroup] = 'out';
    scBtnGrpHide(sGroup);
  });
  $('#sc_btgp_div_' + sGroup).css({
    'left': btnPos.left
  })
  .mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  })
  .mouseleave(function() {
    scBtnGrpStatus[sGroup] = 'out';
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  })
  .show('fast');
}
function scBtnGrpHide(sGroup) {
  if ('over' != scBtnGrpStatus[sGroup]) {
    $('#sc_btgp_div_' + sGroup).hide('fast');
  }
}
