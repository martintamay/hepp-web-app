<?php
    function sc_htmlentities($sString)
    {
        $charset = (isset($_SESSION['scriptcase']['charset_entities'][$_SESSION['scriptcase']['charset']])) ? $_SESSION['scriptcase']['charset_entities'][$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
        $str = htmlentities($sString, ENT_COMPAT, $charset);
        if (!empty($str))
        {
            return $str;
        }
        else
        {
            return $sString;
        }
    }
    function sc_convert_encoding($str_text, $str_encondig_to, $str_encondig_from = "UTF-8", $bol_is_utf8=true)
    {
        $arr_charset_iconv = array('WINDOWS-1250');

        //se o from ou o to for da lista que o mb_convert nao consegue manipular, tenta usar o iconv
        if((in_array($str_encondig_to, $arr_charset_iconv) || in_array($str_encondig_from, $arr_charset_iconv)) && function_exists("iconv"))
        {
            return iconv($str_encondig_from, $str_encondig_to . "//TRANSLIT", $str_text);
        }
        else
        {
            return mb_convert_encoding($str_text, $str_encondig_to, $str_encondig_from);
        }
    }

    function NM_is_utf8($str)
    {
        $c=0; $b=0;
        $bits=0;
        $len=strlen($str);
        for($i=0; $i<$len; $i++){
            $c=ord($str[$i]);
            if($c > 128){
                if(($c >= 254)) return false;
                elseif($c >= 252) $bits=6;
                elseif($c >= 248) $bits=5;
                elseif($c >= 240) $bits=4;
                elseif($c >= 224) $bits=3;
                elseif($c >= 192) $bits=2;
                else return false;
                if(($i+$bits) > $len) return false;
                while($bits > 1){
                    $i++;
                    $b=ord($str[$i]);
                    if($b < 128 || $b > 191) return false;
                    $bits--;
                }
            }
        }
        return true;
    }

    function NM_utf8_strlen($str)
    {
        if (NM_is_utf8($str))
        {
            $c = strlen($str);
            $l = 0;
            for ($i = 0; $i < $c; ++$i)
                if ((ord($str[$i]) & 0xC0) != 0x80)
                    ++$l;
            return $l;
        }
        else
        {
            return strlen($str);
        }
    }

    function NM_utf8_urldecode($str)
    {
        if (is_array($str))
        {
            return $str;
        }
        $aRep = array(
                      '&' => '&amp;',
                      '<' => '&lt;',
                      '>' => '&gt;',
                      '"' => '&quot;',
                      "'" => '&apos;',
                      '+' => '&#44',
                      '�' => '&Aacute;',
                      '�' => '&aacute;',
                      '�' => '&Acirc;',
                      '�' => '&acirc;',
                      '�' => '&Agrave;',
                      '�' => '&agrave;',
                      '�' => '&Aring;',
                      '�' => '&aring;',
                      '�' => '&Atilde;',
                      '�' => '&atilde;',
                      '�' => '&Auml;',
                      '�' => '&auml;',
                      '�' => '&Aelig;',
                      '�' => '&aelig;',
                      '�' => '&Ccedil;',
                      '�' => '&ccedil;',
                      '�' => '&Eacute;',
                      '�' => '&eacute;',
                      '�' => '&Ecirc;',
                      '�' => '&ecirc;',
                      '�' => '&Egrave;',
                      '�' => '&egrave;',
                      '�' => '&Euml;',
                      '�' => '&euml;',
                      '�' => '&Iacute;',
                      '�' => '&iacute;',
                      '�' => '&Icirc;',
                      '�' => '&icirc;',
                      '�' => '&Igrave;',
                      '�' => '&igrave;',
                      '�' => '&Iuml;',
                      '�' => '&iuml;',
                      '�' => '&Ntilde;',
                      '�' => '&ntilde;',
                      '�' => '&Oacute;',
                      '�' => '&oacute;',
                      '�' => '&Ocirc;',
                      '�' => '&ocirc;',
                      '�' => '&Ograve;',
                      '�' => '&ograve;',
                      '�' => '&Otilde;',
                      '�' => '&otilde;',
                      '�' => '&Ouml;',
                      '�' => '&ouml;',
                      '�' => '&Uacute;',
                      '�' => '&uacute;',
                      '�' => '&Ucirc;',
                      '�' => '&ucirc;',
                      '�' => '&Ugrave;',
                      '�' => '&ugrave;',
                      '�' => '&Uuml;',
                      '�' => '&uuml;',
                      '�' => '&uml;',
                      '�' => '&cedil;',
                      '�' => '&acute;',
                      '�' => '&iexcl;',
                      '�' => '&iquest;',
                      '�' => '&middot;',
                      '�' => '&euro;',
                      '�' => '&cent;',
                      '�' => '&pound;',
                      '�' => '&curren;',
                      '�' => '&yen;',
                      '�' => '&sect;',
                      '�' => '&copy;',
                      '�' => '&reg;',
                      '�' => '&deg;',
                      '�' => '&ordf;',
                      '�' => '&ordm;',
                      '�' => '&sup1;',
                      '�' => '&sup2;',
                      '�' => '&sup3;',
                      '�' => '&frac14;',
                      '�' => '&frac12;',
                      '�' => '&frac34;',
                      '�' => '&laquo;',
                      '�' => '&raquo;',
                      '�' => '&not;',
                      '�' => '&plusmn;',
                      '�' => '&micro;',
                      '�' => '&para;',
                      ' ' => '&nbsp;',
                      '�' => '%u201C',
                      '�' => '%u201D',
                      '�' => '%u2018',
                      '�' => '%u2019',
                     );
        $str = str_replace(array_values($aRep), array_keys($aRep), $str);
        if (isset($_SESSION['scriptcase']['charset']) && 'UTF-8' == $_SESSION['scriptcase']['charset'])
        {
            $str = sc_convert_encoding($str, 'UTF-8', $_SESSION['scriptcase']['charset']);
        }
        $str = str_replace('+', '__SC_PLUS__', $str);
        $str = preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str));
        $str = str_replace('__SC_PLUS__', '+', $str);
        if (isset($_SESSION['scriptcase']['charset']) && 'BIG-5' == $_SESSION['scriptcase']['charset'])
        {
            $str = @html_entity_decode($str, null, 'BIG5');
        }
        else
        {
            $str = @html_entity_decode($str, null, $_SESSION['scriptcase']['charset']);
        }
        $str = NM_charset_decode($str);
        return NM_unprotect_chars($str);
    }

    function NM_charset_to_utf8($str)
    {
        if ('UTF-8' != $_SESSION['scriptcase']['charset'])
        {
            $str = sc_convert_encoding($str, 'UTF-8', $_SESSION['scriptcase']['charset']);
        }
        return $str;
    }

    function NM_unprotect_chars($str)
    {
        return str_replace(
            array(
                '__NM_PLUS__',
                '__NM_PERC__',
            ),
            array(
                '+',
                '%',
            ),
            $str);
    }

    function NM_charset_decode($str)
    {
        if ('UTF-8' != $_SESSION['scriptcase']['charset'])
        {
            $str = sc_convert_encoding($str, 'UTF-8', $_SESSION['scriptcase']['charset']);
            $str = @html_entity_decode($str, null, 'UTF-8');
            $str = sc_convert_encoding($str, $_SESSION['scriptcase']['charset'], 'UTF-8');
        }
        return $str;
    }

    function NM_utf8_decode($str)
    {
        if (NM_is_utf8($str))
        {
            $str = utf8_decode($str);
        }
        return $str;
    }

    function NM_encode_input($str)
    {
        $aRep = array(
                      '&#059;' => ';',
                      '&lt;' => '<',
                      '&gt;' => '>',
                      '&quot;' => '"',
                      '&#039;' => "'",
                      '&#040;' => '(',
                      '&#041;' => ')',
                     );
        $str = str_replace('<br>', '__SC_BREAK_LINE__', $str);
        $str = str_replace('<br />', '__SC_BREAK_LINE__', $str);
        $str = str_replace('&nbsp;', '__SC_SPACE_CHAR__', $str);
        $str = str_replace('&', '__SC_AMP_CHAR__', $str);
        $str = str_replace(array_values($aRep), array_keys($aRep), $str);
        $str = str_replace('__SC_AMP_CHAR__', '&amp;', $str);
        $str = str_replace('__SC_BREAK_LINE__', '<br />', $str);
        $str = str_replace('__SC_SPACE_CHAR__', '&nbsp;', $str);
        return $str;
    }

        function NM_encode_input_js($str)
        {
                $aRep = array(
                                 "\'" => "'",
                                );
                $str = str_replace(array_values($aRep), array_keys($aRep), $str);
                return $str;
        }

    function NM_decode_input($str)
    {
        $aRep = array(
                      '&'   => '&amp;',
                      '<'   => '&lt;',
                      '>'   => '&gt;',
                      '"'  => '&quot;',
                      "'" => '&apos;',
                      "'" => '&#039;',
                     );
        $str = str_replace(array_values($aRep), array_keys($aRep), $str);
        return $str;
    }

   function NM_protect_string($sString)
   {
      $sString = (string) $sString;

      if (!empty($sString))
      {
         if (function_exists('NM_is_utf8') && NM_is_utf8($sString))
         {
             return $sString;
         }
         else
         {
             return htmlentities($sString, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         }
      }
      elseif ('0' === $sString || 0 === $sString)
      {
         return '0';
      }
      else
      {
         return '';
      }
   }
   function NM_conv_charset($val, $charset_new, $charset_old)
   {
       if (is_array($val))
       {
           $temp = array();
           foreach ($val as $ind => $new)
           {
               $ind = NM_conv_charset($ind, $charset_new, $charset_old);
               $temp[$ind] = NM_conv_charset($new, $charset_new, $charset_old);
           }
           return $temp;
       }
       else
       {
           return sc_convert_encoding($val, $charset_new, $charset_old);
       }
   }
?>