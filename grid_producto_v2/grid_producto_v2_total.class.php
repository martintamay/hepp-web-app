<?php

class grid_producto_v2_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function grid_producto_v2_total($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("es");
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_producto_v2']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_producto_v2']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->orden = $Busca_temp['orden']; 
          $tmp_pos = strpos($this->orden, "##@@");
          if ($tmp_pos !== false)
          {
              $this->orden = substr($this->orden, 0, $tmp_pos);
          }
          $orden_2 = $Busca_temp['orden_input_2']; 
          $this->orden_2 = $Busca_temp['orden_input_2']; 
          $this->codigo = $Busca_temp['codigo']; 
          $tmp_pos = strpos($this->codigo, "##@@");
          if ($tmp_pos !== false)
          {
              $this->codigo = substr($this->codigo, 0, $tmp_pos);
          }
          $this->descripcion = $Busca_temp['descripcion']; 
          $tmp_pos = strpos($this->descripcion, "##@@");
          if ($tmp_pos !== false)
          {
              $this->descripcion = substr($this->descripcion, 0, $tmp_pos);
          }
          $this->codigorubro = $Busca_temp['codigorubro']; 
          $tmp_pos = strpos($this->codigorubro, "##@@");
          if ($tmp_pos !== false)
          {
              $this->codigorubro = substr($this->codigorubro, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral()
   {
      global $nada, $nm_lang , $orden, $orden_grupo;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['tot_geral'][0] = "Total Compra"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_producto_v2']['contr_total_geral'] = "OK";
   } 

   //-----  orden_grupo
   function quebra_orden_grupo_producto($orden_grupo, $arg_sum_orden_grupo) 
   {
      global $tot_orden_grupo , $orden, $orden_grupo;  
      $tot_orden_grupo = array() ;  
      $tot_orden_grupo[0] = $orden_grupo ; 
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
function buscar_cantidad()
{
$_SESSION['scriptcase']['grid_producto_v2']['contr_erro'] = 'on';
if (!isset($_SESSION['v_actualizar'])) {$_SESSION['v_actualizar'] = "";}
if (!isset($this->sc_temp_v_actualizar)) {$this->sc_temp_v_actualizar = (isset($_SESSION['v_actualizar'])) ? $_SESSION['v_actualizar'] : "";}
if (!isset($_SESSION['v_fraccionado'])) {$_SESSION['v_fraccionado'] = "";}
if (!isset($this->sc_temp_v_fraccionado)) {$this->sc_temp_v_fraccionado = (isset($_SESSION['v_fraccionado'])) ? $_SESSION['v_fraccionado'] : "";}
if (!isset($_SESSION['v_cant'])) {$_SESSION['v_cant'] = "";}
if (!isset($this->sc_temp_v_cant)) {$this->sc_temp_v_cant = (isset($_SESSION['v_cant'])) ? $_SESSION['v_cant'] : "";}
if (!isset($_SESSION['v_ordenproducto'])) {$_SESSION['v_ordenproducto'] = "";}
if (!isset($this->sc_temp_v_ordenproducto)) {$this->sc_temp_v_ordenproducto = (isset($_SESSION['v_ordenproducto'])) ? $_SESSION['v_ordenproducto'] : "";}
if (!isset($_SESSION['cuenta'])) {$_SESSION['cuenta'] = "";}
if (!isset($this->sc_temp_cuenta)) {$this->sc_temp_cuenta = (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta'] : "";}
     
$check_sql = "SELECT cantidad, fraccionado"
   . " FROM pedido"
   . " WHERE cliente_cuenta = '" . $this->sc_temp_cuenta . "'"
   . " and ordenproducto = '" . $this->sc_temp_v_ordenproducto . "'";
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rs[0][0]))     
{
    $this->sc_temp_v_cant = $this->rs[0][0];
	$this->sc_temp_v_fraccionado = $this->rs[0][1];
	$this->sc_temp_v_actualizar = 1;
}
		else     
{
	$this->sc_temp_v_cant = 0;
	$this->sc_temp_v_actualizar = 0;
	$this->sc_temp_v_fraccionado = 0;
}
if (isset($this->sc_temp_cuenta)) {$_SESSION['cuenta'] = $this->sc_temp_cuenta;}
if (isset($this->sc_temp_v_ordenproducto)) {$_SESSION['v_ordenproducto'] = $this->sc_temp_v_ordenproducto;}
if (isset($this->sc_temp_v_cant)) {$_SESSION['v_cant'] = $this->sc_temp_v_cant;}
if (isset($this->sc_temp_v_fraccionado)) {$_SESSION['v_fraccionado'] = $this->sc_temp_v_fraccionado;}
if (isset($this->sc_temp_v_actualizar)) {$_SESSION['v_actualizar'] = $this->sc_temp_v_actualizar;}
$_SESSION['scriptcase']['grid_producto_v2']['contr_erro'] = 'off';
}
function buscar_orden()
{
$_SESSION['scriptcase']['grid_producto_v2']['contr_erro'] = 'on';
if (!isset($_SESSION['v_unidad_factor'])) {$_SESSION['v_unidad_factor'] = "";}
if (!isset($this->sc_temp_v_unidad_factor)) {$this->sc_temp_v_unidad_factor = (isset($_SESSION['v_unidad_factor'])) ? $_SESSION['v_unidad_factor'] : "";}
if (!isset($_SESSION['v_factor'])) {$_SESSION['v_factor'] = "";}
if (!isset($this->sc_temp_v_factor)) {$this->sc_temp_v_factor = (isset($_SESSION['v_factor'])) ? $_SESSION['v_factor'] : "";}
if (!isset($_SESSION['v_unidad'])) {$_SESSION['v_unidad'] = "";}
if (!isset($this->sc_temp_v_unidad)) {$this->sc_temp_v_unidad = (isset($_SESSION['v_unidad'])) ? $_SESSION['v_unidad'] : "";}
if (!isset($_SESSION['v_ordenproducto'])) {$_SESSION['v_ordenproducto'] = "";}
if (!isset($this->sc_temp_v_ordenproducto)) {$this->sc_temp_v_ordenproducto = (isset($_SESSION['v_ordenproducto'])) ? $_SESSION['v_ordenproducto'] : "";}
     
$check_sql = "SELECT orden, unidad, factor, unidad_factor "
   . " FROM producto"
   . " WHERE orden = " . $this->orden ;
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rs[0][0]))     
{
    $this->sc_temp_v_ordenproducto = $this->rs[0][0];
	$this->sc_temp_v_unidad = $this->rs[0][1];
	$this->sc_temp_v_factor = $this->rs[0][2];
	$this->sc_temp_v_unidad_factor = $this->rs[0][3];
}
		else     
{
	$this->sc_temp_v_ordenproducto = 0;
	$this->sc_temp_v_unidad = 0;
	$this->sc_temp_v_factor = 0;
	$this->sc_temp_v_unidad_factor = 0;
}
if (isset($this->sc_temp_v_ordenproducto)) {$_SESSION['v_ordenproducto'] = $this->sc_temp_v_ordenproducto;}
if (isset($this->sc_temp_v_unidad)) {$_SESSION['v_unidad'] = $this->sc_temp_v_unidad;}
if (isset($this->sc_temp_v_factor)) {$_SESSION['v_factor'] = $this->sc_temp_v_factor;}
if (isset($this->sc_temp_v_unidad_factor)) {$_SESSION['v_unidad_factor'] = $this->sc_temp_v_unidad_factor;}
$_SESSION['scriptcase']['grid_producto_v2']['contr_erro'] = 'off';
}
}

?>
