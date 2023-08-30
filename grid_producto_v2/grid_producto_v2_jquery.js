function grid_producto_v2_cantidad_getValue(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  return $("#id_sc_field_cantidad" + seqRow).find("img").attr("src");
}

function grid_producto_v2_cantidad_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_cantidad" + seqRow).find("img").attr("src", newValue);
}

function grid_producto_v2_orden_getValue(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  return $("#id_sc_field_Hidden_orden" + seqRow).html();
}

function grid_producto_v2_orden_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_orden" + seqRow).html(newValue);
}
function grid_producto_v2_orden_Hidden_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_Hidden_orden" + seqRow).html(newValue);
}

function grid_producto_v2_descripcion_getValue(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  return $("#id_sc_field_descripcion" + seqRow).html();
}

function grid_producto_v2_descripcion_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_descripcion" + seqRow).html(newValue);
}

function grid_producto_v2_cant_getValue(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  return $("#id_sc_field_cant" + seqRow).html();
}

function grid_producto_v2_cant_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_cant" + seqRow).html(newValue);
}

function grid_producto_v2_precio1_getValue(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  return $("#id_sc_field_Hidden_precio1" + seqRow).html();
}

function grid_producto_v2_precio1_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_precio1" + seqRow).html(newValue);
}
function grid_producto_v2_precio1_Hidden_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_Hidden_precio1" + seqRow).html(newValue);
}

function grid_producto_v2_subtotal_getValue(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  return $("#id_sc_field_subtotal" + seqRow).html();
}

function grid_producto_v2_subtotal_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_subtotal" + seqRow).html(newValue);
}

function grid_producto_v2_orden_grupo_getValue(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  return $("#id_sc_field_orden_grupo" + seqRow).html();
}

function grid_producto_v2_orden_grupo_setValue(newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_orden_grupo" + seqRow).html(newValue);
}

function grid_producto_v2_getValue(field, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  if ("cantidad" == field) {
    return grid_producto_v2_cantidad_getValue(seqRow);
  }
  if ("orden" == field) {
    return grid_producto_v2_orden_getValue(seqRow);
  }
  if ("descripcion" == field) {
    return grid_producto_v2_descripcion_getValue(seqRow);
  }
  if ("cant" == field) {
    return grid_producto_v2_cant_getValue(seqRow);
  }
  if ("precio1" == field) {
    return grid_producto_v2_precio1_getValue(seqRow);
  }
  if ("subtotal" == field) {
    return grid_producto_v2_subtotal_getValue(seqRow);
  }
  if ("orden_grupo" == field) {
    return grid_producto_v2_orden_grupo_getValue(seqRow);
  }
}

function grid_producto_v2_setValue(field, newValue, seqRow) {
  seqRow = scSeqNormalize(seqRow);
  if ("cantidad" == field) {
    grid_producto_v2_cantidad_setValue(newValue, seqRow);
  }
  if ("orden" == field) {
    grid_producto_v2_orden_setValue(newValue, seqRow);
  }
  if ("descripcion" == field) {
    grid_producto_v2_descripcion_setValue(newValue, seqRow);
  }
  if ("cant" == field) {
    grid_producto_v2_cant_setValue(newValue, seqRow);
  }
  if ("precio1" == field) {
    grid_producto_v2_precio1_setValue(newValue, seqRow);
  }
  if ("subtotal" == field) {
    grid_producto_v2_subtotal_setValue(newValue, seqRow);
  }
  if ("orden_grupo" == field) {
    grid_producto_v2_orden_grupo_setValue(newValue, seqRow);
  }
  if ("orden_Hidden" == field) {
    grid_producto_v2_orden_Hidden_setValue(newValue, seqRow);
  }
  if ("precio1_Hidden" == field) {
    grid_producto_v2_precio1_Hidden_setValue(newValue, seqRow);
  }
}

function scJQAddEvents(seqRow) {
  seqRow = scSeqNormalize(seqRow);
  $("#id_sc_field_cantidad" + seqRow).click(function () {
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_event&nmgp_event=cantidad_onClick&script_case_init=" + document.F3.script_case_init.value + "&script_case_session=" + document.F3.script_case_session.value + "&cantidad=" + grid_producto_v2_getValue("cantidad", seqRow) + "&descripcion=" + grid_producto_v2_getValue("descripcion", seqRow) + "&precio1=" + grid_producto_v2_getValue("precio1", seqRow) + "&orden=" + grid_producto_v2_getValue("orden", seqRow) + "",
      success: function(jsonReturn) {
        var i, fieldDisplay, oResp;
        eval("oResp = " + jsonReturn);
        if (oResp["setValue"]) {
          for (i = 0; i < oResp["setValue"].length; i++) {
            grid_producto_v2_setValue(oResp["setValue"][i]["field"], oResp["setValue"][i]["value"], seqRow);
          }
        }
        if (oResp["fieldDisplay"]) {
          for (i = 0; i < oResp["fieldDisplay"].length; i++) {
            if ("off" == oResp["fieldDisplay"][i]["status"]) {
              $("#id_sc_field_" + oResp["fieldDisplay"][i]["field"] + seqRow).hide();
            }
            else {
              $("#id_sc_field_" + oResp["fieldDisplay"][i]["field"] + seqRow).show();
            }
          }
        }
        if (oResp["Refresh"]) {
           nm_gp_move('igual');
        }
        if (oResp["redirInfo"]) {
           nmAjaxRedir(oResp);
        }
        if (oResp["htmOutput"]) {
           nmAjaxShowDebug(oResp);
        }
      }
    });
  }).mouseover(function() { $(this).css("cursor", "pointer"); })
    .mouseout(function() { $(this).css("cursor", "pointer"); })
    .addClass(($("#id_sc_field_cantidad" + seqRow).parent().hasClass("scGridFieldOddFont") ? "scGridFieldOddLink" : "scGridFieldEvenLink"));

}

