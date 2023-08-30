<?php
class grid_producto_v2_lookup
{
//  
   function lookup_cant(&$conteudo , $orden, $cuenta, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      if (trim($orden) === "")
      { 
          $conteudo = "&nbsp;";
          return ; 
      } 
      $conteudo = "";
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT cantidad + \"-\" + fraccionado FROM pedido WHERE cliente_cuenta = " . $_SESSION['cuenta'] . " and ordenproducto = $orden ORDER BY cantidad" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(cantidad,\"-\",fraccionado) FROM pedido WHERE cliente_cuenta = " . $_SESSION['cuenta'] . " and ordenproducto = $orden ORDER BY cantidad" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT cantidad&\"-\"&fraccionado FROM pedido WHERE cliente_cuenta = " . $_SESSION['cuenta'] . " and ordenproducto = $orden ORDER BY cantidad" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT cantidad||\"-\"||fraccionado FROM pedido WHERE cliente_cuenta = " . $_SESSION['cuenta'] . " and ordenproducto = $orden ORDER BY cantidad" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT cantidad + \"-\" + fraccionado FROM pedido WHERE cliente_cuenta = " . $_SESSION['cuenta'] . " and ordenproducto = $orden ORDER BY cantidad" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT cantidad||\"-\"||fraccionado FROM pedido WHERE cliente_cuenta = " . $_SESSION['cuenta'] . " and ordenproducto = $orden ORDER BY cantidad" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT cantidad||\"-\"||fraccionado FROM pedido WHERE cliente_cuenta = " . $_SESSION['cuenta'] . " and ordenproducto = $orden ORDER BY cantidad" ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          $x = 0; 
          $nm_tmp_campos_select = explode(",", "cantidad,\"-\",fraccionado"); 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 if ($y == 1)
                 { 
                     $conteudo .= "<br>";
                     $y = 0; 
                     $x = 0; 
                 } 
                 $y++; 
                 if ($x != 0)
                 { 
                     $conteudo .= "";
                 } 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $nm_array_retorno_lookup[$a] [trim($nm_tmp_campos_select[$x])] = trim($rx->fields[$x]);
                        $nm_array_retorno_lookup[$a] [$x]= trim($rx->fields[$x]);
                        if ($x != 0)
                        { 
                            $conteudo .= "&nbsp;";
                        } 
                        $conteudo .= trim($rx->fields[$x]);
                 }
                 $a++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
   } 
//  
   function lookup_subtotal(&$conteudo , $orden, $cuenta, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      if (trim($orden) === "")
      { 
          $conteudo = "&nbsp;";
          return ; 
      } 
      $conteudo = "";
      $nm_comando = "SELECT if(isnull(subtotal),0,subtotal)
FROM pedido
WHERE cliente_cuenta = " . $_SESSION['cuenta'] . "
and ordenproducto = $orden" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          $x = 0; 
          $nm_tmp_campos_select = explode(",", "if(isnull(subtotal),0,subtotal)"); 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 if ($y == 1)
                 { 
                     $conteudo .= "<br>";
                     $y = 0; 
                     $x = 0; 
                 } 
                 $y++; 
                 if ($x != 0)
                 { 
                     $conteudo .= "";
                 } 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $nm_array_retorno_lookup[$a] [trim($nm_tmp_campos_select[$x])] = trim($rx->fields[$x]);
                        $nm_array_retorno_lookup[$a] [$x]= trim($rx->fields[$x]);
                        if ($x != 0)
                        { 
                            $conteudo .= "&nbsp;";
                        } 
                        $conteudo .= trim($rx->fields[$x]);
                 }
                 $a++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
   } 
//  
   function lookup_orden_grupo(&$conteudo , $orden_grupo) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $orden_grupo; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($orden_grupo) === "" || trim($orden_grupo) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select DESCRIPCION from grupo where ORDEN = $orden_grupo order by DESCRIPCION" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = trim($rx->fields[0]); 
          } 
          $conteudo = function_exists('mb_strtolower') ? mb_strtolower($conteudo, $_SESSION['scriptcase']['charset']) : strtolower($conteudo);
          $conteudo = ucfirst($conteudo);
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
}
?>
