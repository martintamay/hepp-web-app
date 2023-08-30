<?php

class grid_pedido_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function grid_pedido_total($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("es");
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_pedido']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_pedido']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->idpedido = $Busca_temp['idpedido']; 
          $tmp_pos = strpos($this->idpedido, "##@@");
          if ($tmp_pos !== false)
          {
              $this->idpedido = substr($this->idpedido, 0, $tmp_pos);
          }
          $idpedido_2 = $Busca_temp['idpedido_input_2']; 
          $this->idpedido_2 = $Busca_temp['idpedido_input_2']; 
          $this->cliente_cuenta = $Busca_temp['cliente_cuenta']; 
          $tmp_pos = strpos($this->cliente_cuenta, "##@@");
          if ($tmp_pos !== false)
          {
              $this->cliente_cuenta = substr($this->cliente_cuenta, 0, $tmp_pos);
          }
          $cliente_cuenta_2 = $Busca_temp['cliente_cuenta_input_2']; 
          $this->cliente_cuenta_2 = $Busca_temp['cliente_cuenta_input_2']; 
          $this->cantidad = $Busca_temp['cantidad']; 
          $tmp_pos = strpos($this->cantidad, "##@@");
          if ($tmp_pos !== false)
          {
              $this->cantidad = substr($this->cantidad, 0, $tmp_pos);
          }
          $cantidad_2 = $Busca_temp['cantidad_input_2']; 
          $this->cantidad_2 = $Busca_temp['cantidad_input_2']; 
          $this->fraccionado = $Busca_temp['fraccionado']; 
          $tmp_pos = strpos($this->fraccionado, "##@@");
          if ($tmp_pos !== false)
          {
              $this->fraccionado = substr($this->fraccionado, 0, $tmp_pos);
          }
          $fraccionado_2 = $Busca_temp['fraccionado_input_2']; 
          $this->fraccionado_2 = $Busca_temp['fraccionado_input_2']; 
      } 
   }

   //---- 
   function quebra_geral()
   {
      global $nada, $nm_lang , $ordenproducto;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), sum(subtotal) as sum_subtotal from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), sum(subtotal) as sum_subtotal from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['tot_geral'][2] = $rt->fields[1]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pedido']['contr_total_geral'] = "OK";
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
function enviar_correo()
{
$_SESSION['scriptcase']['grid_pedido']['contr_erro'] = 'on';
if (!isset($_SESSION['razonsocial'])) {$_SESSION['razonsocial'] = "";}
if (!isset($this->sc_temp_razonsocial)) {$this->sc_temp_razonsocial = (isset($_SESSION['razonsocial'])) ? $_SESSION['razonsocial'] : "";}
if (!isset($_SESSION['cuenta'])) {$_SESSION['cuenta'] = "";}
if (!isset($this->sc_temp_cuenta)) {$this->sc_temp_cuenta = (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta'] : "";}
     
$v_texto="";

$check_sql = "SELECT correo "
    . " FROM correos ";
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs2 = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs2[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs2 = false;
          $this->rs2_erro = $this->Db->ErrorMsg();
      } 
;

$check_sql = "SELECT producto.codigo, pedido.cantidad, pedido.fraccionado,"
	."producto.descripcion, pedido.precio, pedido.subtotal, curdate(), curtime() "
    . " FROM pedido LEFT JOIN producto "
	. " ON pedido.ordenproducto = producto.orden "
    . " WHERE cliente_cuenta = '" . $this->sc_temp_cuenta . "'";
 
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

$v_fecha = $this->rs[0][6];
$v_hora = $this->rs[0][7];
$v_texto = "<p><u><b>PEDIDO VÍA WEB Fecha: ".$v_fecha." Hora: ".$v_hora."</b></u></p>"
."<p><u><b>Cliente: ".$this->sc_temp_cuenta."-".$this->sc_temp_razonsocial."</b></u></p>"
."</p>"
."<table border='1' width='100%'>"
."<tr>"
."<td>"."Codigo"."</td>"	
."<td>"."Cantidad"."</td>"
."<td>"."Fraccionado"."</td>"
."<td>"."Producto"."</td>"
."<td>"."Unitario"."</td>"
."<td>"."Subtotal"."</tr>";
if (isset($this->rs[0][0]))     
{
 	$v_total = 0;
    for ($x=0;$x<sizeof($this->rs);$x++)
	{
  		$v_texto = $v_texto."<tr>"
   		."<td>".$this->rs[$x][0]."</td>"
   		."<td>".$this->rs[$x][1]."</td>"
   		."<td>".$this->rs[$x][2]."</td>"
   		."<td>".$this->rs[$x][3]."</td>"
   		."<td>".$this->rs[$x][4]."</td>"
   		."<td>".$this->rs[$x][5]."</td>"."</tr>";
   		$v_total = $v_total + $this->rs[$x][5];
	}
   	$v_texto = $v_texto."<tr>"
   	."<td>"."TOTAL:"."</td>"
   	."<td>".""."</td>"
   	."<td>".""."</td>"
   	."<td>".""."</td>"
   	."<td>".""."</td>"
   	."<td>".$v_total."</td>"."</tr>"
   	."</table>"
   	."</p>";
}
else     
{
}
if (isset($this->rs2[0][0]))     
{
	for ($x=0;$x<sizeof($this->rs2);$x++)
	{
        $correo = "info@tamaysistemas.com";
        
        $mail_smtp_server = 'mail.tamaysistemas.com';
        $mail_smtp_user   = 'arapy@tamaysistemas.com';
        $mail_smtp_pass   = 'cmta71';
        $mail_from        = 'arapy@tamaysistemas.com';
        $mail_to          = $this->rs2[$x][0];
        $mail_subject     = 'Pedido web:'.$this->sc_temp_razonsocial;
        $mail_message     = $v_texto;
        $mail_format      = 'H';
        $mail_copyes	  = '';
        $mail_copyes_type = '';
        $mail_port		  = '26';
        
            include_once($this->Ini->path_third . "/swift/swift_required.php");
    $sc_mail_port     = "$mail_port";
    $sc_mail_tp_port  = "N";
    $sc_mail_tp_mens  = "$mail_format";
    $sc_mail_tp_copy  = "$mail_copyes_type";
    $this->sc_mail_count = 0;
    $this->sc_mail_erro  = "";
    $this->sc_mail_ok    = true;
    if ($sc_mail_tp_port == "S" || $sc_mail_tp_port == "Y")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($mail_smtp_server, $sc_mail_port, 'ssl');
    }
    elseif ($sc_mail_tp_port == "T")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 587;
        $Con_Mail = Swift_SmtpTransport::newInstance($mail_smtp_server, $sc_mail_port, 'tls');
    }
    else
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance($mail_smtp_server, $sc_mail_port);
    }
    $Con_Mail->setUsername($mail_smtp_user);
    $Con_Mail->setpassword($mail_smtp_pass);
    $Send_Mail = Swift_Mailer::newInstance($Con_Mail);
    if ($sc_mail_tp_mens == "H")
    {
        $Mens_Mail = Swift_Message::newInstance($mail_subject)->setBody($mail_message)->setContentType("text/html");
    }
    else
    {
        $Mens_Mail = Swift_Message::newInstance($mail_subject)->setBody($mail_message);
    }
    if (!empty($_SESSION['scriptcase']['charset']))
    {
        $Mens_Mail->setCharset($_SESSION['scriptcase']['charset']);
    }
    $Temp_mail = $mail_to;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $mail_to);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            $Mens_Mail->addTo($Arr_addr[0], $Arr_addr[1]);
        }
    }
    $Temp_mail = $mail_copyes;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $mail_copyes);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            if (strtoupper(substr($sc_mail_tp_copy, 0, 2)) == "CC")
            {
                $Mens_Mail->addCc($Arr_addr[0], $Arr_addr[1]);
            }
            else
            {
                $Mens_Mail->addBcc($Arr_addr[0], $Arr_addr[1]);
            }
        }
    }
    $Arr_addr = SC_Mail_Address($mail_from);
    $this->sc_mail_count = $Send_Mail->send($Mens_Mail->setFrom($Arr_addr[0], $Arr_addr[1]), $Err_mail);
    if (!empty($Err_mail))
    {
        $this->sc_mail_erro = $Err_mail;
        $this->sc_mail_ok   = false;
    }