function scSeqNormalize(seqRow) {
  var newSeqRow = seqRow.toString();
  if ("" == newSeqRow) {
    return "";
  }
  if ("_" != newSeqRow.substr(0, 1)) {
    return "_" + newSeqRow;
  }
  return newSeqRow;
}
  function nmAjaxRedir(oTemp)
  {
    if (oTemp && oTemp != null) {
        oResp = oTemp;
    }
    if (!oResp["redirInfo"]) {
      return;
    }
    sMetodo = oResp["redirInfo"]["metodo"];
    sAction = oResp["redirInfo"]["action"];
    if ("location" == sMetodo) {
      if ("parent.parent" == oResp["redirInfo"]["target"]) {
        parent.parent.location = sAction;
      }
      else if ("parent" == oResp["redirInfo"]["target"]) {
        parent.location = sAction;
      }
      else if ("_blank" == oResp["redirInfo"]["target"]) {
        window.open(sAction, "_blank");
      }
      else {
        document.location = sAction;
      }
    }
    else if ("html" == sMetodo) {
        document.write(nmAjaxSpecCharParser(oResp["redirInfo"]["action"]));
    }
    else {
      if (oResp["redirInfo"]["target"] == "modal") {
          tb_show('', sAction + '?script_case_init=' +  oResp["redirInfo"]["script_case_init"] + '&script_case_session=<?php echo session_id() ?>&nmgp_parms=' + oResp["redirInfo"]["nmgp_parms"] + '&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&TB_iframe=true&modal=true&height=' +  oResp["redirInfo"]["h_modal"] + '&width=' + oResp["redirInfo"]["w_modal"], '');
          return;
      }
      sFormRedir = (oResp["redirInfo"]["nmgp_outra_jan"]) ? "form_ajax_redir_1" : "form_ajax_redir_2";
      document.forms[sFormRedir].action           = sAction;
      document.forms[sFormRedir].target           = oResp["redirInfo"]["target"];
      document.forms[sFormRedir].nmgp_parms.value = oResp["redirInfo"]["nmgp_parms"];
      if ("form_ajax_redir_1" == sFormRedir) {
        document.forms[sFormRedir].nmgp_outra_jan.value = oResp["redirInfo"]["nmgp_outra_jan"];
      }
      else {
        document.forms[sFormRedir].nmgp_url_saida.value   = oResp["redirInfo"]["nmgp_url_saida"];
        document.forms[sFormRedir].script_case_init.value = oResp["redirInfo"]["script_case_init"];
      }
      document.forms[sFormRedir].submit();
    }
  }
function ajax_navigate(opc, parm)
{
    nmAjaxProcOn();
    $.ajax({
      type: "POST",
      url: "index.php",
      data: "nmgp_opcao=ajax_navigate&script_case_init=" + document.F4.script_case_init.value + "&script_case_session=" + document.F4.script_case_session.value + "&opc=" + opc  + "&parm=" + parm,
      success: function(jsonNavigate) {
        var i, oResp;
        Tst_integrid = jsonNavigate.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            nmAjaxProcOff();
            alert (jsonNavigate);
            return;
        }
        eval("oResp = " + jsonNavigate);
        if (oResp["redirInfo"]) {
           nmAjaxRedir(oResp);
        }
        if (oResp["setValue"]) {
          for (i = 0; i < oResp["setValue"].length; i++) {
            $("#" + oResp["setValue"][i]["field"]).html(oResp["setValue"][i]["value"]);
          }
        }
        if (oResp["setArr"]) {
          for (i = 0; i < oResp["setArr"].length; i++) {
               eval (oResp["setArr"][i]["var"] + ' = new Array()');
          }
        }
        if (oResp["setVar"]) {
          for (i = 0; i < oResp["setVar"].length; i++) {
               eval (oResp["setVar"][i]["var"] + ' = \"' + oResp["setVar"][i]["value"] + '\"');
          }
        }
        if (oResp["setArr"]) {
          for (i = 0; i < oResp["setArr"].length; i++) {
               eval (oResp["setArr"][i]["var"] + ' = {' + oResp["setArr"][i]["value"] + '}');
          }
        }
        if (oResp["setDisplay"]) {
          for (i = 0; i < oResp["setDisplay"].length; i++) {
               document.getElementById(oResp["setDisplay"][i]["field"]).style.display = oResp["setDisplay"][i]["value"];
          }
        }
        if (oResp["setDisabled"]) {
          for (i = 0; i < oResp["setDisabled"].length; i++) {
               document.getElementById(oResp["setDisabled"][i]["field"]).disabled = oResp["setDisabled"][i]["value"];
          }
        }
        if (oResp["setClass"]) {
          for (i = 0; i < oResp["setClass"].length; i++) {
               document.getElementById(oResp["setClass"][i]["field"]).className = oResp["setClass"][i]["value"];
          }
        }
        if (oResp["setSrc"]) {
          for (i = 0; i < oResp["setSrc"].length; i++) {
               document.getElementById(oResp["setSrc"][i]["field"]).src = oResp["setSrc"][i]["value"];
          }
        }
        if (oResp["redirInfo"]) {
           nmAjaxRedir(oResp);
        }
        if (oResp["AlertJS"]) {
          for (i = 0; i < oResp["AlertJS"].length; i++) {
              alert (oResp["AlertJS"][i]);
          }
        }
        if (oResp["htmOutput"]) {
           nmAjaxShowDebug(oResp);
        }
        if (!SC_Link_View)
        {
            SC_init_jquery();
            tb_init('a.thickbox, area.thickbox, input.thickbox');
        }
        nmAjaxProcOff();
      }
    });
}
