<?php
class form_producto_modificar_form extends form_producto_modificar_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - producto"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - producto"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
header("X-XSS-Protection: 0");
?>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
 </SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <style type="text/css">
  #quicksearchph_t {
   position: relative;
  }
  #quicksearchph_t img {
   position: absolute;
   top: 0;
   right: 0;
  }
 </style>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_producto_modificar_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_binicio_off = "<?php echo $this->arr_buttons['binicio_off']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bavanca_off = "<?php echo $this->arr_buttons['bavanca_off']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bretorna_off = "<?php echo $this->arr_buttons['bretorna_off']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_bfinal_off  = "<?php echo $this->arr_buttons['bfinal_off']['type']; ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
?>
 if ('S' == str_ret)
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).show();
       $("#sc_b_ini_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ini_" + str_pos).show();
       $("#gbl_sc_b_ini_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).show();
       $("#sc_b_ret_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ret_" + str_pos).show();
       $("#gbl_sc_b_ret_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).hide();
       $("#sc_b_ini_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ini_" + str_pos).hide();
       $("#gbl_sc_b_ini_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).hide();
       $("#sc_b_ret_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ret_" + str_pos).hide();
       $("#gbl_sc_b_ret_off_" + str_pos).show();
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).show();
       $("#sc_b_fim_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_fim_" + str_pos).show();
       $("#gbl_sc_b_fim_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).show();
       $("#sc_b_avc_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_avc_" + str_pos).show();
       $("#gbl_sc_b_avc_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).hide();
       $("#sc_b_fim_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_fim_" + str_pos).hide();
       $("#gbl_sc_b_fim_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).hide();
       $("#sc_b_avc_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_avc_" + str_pos).hide();
       $("#gbl_sc_b_avc_off_" + str_pos).show();
<?php
    }
?>
 }
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_producto_modificar_jquery.php');

?>

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {


  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).load(function() {
     scQuickSearchInit(false, '');
     $('#SC_fast_search_t').listen();
     scQuickSearchKeyUp('t', null);
     scQSInit = false;
   });
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchInit(bPosOnly, sPos) {
     if (!bPosOnly) {
       if ('' == sPos || 't' == sPos) scQuickSearchSize('SC_fast_search_t', 'SC_fast_search_close_t', 'SC_fast_search_submit_t', 'quicksearchph_t');
     }
   }
   function scQuickSearchSize(sIdInput, sIdClose, sIdSubmit, sPlaceHolder) {
     var oInput = $('#' + sIdInput),
         oClose = $('#' + sIdClose),
         oSubmit = $('#' + sIdSubmit),
         oPlace = $('#' + sPlaceHolder),
         iInputP = parseInt(oInput.css('padding-right')) || 0,
         iInputB = parseInt(oInput.css('border-right-width')) || 0,
         iInputW = oInput.outerWidth(),
         iPlaceW = oPlace.outerWidth(),
         oInputO = oInput.offset(),
         oPlaceO = oPlace.offset(),
         iNewRight;
     iNewRight = (iPlaceW - iInputW) - (oInputO.left - oPlaceO.left) + iInputB + 1;
     oInput.css({
       'height': Math.max(oInput.height(), 16) + 'px',
       'padding-right': iInputP + 16 + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px'
     });
     oClose.css({
       'right': iNewRight + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px',
       'cursor': 'pointer'
     });
     oSubmit.css({
       'right': iNewRight + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px',
       'cursor': 'pointer'
     });
   }
   function scQuickSearchKeyUp(sPos, e) {
     if ('' != scQSInitVal && $('#SC_fast_search_' + sPos).val() == scQSInitVal && scQSInit) {
       $('#SC_fast_search_close_' + sPos).show();
       $('#SC_fast_search_submit_' + sPos).hide();
     }
     else {
       $('#SC_fast_search_close_' + sPos).hide();
       $('#SC_fast_search_submit_' + sPos).show();
     }
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
     }
   }
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_producto_modificar_js0.php");
?>
<script type="text/javascript" src="<?php echo str_replace("{str_idioma}", $this->Ini->str_lang, "../_lib/js/tab_erro_{str_idioma}.js"); ?>"> 
</script> 
<script type="text/javascript"> 
nmdg_enter_tab = true;
  sc_quant_excl = <?php echo count($sc_check_excl); ?>; 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
 </script>
<form name="F1" method="post" enctype="multipart/form-data" 
               action="./" 
               target="_self"> 
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo NM_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="script_case_session" value="<?php  echo NM_encode_input(session_id()); ?>"> 
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>"> 
<input type="hidden" name="upload_file_flag" value="">
<input type="hidden" name="upload_file_check" value="">
<input type="hidden" name="upload_file_name" value="">
<input type="hidden" name="upload_file_temp" value="">
<input type="hidden" name="upload_file_libs" value="">
<input type="hidden" name="upload_file_height" value="">
<input type="hidden" name="upload_file_width" value="">
<input type="hidden" name="upload_file_aspect" value="">
<input type="hidden" name="upload_file_type" value="">
<input type="hidden" name="upload_file_row" value="">
<?php
$_SESSION['scriptcase']['error_span_title']['form_producto_modificar'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_producto_modificar'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<script type="text/javascript">
var scMsgDefTitle = "<?php echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl']; ?>";
var scMsgDefButton = "Ok";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->page; ?>";
</script>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
 <tr>
  <td>
  <div class="scFormBorder">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
  if (!$this->Embutida_call && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['mostra_cab']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['mostra_cab'] != "N"))
  {
?>
<tr><td>
<style>
#lin1_col1 { padding-left:9px; padding-top:7px;  height:27px; overflow:hidden; text-align:left;}			 
#lin1_col2 { padding-right:9px; padding-top:7px; height:27px; text-align:right; overflow:hidden;   font-size:12px; font-weight:normal;}
</style>

<div style="width: 100%">
 <div class="scFormHeader" style="height:11px; display: block; border-width:0px; "></div>
 <div style="height:37px; border-width:0px 0px 1px 0px;  border-style: dashed; border-color:#ddd; display: block">
 	<table style="width:100%; border-collapse:collapse; padding:0;">
    	<tr>
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - producto"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - producto"; } ?></span></td>
            <td id="lin1_col2" class="scFormHeaderFont"><span><?php echo date($this->dateDefaultFormat()); ?></span></td>
        </tr>
    </table>		 
 </div>
</div>
</td></tr>
<?php
  }
?>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['fast_search'][2] : "";
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <input type="hidden" name="nmgp_fast_search_t" value="SC_all_Cmp">
          <input type="hidden" name="nmgp_cond_fast_search_t" value="qp">
          <script type="text/javascript">var scQSInitVal = "<?php echo $OPC_dat ?>";</script>
          <span id="quicksearchph_t">
           <input type="text" id="SC_fast_search_t" class="scFormToolbarInput" style="vertical-align: middle" name="nmgp_arg_fast_search_t" value="<?php echo NM_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{watermark:'<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>', watermarkClass: 'scFormToolbarInputWm', maxLength: 255}">
           <img style="position: absolute; display: none; height: 16px; width: 16px" id="SC_fast_search_close_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean; ?>" onclick="document.getElementById('SC_fast_search_t').value = ''; nm_move('fast_search', 't');">
           <img style="position: absolute; display: none; height: 16px; width: 16px" id="SC_fast_search_submit_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search; ?>" onclick="scQuickSearchSubmit_t();">
          </span>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (!$this->Embutida_call) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R" && (!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (!$this->Embutida_call) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (!$this->Embutida_call) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && (!$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
?>
<?php
   if (!isset($this->nmgp_cmp_hidden['orden_']))
   {
       $this->nmgp_cmp_hidden['orden_'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;">   <tr>
<?php
$orderColName = '';
$orderColOrient = '';
?>
    <script type="text/javascript">
     var orderImgAsc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc ?>";
     var orderImgDesc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc ?>";
     var orderImgNone = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort ?>";
     var orderColName = "";
     function scSetOrderColumn(clickedColumn) {
      $(".sc-ui-img-order-column").attr("src", orderImgNone);
      if (clickedColumn != orderColName) {
       orderColName = clickedColumn;
       orderColOrient = orderImgAsc;
      }
      else if ("" != orderColName) {
       orderColOrient = orderColOrient == orderImgAsc ? orderImgDesc : orderImgAsc;
      }
      else {
       orderColName = "";
       orderColOrient = "";
      }
      $("#sc-id-img-order-" + orderColName).attr("src", orderColOrient);
     }
    </script>
<?php
     $Col_span = "";


    ?>

    <TD class="scFormLabelOddMult" style="display: none;" <?php echo $Col_span ?>> &nbsp; </TD>
   
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {?>
    <TD class="scFormLabelOddMult"  width="10">  </TD>
   <?php }?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {?>
    <TD class="scFormLabelOddMult"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if ((!isset($this->nmgp_cmp_hidden['orden_']) || $this->nmgp_cmp_hidden['orden_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['orden_'])) {
          $this->nm_new_label['orden_'] = "ORDEN"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_orden_" style=";<?php echo $sStyleHidden_orden_; ?>" > <?php echo $this->nm_new_label['orden_'] ?> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['codigo_']) && $this->nmgp_cmp_hidden['codigo_'] == 'off') { $sStyleHidden_codigo_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['codigo_']) || $this->nmgp_cmp_hidden['codigo_'] == 'on') {
      if (!isset($this->nm_new_label['codigo_'])) {
          $this->nm_new_label['codigo_'] = "CODIGO"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_codigo_" style=";<?php echo $sStyleHidden_codigo_; ?>" > <?php echo $this->nm_new_label['codigo_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['descripcion_']) && $this->nmgp_cmp_hidden['descripcion_'] == 'off') { $sStyleHidden_descripcion_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['descripcion_']) || $this->nmgp_cmp_hidden['descripcion_'] == 'on') {
      if (!isset($this->nm_new_label['descripcion_'])) {
          $this->nm_new_label['descripcion_'] = "DESCRIPCION"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_descripcion_" style=";<?php echo $sStyleHidden_descripcion_; ?>" >       
<?php
      $link_img = "";
      $SC_Label = "" . $this->nm_new_label['descripcion_']  . "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['ordem_cmp'] == "DESCRIPCION")
      {
          $orderColName = "DESCRIPCION";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['ordem_ord'] == " desc")
          {
              $orderColOrient = $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $orderColOrient = $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos))
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = $SC_Label;
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = $SC_Label . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-DESCRIPCION\" />";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-DESCRIPCION\" />" . $SC_Label;
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-DESCRIPCION\" />" . $SC_Label;
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-DESCRIPCION\" />" . $SC_Label;
      }
      ?>
<a href="javascript:nm_move('ordem', 'DESCRIPCION')" class="scFormLabelLink scFormLabelLinkOddMult"><?php echo $link_img ?></a> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['orden_grupo_']) && $this->nmgp_cmp_hidden['orden_grupo_'] == 'off') { $sStyleHidden_orden_grupo_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['orden_grupo_']) || $this->nmgp_cmp_hidden['orden_grupo_'] == 'on') {
      if (!isset($this->nm_new_label['orden_grupo_'])) {
          $this->nm_new_label['orden_grupo_'] = "GRUPO"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_orden_grupo_" style=";<?php echo $sStyleHidden_orden_grupo_; ?>" > <?php echo $this->nm_new_label['orden_grupo_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['unidad_']) && $this->nmgp_cmp_hidden['unidad_'] == 'off') { $sStyleHidden_unidad_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['unidad_']) || $this->nmgp_cmp_hidden['unidad_'] == 'on') {
      if (!isset($this->nm_new_label['unidad_'])) {
          $this->nm_new_label['unidad_'] = "Unidad/Empaque"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_unidad_" style=";<?php echo $sStyleHidden_unidad_; ?>" > <?php echo $this->nm_new_label['unidad_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['factor_']) && $this->nmgp_cmp_hidden['factor_'] == 'off') { $sStyleHidden_factor_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['factor_']) || $this->nmgp_cmp_hidden['factor_'] == 'on') {
      if (!isset($this->nm_new_label['factor_'])) {
          $this->nm_new_label['factor_'] = "Factor/Divisor"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_factor_" style=";<?php echo $sStyleHidden_factor_; ?>" > <?php echo $this->nm_new_label['factor_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['unidad_factor_']) && $this->nmgp_cmp_hidden['unidad_factor_'] == 'off') { $sStyleHidden_unidad_factor_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['unidad_factor_']) || $this->nmgp_cmp_hidden['unidad_factor_'] == 'on') {
      if (!isset($this->nm_new_label['unidad_factor_'])) {
          $this->nm_new_label['unidad_factor_'] = "Unidad/Fraccionado"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_unidad_factor_" style=";<?php echo $sStyleHidden_unidad_factor_; ?>" > <?php echo $this->nm_new_label['unidad_factor_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['imagen1_']) && $this->nmgp_cmp_hidden['imagen1_'] == 'off') { $sStyleHidden_imagen1_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['imagen1_']) || $this->nmgp_cmp_hidden['imagen1_'] == 'on') {
      if (!isset($this->nm_new_label['imagen1_'])) {
          $this->nm_new_label['imagen1_'] = "Imagen 1"; } ?>

    <TD class="scFormLabelOddMult" id="hidden_field_label_imagen1_" style=";<?php echo $sStyleHidden_imagen1_; ?>" > <?php echo $this->nm_new_label['imagen1_'] ?> </TD>
   <?php } ?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert; 
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_producto_modificar);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_producto_modificar = $this->form_vert_form_producto_modificar;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_producto_modificar))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['orden_']))
           {
               $this->nmgp_cmp_readonly['orden_'] = 'on';
           }
   foreach ($this->form_vert_form_producto_modificar as $sc_seq_vert => $sc_lixo)
   {
       $this->codigorubro_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigorubro_'];
       $this->codigoproveedor1_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigoproveedor1_'];
       $this->codigoproveedor2_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigoproveedor2_'];
       $this->codigoproveedor3_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigoproveedor3_'];
       $this->codigopais_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigopais_'];
       $this->codigofabricante_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigofabricante_'];
       $this->impuesto_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['impuesto_'];
       $this->comisionvendedor_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['comisionvendedor_'];
       $this->stockminimo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stockminimo_'];
       $this->stockmaximo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stockmaximo_'];
       $this->stock_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_'];
       $this->preciodecosto_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['preciodecosto_'];
       $this->precio1_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['precio1_'];
       $this->precio2_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['precio2_'];
       $this->precio3_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['precio3_'];
       $this->precio4_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['precio4_'];
       $this->ubicacion_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['ubicacion_'];
       $this->montoex_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['montoex_'];
       $this->vencimiento_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['vencimiento_'];
       $this->codigoindicacion_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigoindicacion_'];
       $this->recalculo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['recalculo_'];
       $this->inactivo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['inactivo_'];
       $this->tipo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['tipo_'];
       $this->contabilizable_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['contabilizable_'];
       $this->codigogenerado_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigogenerado_'];
       $this->utilizargenerado_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['utilizargenerado_'];
       $this->descuento_normal_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['descuento_normal_'];
       $this->descuento_promo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['descuento_promo_'];
       $this->comisionvendedor2_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['comisionvendedor2_'];
       $this->comisionvendedor3_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['comisionvendedor3_'];
       $this->comisionvendedor4_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['comisionvendedor4_'];
       $this->utilidad1_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['utilidad1_'];
       $this->utilidad2_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['utilidad2_'];
       $this->utilidad3_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['utilidad3_'];
       $this->utilidad4_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['utilidad4_'];
       $this->actualizar_precio_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['actualizar_precio_'];
       $this->bloquear_porcentaje_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['bloquear_porcentaje_'];
       $this->peso_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['peso_'];
       $this->porcentaje_comision_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['porcentaje_comision_'];
       $this->preciodecostodol_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['preciodecostodol_'];
       $this->composicion_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['composicion_'];
       $this->stock_02_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_02_'];
       $this->stock_03_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_03_'];
       $this->stock_04_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_04_'];
       $this->stock_05_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_05_'];
       $this->stock_06_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_06_'];
       $this->stock_07_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_07_'];
       $this->stock_08_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_08_'];
       $this->stock_09_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_09_'];
       $this->stock_10_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_10_'];
       $this->eliminado_automatico_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['eliminado_automatico_'];
       $this->automotor_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['automotor_'];
       $this->incluir_comision_rubro_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['incluir_comision_rubro_'];
       $this->comision_por_unidad_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['comision_por_unidad_'];
       $this->comision_por_unidad_gs_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['comision_por_unidad_gs_'];
       $this->costo_promedio_gs_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['costo_promedio_gs_'];
       $this->saltar_automatico_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['saltar_automatico_'];
       $this->subgrupo_orden_subgrupo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['subgrupo_orden_subgrupo_'];
       $this->imagen_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['imagen_'];
       $this->stock_pedido_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['stock_pedido_'];
       $this->costo_promedio_dol_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['costo_promedio_dol_'];
       $this->codigo_barra_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigo_barra_'];
       $this->costo_operativo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['costo_operativo_'];
       $this->imagen2_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['imagen2_'];
       $this->imagen3_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['imagen3_'];
       $this->imagen4_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['imagen4_'];
       $this->codigo_factor_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigo_factor_'];
       $this->tipo_precio_factor_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['tipo_precio_factor_'];
       $this->facturar_por_monto_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['facturar_por_monto_'];
       $this->porcentaje_producto_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['porcentaje_producto_'];
       $this->codigo_cuenta_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigo_cuenta_'];
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['orden_'] = true;
           $this->nmgp_cmp_readonly['codigo_'] = true;
           $this->nmgp_cmp_readonly['descripcion_'] = true;
           $this->nmgp_cmp_readonly['orden_grupo_'] = true;
           $this->nmgp_cmp_readonly['unidad_'] = true;
           $this->nmgp_cmp_readonly['factor_'] = true;
           $this->nmgp_cmp_readonly['unidad_factor_'] = true;
           $this->nmgp_cmp_readonly['imagen1_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['orden_']) || $this->nmgp_cmp_readonly['orden_'] != "on") {$this->nmgp_cmp_readonly['orden_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['codigo_']) || $this->nmgp_cmp_readonly['codigo_'] != "on") {$this->nmgp_cmp_readonly['codigo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['descripcion_']) || $this->nmgp_cmp_readonly['descripcion_'] != "on") {$this->nmgp_cmp_readonly['descripcion_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['orden_grupo_']) || $this->nmgp_cmp_readonly['orden_grupo_'] != "on") {$this->nmgp_cmp_readonly['orden_grupo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['unidad_']) || $this->nmgp_cmp_readonly['unidad_'] != "on") {$this->nmgp_cmp_readonly['unidad_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['factor_']) || $this->nmgp_cmp_readonly['factor_'] != "on") {$this->nmgp_cmp_readonly['factor_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['unidad_factor_']) || $this->nmgp_cmp_readonly['unidad_factor_'] != "on") {$this->nmgp_cmp_readonly['unidad_factor_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['imagen1_']) || $this->nmgp_cmp_readonly['imagen1_'] != "on") {$this->nmgp_cmp_readonly['imagen1_'] = false;}
       }
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
        $this->orden_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['orden_']; 
       $orden_ = $this->orden_; 
       if (!isset($this->nmgp_cmp_hidden['orden_']))
       {
           $this->nmgp_cmp_hidden['orden_'] = 'off';
       }
       $sStyleHidden_orden_ = '';
       if (isset($sCheckRead_orden_))
       {
           unset($sCheckRead_orden_);
       }
       if (isset($this->nmgp_cmp_readonly['orden_']))
       {
           $sCheckRead_orden_ = $this->nmgp_cmp_readonly['orden_'];
       }
       if (isset($this->nmgp_cmp_hidden['orden_']) && $this->nmgp_cmp_hidden['orden_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['orden_']);
           $sStyleHidden_orden_ = 'display: none;';
       }
       $bTestReadOnly_orden_ = true;
       $sStyleReadLab_orden_ = 'display: none;';
       $sStyleReadInp_orden_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["orden_"]) &&  $this->nmgp_cmp_readonly["orden_"] == "on"))
       {
           $bTestReadOnly_orden_ = false;
           unset($this->nmgp_cmp_readonly['orden_']);
           $sStyleReadLab_orden_ = '';
           $sStyleReadInp_orden_ = 'display: none;';
       }
       $this->codigo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['codigo_']; 
       $codigo_ = $this->codigo_; 
       $sStyleHidden_codigo_ = '';
       if (isset($sCheckRead_codigo_))
       {
           unset($sCheckRead_codigo_);
       }
       if (isset($this->nmgp_cmp_readonly['codigo_']))
       {
           $sCheckRead_codigo_ = $this->nmgp_cmp_readonly['codigo_'];
       }
       if (isset($this->nmgp_cmp_hidden['codigo_']) && $this->nmgp_cmp_hidden['codigo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['codigo_']);
           $sStyleHidden_codigo_ = 'display: none;';
       }
       $bTestReadOnly_codigo_ = true;
       $sStyleReadLab_codigo_ = 'display: none;';
       $sStyleReadInp_codigo_ = '';
       if (isset($this->nmgp_cmp_readonly['codigo_']) && $this->nmgp_cmp_readonly['codigo_'] == 'on')
       {
           $bTestReadOnly_codigo_ = false;
           unset($this->nmgp_cmp_readonly['codigo_']);
           $sStyleReadLab_codigo_ = '';
           $sStyleReadInp_codigo_ = 'display: none;';
       }
       $this->descripcion_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['descripcion_']; 
       $descripcion_ = $this->descripcion_; 
       $sStyleHidden_descripcion_ = '';
       if (isset($sCheckRead_descripcion_))
       {
           unset($sCheckRead_descripcion_);
       }
       if (isset($this->nmgp_cmp_readonly['descripcion_']))
       {
           $sCheckRead_descripcion_ = $this->nmgp_cmp_readonly['descripcion_'];
       }
       if (isset($this->nmgp_cmp_hidden['descripcion_']) && $this->nmgp_cmp_hidden['descripcion_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['descripcion_']);
           $sStyleHidden_descripcion_ = 'display: none;';
       }
       $bTestReadOnly_descripcion_ = true;
       $sStyleReadLab_descripcion_ = 'display: none;';
       $sStyleReadInp_descripcion_ = '';
       if (isset($this->nmgp_cmp_readonly['descripcion_']) && $this->nmgp_cmp_readonly['descripcion_'] == 'on')
       {
           $bTestReadOnly_descripcion_ = false;
           unset($this->nmgp_cmp_readonly['descripcion_']);
           $sStyleReadLab_descripcion_ = '';
           $sStyleReadInp_descripcion_ = 'display: none;';
       }
       $this->orden_grupo_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['orden_grupo_']; 
       $orden_grupo_ = $this->orden_grupo_; 
       $sStyleHidden_orden_grupo_ = '';
       if (isset($sCheckRead_orden_grupo_))
       {
           unset($sCheckRead_orden_grupo_);
       }
       if (isset($this->nmgp_cmp_readonly['orden_grupo_']))
       {
           $sCheckRead_orden_grupo_ = $this->nmgp_cmp_readonly['orden_grupo_'];
       }
       if (isset($this->nmgp_cmp_hidden['orden_grupo_']) && $this->nmgp_cmp_hidden['orden_grupo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['orden_grupo_']);
           $sStyleHidden_orden_grupo_ = 'display: none;';
       }
       $bTestReadOnly_orden_grupo_ = true;
       $sStyleReadLab_orden_grupo_ = 'display: none;';
       $sStyleReadInp_orden_grupo_ = '';
       if (isset($this->nmgp_cmp_readonly['orden_grupo_']) && $this->nmgp_cmp_readonly['orden_grupo_'] == 'on')
       {
           $bTestReadOnly_orden_grupo_ = false;
           unset($this->nmgp_cmp_readonly['orden_grupo_']);
           $sStyleReadLab_orden_grupo_ = '';
           $sStyleReadInp_orden_grupo_ = 'display: none;';
       }
       $this->unidad_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['unidad_']; 
       $unidad_ = $this->unidad_; 
       $sStyleHidden_unidad_ = '';
       if (isset($sCheckRead_unidad_))
       {
           unset($sCheckRead_unidad_);
       }
       if (isset($this->nmgp_cmp_readonly['unidad_']))
       {
           $sCheckRead_unidad_ = $this->nmgp_cmp_readonly['unidad_'];
       }
       if (isset($this->nmgp_cmp_hidden['unidad_']) && $this->nmgp_cmp_hidden['unidad_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['unidad_']);
           $sStyleHidden_unidad_ = 'display: none;';
       }
       $bTestReadOnly_unidad_ = true;
       $sStyleReadLab_unidad_ = 'display: none;';
       $sStyleReadInp_unidad_ = '';
       if (isset($this->nmgp_cmp_readonly['unidad_']) && $this->nmgp_cmp_readonly['unidad_'] == 'on')
       {
           $bTestReadOnly_unidad_ = false;
           unset($this->nmgp_cmp_readonly['unidad_']);
           $sStyleReadLab_unidad_ = '';
           $sStyleReadInp_unidad_ = 'display: none;';
       }
       $this->factor_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['factor_']; 
       $factor_ = $this->factor_; 
       $sStyleHidden_factor_ = '';
       if (isset($sCheckRead_factor_))
       {
           unset($sCheckRead_factor_);
       }
       if (isset($this->nmgp_cmp_readonly['factor_']))
       {
           $sCheckRead_factor_ = $this->nmgp_cmp_readonly['factor_'];
       }
       if (isset($this->nmgp_cmp_hidden['factor_']) && $this->nmgp_cmp_hidden['factor_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['factor_']);
           $sStyleHidden_factor_ = 'display: none;';
       }
       $bTestReadOnly_factor_ = true;
       $sStyleReadLab_factor_ = 'display: none;';
       $sStyleReadInp_factor_ = '';
       if (isset($this->nmgp_cmp_readonly['factor_']) && $this->nmgp_cmp_readonly['factor_'] == 'on')
       {
           $bTestReadOnly_factor_ = false;
           unset($this->nmgp_cmp_readonly['factor_']);
           $sStyleReadLab_factor_ = '';
           $sStyleReadInp_factor_ = 'display: none;';
       }
       $this->unidad_factor_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['unidad_factor_']; 
       $unidad_factor_ = $this->unidad_factor_; 
       $sStyleHidden_unidad_factor_ = '';
       if (isset($sCheckRead_unidad_factor_))
       {
           unset($sCheckRead_unidad_factor_);
       }
       if (isset($this->nmgp_cmp_readonly['unidad_factor_']))
       {
           $sCheckRead_unidad_factor_ = $this->nmgp_cmp_readonly['unidad_factor_'];
       }
       if (isset($this->nmgp_cmp_hidden['unidad_factor_']) && $this->nmgp_cmp_hidden['unidad_factor_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['unidad_factor_']);
           $sStyleHidden_unidad_factor_ = 'display: none;';
       }
       $bTestReadOnly_unidad_factor_ = true;
       $sStyleReadLab_unidad_factor_ = 'display: none;';
       $sStyleReadInp_unidad_factor_ = '';
       if (isset($this->nmgp_cmp_readonly['unidad_factor_']) && $this->nmgp_cmp_readonly['unidad_factor_'] == 'on')
       {
           $bTestReadOnly_unidad_factor_ = false;
           unset($this->nmgp_cmp_readonly['unidad_factor_']);
           $sStyleReadLab_unidad_factor_ = '';
           $sStyleReadInp_unidad_factor_ = 'display: none;';
       }
       $this->imagen1_ = $this->form_vert_form_producto_modificar[$sc_seq_vert]['imagen1_']; 
       $imagen1_ = $this->imagen1_; 
       $this->imagen1__limpa = $this->form_vert_form_producto_modificar[$sc_seq_vert]['imagen1__limpa']; 
       $imagen1__limpa = $this->imagen1__limpa; 
       $sStyleHidden_imagen1_ = '';
       if (isset($sCheckRead_imagen1_))
       {
           unset($sCheckRead_imagen1_);
       }
       if (isset($this->nmgp_cmp_readonly['imagen1_']))
       {
           $sCheckRead_imagen1_ = $this->nmgp_cmp_readonly['imagen1_'];
       }
       if (isset($this->nmgp_cmp_hidden['imagen1_']) && $this->nmgp_cmp_hidden['imagen1_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['imagen1_']);
           $sStyleHidden_imagen1_ = 'display: none;';
       }
       $bTestReadOnly_imagen1_ = true;
       $sStyleReadLab_imagen1_ = 'display: none;';
       $sStyleReadInp_imagen1_ = '';
       if (isset($this->nmgp_cmp_readonly['imagen1_']) && $this->nmgp_cmp_readonly['imagen1_'] == 'on')
       {
           $bTestReadOnly_imagen1_ = false;
           unset($this->nmgp_cmp_readonly['imagen1_']);
           $sStyleReadLab_imagen1_ = '';
           $sStyleReadInp_imagen1_ = 'display: none;';
       }

       if ($this->nmgp_opcao == "novo")
       { 
           $out_imagen1_   = "";  
           $this->imagen1_ = "";  
       } 
       else 
       { 
           $out_imagen1_ = $this->imagen1_;  
       } 
       if ($this->imagen1_ != "" && $this->imagen1_ != "none")   
       { 
           $path_imagen1_ = $this->Ini->root . $this->Ini->path_imagens . "imagen_producto" . "/" . $this->imagen1_;
           $md5_imagen1_  = md5("imagen_producto" . $this->imagen1_);
           if (is_file($path_imagen1_))  
           { 
               $NM_ler_img = true;
               $out_imagen1_ = $this->Ini->path_imag_temp . "/sc_imagen1__" . $md5_imagen1_ . ".gif" ;  
               if (is_file($this->Ini->root . $out_imagen1_))  
               { 
                   $NM_img_time = filemtime($this->Ini->root . $out_imagen1_) + 0; 
                   if ($this->Ini->nm_timestamp < $NM_img_time)  
                   { 
                       $NM_ler_img = false;
                   } 
               } 
               if ($NM_ler_img) 
               { 
                   $tmp_imagen1_ = fopen($path_imagen1_, "r") ; 
                   $reg_imagen1_ = fread($tmp_imagen1_, filesize($path_imagen1_)) ; 
                   fclose($tmp_imagen1_) ;  
                   $arq_imagen1_ = fopen($this->Ini->root . $out_imagen1_, "w") ;  
                   fwrite($arq_imagen1_, $reg_imagen1_) ;  
                   fclose($arq_imagen1_) ;  
               } 
               $sc_obj_img = new nm_trata_img($this->Ini->root . $out_imagen1_);
               $this->nmgp_return_img['imagen1_'][0] = $sc_obj_img->getHeight();
               $this->nmgp_return_img['imagen1_'][1] = $sc_obj_img->getWidth();
               $NM_redim_img = true;
               $out1_imagen1_ = $out_imagen1_; 
               $md5_imagen1_  = md5("imagen_producto" . $this->imagen1_);
               $out_imagen1_ = $this->Ini->path_imag_temp . "/sc_imagen1__5050" . $md5_imagen1_ . ".gif" ;  
               if (is_file($this->Ini->root . $out_imagen1_))  
               { 
                   $NM_img_time = filemtime($this->Ini->root . $out_imagen1_) + 0; 
                   if ($this->Ini->nm_timestamp < $NM_img_time)  
                   { 
                       $NM_redim_img = false;
                   } 
               } 
               if ($NM_redim_img) 
               { 
                   if (!$this->Ini->Gd_missing)
                   { 
                       $sc_obj_img = new nm_trata_img($this->Ini->root . $out1_imagen1_);
                       $sc_obj_img->setWidth(50);
                       $sc_obj_img->setHeight(50);
                       $sc_obj_img->createImg($this->Ini->root . $out_imagen1_);
                   } 
                   else 
                   { 
                       $out_imagen1_ = $out1_imagen1_;
                   } 
               } 
           } 
       } 
       $nm_cor_fun_vert = ($nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?>>
<input type="hidden" name="imagen1__ul_name<?php echo $sc_seq_vert; ?>" id="id_sc_field_imagen1__ul_name<?php echo $sc_seq_vert; ?>" value="<?php echo NM_encode_input($this->imagen1__ul_name);?>">
<input type="hidden" name="imagen1__ul_type<?php echo $sc_seq_vert; ?>" id="id_sc_field_imagen1__ul_type<?php echo $sc_seq_vert; ?>" value="<?php echo NM_encode_input($this->imagen1__ul_type);?>">


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if ($this->Embutida_form) {?>
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_botoes['delete'] == "on" && $this->nmgp_opcao != "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php
if ($this->nmgp_botoes['update'] == "on" && $this->nmgp_opcao != "novo") {
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_producto_modificar_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_producto_modificar_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_producto_modificar_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_producto_modificar_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_producto_modificar_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_producto_modificar_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['orden_']) && $this->nmgp_cmp_hidden['orden_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="orden_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($orden_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_orden_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_orden_; ?>text-align:left;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style="text-align:left;;vertical-align: top;padding: 0px"><span id="id_read_on_orden_<?php echo $sc_seq_vert ?>" style="text-align:left;<?php echo $sStyleReadLab_orden_; ?>"><?php echo NM_encode_input($this->orden_); ?></span><span id="id_read_off_orden_<?php echo $sc_seq_vert ?>" style="<?php echo $sStyleReadInp_orden_; ?>"><input type="hidden" id="id_sc_field_orden_<?php echo $sc_seq_vert ?>" name="orden_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($orden_) . "\">"?><span id="id_ajax_label_orden_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($orden_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_orden_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_orden_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['codigo_']) && $this->nmgp_cmp_hidden['codigo_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($codigo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_codigo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_codigo_; ?>;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style=";;vertical-align: top;padding: 0px"><input type="hidden" name="codigo_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($codigo_); ?>"><span id="id_ajax_label_codigo_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($codigo_); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['descripcion_']) && $this->nmgp_cmp_hidden['descripcion_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="descripcion_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($descripcion_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_descripcion_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_descripcion_; ?>;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style=";;vertical-align: top;padding: 0px"><input type="hidden" name="descripcion_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($descripcion_); ?>"><span id="id_ajax_label_descripcion_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($descripcion_); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descripcion_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descripcion_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['orden_grupo_']) && $this->nmgp_cmp_hidden['orden_grupo_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="orden_grupo_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($this->orden_grupo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_orden_grupo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_orden_grupo_; ?>text-align:left;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style="text-align:left;;vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_orden_grupo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["orden_grupo_"]) &&  $this->nmgp_cmp_readonly["orden_grupo_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array(); 
    }

   $old_value_orden_ = $this->orden_;
   $old_value_factor_ = $this->factor_;
   $this->nm_tira_formatacao();


   $unformatted_value_orden_ = $this->orden_;
   $unformatted_value_factor_ = $this->factor_;

   $nm_comando = "SELECT ORDEN, DESCRIPCION 
FROM grupo 
ORDER BY DESCRIPCION";

   $this->orden_ = $old_value_orden_;
   $this->factor_ = $old_value_factor_;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $orden_grupo__look = ""; 
   $todo = explode("?@?", trim($nmgp_def_dados)) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->orden_grupo__1))
          {
              foreach ($this->orden_grupo__1 as $tmp_orden_grupo_)
              {
                  if (trim($tmp_orden_grupo_) === trim($cadaselect[1])) { $orden_grupo__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->orden_grupo_) === trim($cadaselect[1])) { $orden_grupo__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="orden_grupo_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($orden_grupo_) . "\">" . $orden_grupo__look . ""; ?>
<?php } else { ?>
 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'] = array(); 
    }

   $old_value_orden_ = $this->orden_;
   $old_value_factor_ = $this->factor_;
   $this->nm_tira_formatacao();


   $unformatted_value_orden_ = $this->orden_;
   $unformatted_value_factor_ = $this->factor_;

   $nm_comando = "SELECT ORDEN, DESCRIPCION 
FROM grupo 
ORDER BY DESCRIPCION";

   $this->orden_ = $old_value_orden_;
   $this->factor_ = $old_value_factor_;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['Lookup_orden_grupo_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0 ; 
   $todo = explode("?@?", $nmgp_def_dados) ; 
   $x = 0; 
   $orden_grupo__look = ""; 
   $todo = explode("?@?", trim($nmgp_def_dados)) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->orden_grupo__1))
          {
              foreach ($this->orden_grupo__1 as $tmp_orden_grupo_)
              {
                  if (trim($tmp_orden_grupo_) === trim($cadaselect[1])) { $orden_grupo__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->orden_grupo_) === trim($cadaselect[1])) { $orden_grupo__look .= $cadaselect[0]; } 
          $x++; 
   }
   $x = 0; 
   echo "<span id=\"id_read_on_orden_grupo_" . $sc_seq_vert . "\" style=\"text-align:left;" .  $sStyleReadLab_orden_grupo_ . "\">" . NM_encode_input($orden_grupo__look) . "</span><span id=\"id_read_off_orden_grupo_" . $sc_seq_vert . "\" style=\"" . $sStyleReadInp_orden_grupo_ . "\">";
   echo " <span id=\"idAjaxSelect_orden_grupo_" .  $sc_seq_vert . "\"><select class=\"sc-js-input scFormObjectOddMult\" style=\"text-align:left;\" id=\"id_sc_field_orden_grupo_" . $sc_seq_vert . "\" name=\"orden_grupo_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->orden_grupo_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->orden_grupo_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
 ?>&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bform_lookuplink", "", "", "fldedt_orden_grupo_" . $sc_seq_vert . "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->link_form_grupo_edit . "?script_case_init=" . $this->Ini->sc_page . "&script_case_session=" . session_id() . "&nmgp_url_saida=modal&nmgp_parms=sc_redir_atualiz*scinok*scout&nmgp_outra_jan=true&nm_evt_ret_edit=do_ajax_form_producto_modificar_lkpedt_refresh_orden_grupo_&nm_evt_ret_row=" . $sc_seq_vert . "&KeepThis=true&TB_iframe=true&height=200&width=500&modal=true", "");?>
<?php    echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_orden_grupo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_orden_grupo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['unidad_']) && $this->nmgp_cmp_hidden['unidad_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="unidad_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($unidad_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_unidad_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_unidad_; ?>;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style=";;vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_unidad_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["unidad_"]) &&  $this->nmgp_cmp_readonly["unidad_"] == "on") { 

 ?>
<input type="hidden" name="unidad_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($unidad_) . "\">" . $unidad_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_unidad_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-unidad_<?php echo $sc_seq_vert ?>" style=";<?php echo $sStyleReadLab_unidad_; ?>"><?php echo NM_encode_input($this->unidad_); ?></span><span id="id_read_off_unidad_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_unidad_; ?>">
 <input class="sc-js-input scFormObjectOddMult" style=";" id="id_sc_field_unidad_<?php echo $sc_seq_vert ?>" type=text name="unidad_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($unidad_) ?>"
 size=10 maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_unidad_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_unidad_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['factor_']) && $this->nmgp_cmp_hidden['factor_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="factor_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($factor_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_factor_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_factor_; ?>text-align:left;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style="text-align:left;;vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_factor_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["factor_"]) &&  $this->nmgp_cmp_readonly["factor_"] == "on") { 

 ?>
<input type="hidden" name="factor_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($factor_) . "\">" . $factor_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_factor_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-factor_<?php echo $sc_seq_vert ?>" style="text-align:left;<?php echo $sStyleReadLab_factor_; ?>"><?php echo NM_encode_input($this->factor_); ?></span><span id="id_read_off_factor_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_factor_; ?>">
 <input class="sc-js-input scFormObjectOddMult" style="text-align:right;" id="id_sc_field_factor_<?php echo $sc_seq_vert ?>" type=text name="factor_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($factor_) ?>"
 size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['factor_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['factor_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_factor_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_factor_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['unidad_factor_']) && $this->nmgp_cmp_hidden['unidad_factor_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="unidad_factor_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($unidad_factor_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_unidad_factor_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_unidad_factor_; ?>;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style=";;vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_unidad_factor_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["unidad_factor_"]) &&  $this->nmgp_cmp_readonly["unidad_factor_"] == "on") { 

 ?>
<input type="hidden" name="unidad_factor_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($unidad_factor_) . "\">" . $unidad_factor_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_unidad_factor_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-unidad_factor_<?php echo $sc_seq_vert ?>" style=";<?php echo $sStyleReadLab_unidad_factor_; ?>"><?php echo NM_encode_input($this->unidad_factor_); ?></span><span id="id_read_off_unidad_factor_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_unidad_factor_; ?>">
 <input class="sc-js-input scFormObjectOddMult" style=";" id="id_sc_field_unidad_factor_<?php echo $sc_seq_vert ?>" type=text name="unidad_factor_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($unidad_factor_) ?>"
 size=10 maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_unidad_factor_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_unidad_factor_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['imagen1_']) && $this->nmgp_cmp_hidden['imagen1_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="imagen1_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($imagen1_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult" id="hidden_field_data_imagen1_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_imagen1_; ?>;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult" style=";;vertical-align: top;padding: 0px">
 <script>var var_ajax_img_imagen1_<?php echo $sc_seq_vert; ?> = '<?php echo $out1_imagen1_; ?>';</script><?php if (!empty($out_imagen1_)){ echo "<a  href=\"javascript:nm_mostra_img(var_ajax_img_imagen1_" . $sc_seq_vert . ", '" . $this->nmgp_return_img['imagen1_'][0] . "', '" . $this->nmgp_return_img['imagen1_'][1] . "')\"><img id=\"id_ajax_img_imagen1_" . $sc_seq_vert . "\" border=\"1\" src=\"$out_imagen1_\"></a> &nbsp;" . "<span id=\"txt_ajax_img_imagen1_" . $sc_seq_vert . "\">" . $imagen1_ . "</span>"; if (!empty($imagen1_)){ echo "<br>";} } else { echo "<img id=\"id_ajax_img_imagen1_" . $sc_seq_vert . "\" border=\"1\" style=\"display: none\"> &nbsp;<span id=\"txt_ajax_img_imagen1_" . $sc_seq_vert . "\"></span><br />"; } ?>
<?php if ($bTestReadOnly_imagen1_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["imagen1_"]) &&  $this->nmgp_cmp_readonly["imagen1_"] == "on") { 

 ?>
<img id=\"imagen1_<?php echo $sc_seq_vert ?><?php echo $sc_seq_vert; ?>_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><input type="hidden" name="imagen1_<?php echo $sc_seq_vert ?>" value="<?php echo NM_encode_input($imagen1_) . "\">" . $imagen1_ . ""; ?>
<?php } else { ?>
<span id="id_read_off_imagen1_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_imagen1_; ?>">
 <input type="hidden" name="imagen1_<?php echo $sc_seq_vert ?>_salva" value="<?php echo NM_encode_input($this->imagen1_) ?>">
 <input class="sc-js-input scFormObjectOddMult" style=";" type="file" name="imagen1_<?php echo $sc_seq_vert ?>[]" id="id_sc_field_imagen1_<?php echo $sc_seq_vert ?>" onchange="<?php if ($this->nmgp_opcao == "novo") {echo "if (document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]']) { document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]'].checked = true }"; }?>" alt="{enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}"><span id="chk_ajax_img_imagen1_<?php echo $sc_seq_vert; ?>"<?php if ($this->nmgp_opcao == "novo" || empty($imagen1_)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="imagen1__limpa<?php echo $sc_seq_vert ?>" value="<?php echo $imagen1__limpa . '" '; if ($imagen1__limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="imagen1_<?php echo $sc_seq_vert ?><?php echo $sc_seq_vert; ?>_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><div id="id_img_loader_imagen1_" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_imagen1_" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_imagen1_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_imagen1_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_orden_))
       {
           $this->nmgp_cmp_readonly['orden_'] = $sCheckRead_orden_;
       }
       if ('display: none;' == $sStyleHidden_orden_)
       {
           $this->nmgp_cmp_hidden['orden_'] = 'off';
       }
       if (isset($sCheckRead_codigo_))
       {
           $this->nmgp_cmp_readonly['codigo_'] = $sCheckRead_codigo_;
       }
       if ('display: none;' == $sStyleHidden_codigo_)
       {
           $this->nmgp_cmp_hidden['codigo_'] = 'off';
       }
       if (isset($sCheckRead_descripcion_))
       {
           $this->nmgp_cmp_readonly['descripcion_'] = $sCheckRead_descripcion_;
       }
       if ('display: none;' == $sStyleHidden_descripcion_)
       {
           $this->nmgp_cmp_hidden['descripcion_'] = 'off';
       }
       if (isset($sCheckRead_orden_grupo_))
       {
           $this->nmgp_cmp_readonly['orden_grupo_'] = $sCheckRead_orden_grupo_;
       }
       if ('display: none;' == $sStyleHidden_orden_grupo_)
       {
           $this->nmgp_cmp_hidden['orden_grupo_'] = 'off';
       }
       if (isset($sCheckRead_unidad_))
       {
           $this->nmgp_cmp_readonly['unidad_'] = $sCheckRead_unidad_;
       }
       if ('display: none;' == $sStyleHidden_unidad_)
       {
           $this->nmgp_cmp_hidden['unidad_'] = 'off';
       }
       if (isset($sCheckRead_factor_))
       {
           $this->nmgp_cmp_readonly['factor_'] = $sCheckRead_factor_;
       }
       if ('display: none;' == $sStyleHidden_factor_)
       {
           $this->nmgp_cmp_hidden['factor_'] = 'off';
       }
       if (isset($sCheckRead_unidad_factor_))
       {
           $this->nmgp_cmp_readonly['unidad_factor_'] = $sCheckRead_unidad_factor_;
       }
       if ('display: none;' == $sStyleHidden_unidad_factor_)
       {
           $this->nmgp_cmp_hidden['unidad_factor_'] = 'off';
       }
       if (isset($sCheckRead_imagen1_))
       {
           $this->nmgp_cmp_readonly['imagen1_'] = $sCheckRead_imagen1_;
       }
       if ('display: none;' == $sStyleHidden_imagen1_)
       {
           $this->nmgp_cmp_hidden['imagen1_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_producto_modificar = $guarda_form_vert_form_producto_modificar;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div> 
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo NM_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; text-align: center; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr> 
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "birpara", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", "brec_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio_off", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bretorna", "nm_move ('retorna');", "nm_move ('retorna');", "sc_b_ret_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bretorna_off", "nm_move ('retorna');", "nm_move ('retorna');", "sc_b_ret_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b" class="scFormToolbarPadding"></span> 
<?php 
}
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca_off", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bfinal", "nm_move ('final');", "nm_move ('final');", "sc_b_fim_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bfinal_off", "nm_move ('final');", "nm_move ('final');", "sc_b_fim_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b" class="scFormToolbarPadding"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none; position: absolute; left: 50px; top: 50px"><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

</form> 
<?php
      $Tzone = ini_get('date.timezone');
      if (empty($Tzone))
      {
?>
<script> 
  _scAjaxShowMessage('', "<?php echo $this->Ini->Nm_lang['lang_errm_tz']; ?>", false, 0, false, "Ok", 0, 0, 0, 0, "", "", "", true, false);
</script> 
<?php
      }
?>
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
   </td></tr></table>
<script>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_producto_modificar");
 parent.scAjaxDetailHeight("form_producto_modificar", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailHeight("form_producto_modificar", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
?>
<script type="text/javascript">
_scAjaxShowMessage(scMsgDefTitle, "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", false, sc_ajaxMsgTime, false, "Ok", 0, 0, 0, 0, "", "", "", false, true);
</script>
<?php
}
?>
<?php
if ('' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_producto_modificar']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
</body> 
</html> 
<?php 
 } 
} 
?> 