;

        if ($this->sc_mail_ok )
        {
            $this->nm_mens_alert[] = "Fue enviado un correo con los datos de su registro..presione
	        el botón volver para ingresar con su usuario y contraseña..!!";}
        else
		{	
            
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "No se pudo enviar el correo";
;
            
        }
	}
}
if (isset($this->sc_temp_cuenta)) {$_SESSION['cuenta'] = $this->sc_temp_cuenta;}
if (isset($this->sc_temp_razonsocial)) {$_SESSION['razonsocial'] = $this->sc_temp_razonsocial;}
$_SESSION['scriptcase']['grid_pedido']['contr_erro'] = 'off';
}
function enviar_pedido()
{
$_SESSION['scriptcase']['grid_pedido']['contr_erro'] = 'on';
if (!isset($_SESSION['cuenta'])) {$_SESSION['cuenta'] = "";}
if (!isset($this->sc_temp_cuenta)) {$this->sc_temp_cuenta = (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta'] : "";}
     

     $nm_select = "CALL cargar_pedido('".$this->sc_temp_cuenta."')"; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;
if (isset($this->sc_temp_cuenta)) {$_SESSION['cuenta'] = $this->sc_temp_cuenta;}
$_SESSION['scriptcase']['grid_pedido']['contr_erro'] = 'off';
}
}

?>
