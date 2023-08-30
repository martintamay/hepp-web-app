<?php
class grid_red_lookup
{
//  
   function lookup_tipo_red(&$tipo_red) 
   {
      $conteudo = "" ; 
      if ($tipo_red == "0")
      { 
          $conteudo = "Facebook";
      } 
      if ($tipo_red == "1")
      { 
          $conteudo = "Twitter";
      } 
      if ($tipo_red == "2")
      { 
          $conteudo = "Google+";
      } 
      if (!empty($conteudo)) 
      { 
          $tipo_red = $conteudo; 
      } 
   }  
}
?>
