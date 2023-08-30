<?php
include_once('menu_web_session.php');
session_start();
$tmp_useragent                           = $_SERVER['HTTP_USER_AGENT'];
$_SESSION['scriptcase']['device_mobile'] = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$tmp_useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($tmp_useragent,0,4));
if ($_SESSION['scriptcase']['device_mobile'])
{
    if (!isset($_SESSION['scriptcase']['display_mobile']))
    {
        $_SESSION['scriptcase']['display_mobile'] = true;
    }
    if ($_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'out' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = false;
    }
    elseif (!$_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'in' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = true;
    }
}
else
{
    $_SESSION['scriptcase']['display_mobile'] = false;
}
    $_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'] = "";
    $_SESSION['scriptcase']['menu_web']['glo_nm_perfil']    = "";
    $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] = "";

ob_start();

class menu_web_class
{
  var $Db;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function menu_web_menu()
 {
    global $menu_web_menuData;
     if (isset($_POST["nmgp_idioma"]))  
     { 
         $Temp_lang = explode(";" , $_POST["nmgp_idioma"]);  
         if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
          { 
             $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
         } 
         if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
         { 
             $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
         } 
     } 
   
     if (isset($_POST["nmgp_schema"]))  
     { 
         $_SESSION['scriptcase']['str_schema_all'] = $_POST["nmgp_schema"] . "/" . $_POST["nmgp_schema"];
     } 
   
           $nm_versao_sc  = "" ; 
           $_SESSION['scriptcase']['menu_web']['contr_erro'] = 'off';
           $Campos_Mens_erro = "";
           $sc_site_ssl   = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? true : false;
           $NM_dir_atual = getcwd();
           if (empty($NM_dir_atual))
           {
               $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
               $str_path_sys          = str_replace("\\", '/', $str_path_sys);
           }
           else
           {
               $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
               $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
           }
      //check publication with the prod
      $str_path_apl_url = $_SERVER['PHP_SELF'];
      $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
      $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
      $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
      //check prod
      if(empty($_SESSION['scriptcase']['menu_web']['glo_nm_path_prod']))
      {
              /*check prod*/$_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
      }
$this->sc_charset['UTF-8'] = 'utf-8';
$this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
$this->sc_charset['SJIS'] = 'shift-jis';
$this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
$this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
$this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
$this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
$this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
$this->sc_charset['WINDOWS-1250'] = 'windows-1250';
$this->sc_charset['WINDOWS-1252'] = 'windows-1252';
$this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
$this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
$this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
$this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
$this->sc_charset['KOI8-R'] = 'koi8-r';
$this->sc_charset['WINDOWS-1251'] = 'windows-1251';
$this->sc_charset['BIG-5'] = 'big5';
$this->sc_charset['EUC-CN'] = 'EUC-CN';
$this->sc_charset['EUC-JP'] = 'euc-jp';
$this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
$this->sc_charset['EUC-KR'] = 'euc-kr';
$this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
$this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
$this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
$this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
$this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
$str_path_web   = $_SERVER['PHP_SELF'];
$str_path_web   = str_replace("\\", '/', $str_path_web);
$str_path_web   = str_replace('//', '/', $str_path_web);
$str_root       = substr($str_path_sys, 0, -1 * strlen($str_path_web));
$path_link      = substr($str_path_web, 0, strrpos($str_path_web, '/'));
$path_link      = substr($path_link, 0, strrpos($path_link, '/')) . '/';
$path_btn       = $str_root . $path_link . "_lib/buttons/";
$path_imag_cab  = $path_link . "_lib/img";
$this->force_mobile = false;
$this->path_botoes    = '../_lib/img';
$this->path_imag_apl  = $str_root . $path_link . "_lib/img";
$path_help      = $path_link . "_lib/webhelp/";
$path_libs      = $str_root . $_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "menu_web/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$this->url_css = "../_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$menu_mobile_hide          = 'N';
$menu_mobile_inicial_state = 'escondido';
$menu_mobile_hide_onclick  = 'S';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$menu_mobile_hide_icon_menu_position     = 'right';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'aberto';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'N';
$mobile_menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide_icon_menu_position     = 'right';

$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
 if(function_exists('set_php_timezone')) set_php_timezone('menu_web');
if (isset($_SESSION['scriptcase']['user_logout']))
{
    foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
    {
        if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
        {
            unset($_SESSION['scriptcase']['user_logout'][$ind]);
            $nm_apl_dest = $parms['R'];
            $dir = explode("/", $nm_apl_dest);
            if (count($dir) == 1)
            {
                $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                $nm_apl_dest = $path_link . SC_dir_app_name($nm_apl_dest) . "/";
            }
?>
            <html>
            <body>
            <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
            </form>
            <script>
             document.FRedirect.submit();
            </script>
            </body>
            </html>
<?php
            exit;
        }
    }
}
if (!defined("SC_ERROR_HANDLER"))
{
    define("SC_ERROR_HANDLER", 1);
    include_once(dirname(__FILE__) . "/menu_web_erro.php");
}
include_once(dirname(__FILE__) . "/menu_web_erro.class.php"); 
$this->Erro = new menu_web_erro();
$str_path = substr($_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['menu_web']['glo_nm_conexao']);
}

/* Definiciones de las rutas */
$menu_web_menuData         = array();
$menu_web_menuData['path'] = array();
$menu_web_menuData['url']  = array();
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $menu_web_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $menu_web_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $menu_web_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $menu_web_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$menu_web_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$menu_web_menuData['url']['web']   = str_replace("\\", '/', $menu_web_menuData['url']['web']);
$menu_web_menuData['path']['root'] = substr($menu_web_menuData['path']['sys'],  0, -1 * strlen($menu_web_menuData['url']['web']));
$menu_web_menuData['path']['app']  = substr($menu_web_menuData['path']['sys'],  0, strrpos($menu_web_menuData['path']['sys'],  '/'));
$menu_web_menuData['path']['link'] = substr($menu_web_menuData['path']['app'],  0, strrpos($menu_web_menuData['path']['app'],  '/'));
$menu_web_menuData['path']['link'] = substr($menu_web_menuData['path']['link'], 0, strrpos($menu_web_menuData['path']['link'], '/')) . '/';
$menu_web_menuData['path']['app'] .= '/';
$menu_web_menuData['url']['app']   = substr($menu_web_menuData['url']['web'],  0, strrpos($menu_web_menuData['url']['web'],  '/'));
$menu_web_menuData['url']['link']  = substr($menu_web_menuData['url']['app'],  0, strrpos($menu_web_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] == "S")
{
    $menu_web_menuData['url']['link']  = substr($menu_web_menuData['url']['link'], 0, strrpos($menu_web_menuData['url']['link'], '/'));
}
$menu_web_menuData['url']['link']  .= '/';
$menu_web_menuData['url']['app']   .= '/';

$nm_img_fun_menu = ""; 
if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
{
    $_SESSION['scriptcase']['str_lang'] = "es";
}
if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
{
    $_SESSION['scriptcase']['str_conf_reg'] = "es_es";
}
$this->str_lang        = $_SESSION['scriptcase']['str_lang'];
$this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
if (!function_exists("NM_is_utf8"))
{
   include_once("../_lib/lib/php/nm_utf8.php");
}
if (!function_exists("SC_dir_app_ini"))
{
    include_once("../_lib/lib/php/nm_ctrl_app_name.php");
}
SC_dir_app_ini('hepp');
if ($_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] == "S")
{
    $path_apls     = substr($path_apls, 0, strrpos($path_apls, '/'));
}
$path_apls     .= "/";
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_Turquoise/Sc8_Turquoise";
include("../_lib/lang/". $this->str_lang .".lang.php");
include("../_lib/css/" . $this->str_schema_all . "_menuH.php");
if(isset($pagina_schemamenu) && !empty($pagina_schemamenu) && is_file("../_lib/menuicons/". $pagina_schemamenu .".php"))
{
    include("../_lib/menuicons/". $pagina_schemamenu .".php");
}
$this->img_sep_toolbar = trim($str_toolbar_separator);
include("../_lib/lang/config_region.php");
include("../_lib/lang/lang_config_region.php");
$this->regionalDefault();
$Str_btn_menu = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
$Str_btn_css  = trim($str_button) . "/" . trim($str_button) . ".css";
include($path_btn . $Str_btn_menu);
if (!function_exists("nmButtonOutput"))
{
   include_once("../_lib/lib/php/nm_gp_config_btn.php");
}
asort($this->Nm_lang_conf_region);
$this->sc_Include($path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
$this->sc_Include($path_lib_php . "/nm_functions.php", "", "") ; 
$this->nm_data = new nm_data("es");
include_once("menu_web_toolbar.php");

$this->tab_grupo[0] = "hepp/";
if ($_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

     $_SESSION['scriptcase']['menu_atual'] = "menu_web";
     $_SESSION['scriptcase']['menu_apls']['menu_web'] = array();
     if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
     {
         foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
         {
             if (isset($_SESSION['scriptcase']['menu_web']['glo_nm_conexao']) && $_SESSION['scriptcase']['menu_web']['glo_nm_conexao'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menu_web']['glo_nm_conexao'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menu_web']['glo_nm_perfil']) && $_SESSION['scriptcase']['menu_web']['glo_nm_perfil'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menu_web']['glo_nm_perfil'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menu_web']['glo_con_' . $NM_con_orig]))
             {
                 $_SESSION['scriptcase']['menu_web']['glo_con_' . $NM_con_orig] = $NM_con_dest;
             }
         }
     }
$_SESSION['scriptcase']['charset'] = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-15";
ini_set('default_charset', $_SESSION['scriptcase']['charset']);
$_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
{
    if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
    {
        $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
    }
}
foreach ($this->Nm_lang as $ind => $dados)
{
    if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
    {
        $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
        $this->Nm_lang[$ind] = $dados;
    }
    if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
    {
        $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
    }
}
if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
{
    $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
}
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
if (is_dir($path_img_old))
{
    $Res_dir_img = @opendir($path_img_old);
    if ($Res_dir_img)
    {
        while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
        {
           $Str_arquivo = "/" . $Str_arquivo;
           if (@is_file($path_img_old . $Str_arquivo) && '.' != $Str_arquivo && '..' != $path_img_old . $Str_arquivo)
           {
               @unlink($path_img_old . $Str_arquivo);
           }
        }
    }
    @closedir($Res_dir_img);
    rmdir($path_img_old);
}
//
if (isset($_GET) && !empty($_GET))
{
    foreach ($_GET as $nmgp_var => $nmgp_val)
    {
         $$nmgp_var           = $nmgp_val;
    }
}
if (isset($_POST) && !empty($_POST))
{
    foreach ($_POST as $nmgp_var => $nmgp_val)
    {
         $$nmgp_var           = $nmgp_val;
    }
}
if (isset($script_case_init))
{
    $_SESSION['sc_session'][1]['menu_web']['init'] = $script_case_init;
}
else
if (!isset($_SESSION['sc_session'][1]['menu_web']['init']))
{
    $_SESSION['sc_session'][1]['menu_web']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['menu_web']['init'];
if (isset($nmgp_parms) && !empty($nmgp_parms)) 
{ 
    $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
    $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
    $todo = explode("?@?", $nmgp_parms);
    $ix = 0;
    while (!empty($todo[$ix]))
    {
       $cadapar = explode("?#?", $todo[$ix]);
       $$cadapar[0] = $cadapar[1];
       $_SESSION[$cadapar[0]] = $cadapar[1];
       $ix++;
     }
} 
$nm_url_saida = "";
if (isset($nmgp_url_saida))
{
    $nm_url_saida = $nmgp_url_saida;
    if (isset($script_case_init))
    {
        $nm_url_saida .= "?script_case_init=" . NM_encode_input($script_case_init) . "&script_case_session=" . session_id();
    }
}
if (isset($_POST["nmgp_idioma"]) || isset($_POST["nmgp_schema"]))  
{ 
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_menu_web'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_menu_web'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_menu_web'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
}
$this->sc_Include($path_libs . "/nm_ini_lib.php", "F", "nm_dir_normaliza") ; 
/* Dados do menu em sessao */
$_SESSION['nm_menu'] = array('prod' => $str_root . $_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'] . '/third/COOLjsMenu/',
                              'url' => $_SESSION['scriptcase']['menu_web']['glo_nm_path_prod'] . '/third/COOLjsMenu/');

if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'menu_web'))
{
    $_SESSION['sc_session'][1]['menu_web']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_menu_web'] = "javascript:window.close()";
}
/* MenÃº de configuraciÃ³n de las variables */
$menu_web_menuData['iframe'] = TRUE;

if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("form_parametros") . "/form_parametros_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_parametros']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['form_parametros'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['form_parametros'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("form_parametros") . "/form_parametros_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_parametros']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['form_parametros'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['form_parametros'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_publicacion") . "/grid_publicacion_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_publicacion']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_publicacion'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_publicacion'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_pag") . "/grid_pag_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pag']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_pag'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_pag'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_correos") . "/grid_correos_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_correos']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_correos'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_correos'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("form_usuario") . "/form_usuario_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_usuario']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['form_usuario'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['form_usuario'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_funcionarios") . "/grid_funcionarios_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_funcionarios']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_funcionarios'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_funcionarios'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_producto_web") . "/grid_producto_web_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_producto_web']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_producto_web'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_producto_web'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("grid_red") . "/grid_red_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_red']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_red'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_red'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("form_producto_modificar") . "/form_producto_modificar_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_producto_modificar']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['form_producto_modificar'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['form_producto_modificar'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("control_web") . "/control_web_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_web']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['control_web'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['control_web'] = "on";
} 
/* Elementos de menÃº */

$sOutputBuffer = ob_get_contents();
ob_end_clean();

 $nm_var_lab[0] = "Parámetros";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[0]))
{
    $nm_var_lab[0] = sc_convert_encoding($nm_var_lab[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[1] = "Publicaciones";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[1]))
{
    $nm_var_lab[1] = sc_convert_encoding($nm_var_lab[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[2] = "Páginas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[2]))
{
    $nm_var_lab[2] = sc_convert_encoding($nm_var_lab[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[3] = "Correos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[3]))
{
    $nm_var_lab[3] = sc_convert_encoding($nm_var_lab[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[4] = "Usuario";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[4]))
{
    $nm_var_lab[4] = sc_convert_encoding($nm_var_lab[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[5] = "Listados";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[5]))
{
    $nm_var_lab[5] = sc_convert_encoding($nm_var_lab[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[6] = "Funcionarios";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[6]))
{
    $nm_var_lab[6] = sc_convert_encoding($nm_var_lab[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[7] = "Productos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[7]))
{
    $nm_var_lab[7] = sc_convert_encoding($nm_var_lab[7], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[8] = "Redes Sociales";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[8]))
{
    $nm_var_lab[8] = sc_convert_encoding($nm_var_lab[8], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[9] = "Productos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[9]))
{
    $nm_var_lab[9] = sc_convert_encoding($nm_var_lab[9], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[10] = "Cerrar Sesión";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[10]))
{
    $nm_var_lab[10] = sc_convert_encoding($nm_var_lab[10], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[0] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[0]))
{
    $nm_var_hint[0] = sc_convert_encoding($nm_var_hint[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[1] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[1]))
{
    $nm_var_hint[1] = sc_convert_encoding($nm_var_hint[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[2] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[2]))
{
    $nm_var_hint[2] = sc_convert_encoding($nm_var_hint[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[3] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[3]))
{
    $nm_var_hint[3] = sc_convert_encoding($nm_var_hint[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[4] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[4]))
{
    $nm_var_hint[4] = sc_convert_encoding($nm_var_hint[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[5] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[5]))
{
    $nm_var_hint[5] = sc_convert_encoding($nm_var_hint[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[6] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[6]))
{
    $nm_var_hint[6] = sc_convert_encoding($nm_var_hint[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[7] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[7]))
{
    $nm_var_hint[7] = sc_convert_encoding($nm_var_hint[7], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[8] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[8]))
{
    $nm_var_hint[8] = sc_convert_encoding($nm_var_hint[8], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[9] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[9]))
{
    $nm_var_hint[9] = sc_convert_encoding($nm_var_hint[9], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[10] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[10]))
{
    $nm_var_hint[10] = sc_convert_encoding($nm_var_hint[10], $_SESSION['scriptcase']['charset'], "UTF-8");
}
$saida_apl = $_SESSION['scriptcase']['sc_saida_menu_web'];
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_parametros']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_parametros']) == "on")
{
    $menu_web_menuData['data'] .= "item_1|.|" . $nm_var_lab[0] . "|menu_web_form_php.php?sc_item_menu=item_1&sc_apl_menu=form_parametros&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[0] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_1|.|" . $nm_var_lab[0] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_publicacion']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_publicacion']) == "on")
{
    $menu_web_menuData['data'] .= "item_2|.|" . $nm_var_lab[1] . "|menu_web_form_php.php?sc_item_menu=item_2&sc_apl_menu=grid_publicacion&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[1] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_2|.|" . $nm_var_lab[1] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pag']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pag']) == "on")
{
    $menu_web_menuData['data'] .= "item_5|.|" . $nm_var_lab[2] . "|menu_web_form_php.php?sc_item_menu=item_5&sc_apl_menu=grid_pag&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[2] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_5|.|" . $nm_var_lab[2] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_correos']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_correos']) == "on")
{
    $menu_web_menuData['data'] .= "item_6|.|" . $nm_var_lab[3] . "|menu_web_form_php.php?sc_item_menu=item_6&sc_apl_menu=grid_correos&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[3] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_6|.|" . $nm_var_lab[3] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_usuario']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_usuario']) == "on")
{
    $menu_web_menuData['data'] .= "item_4|.|" . $nm_var_lab[4] . "|menu_web_form_php.php?sc_item_menu=item_4&sc_apl_menu=form_usuario&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[4] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_4|.|" . $nm_var_lab[4] . "||||_self|disabled\n";
}
$menu_web_menuData['data'] .= "item_10|.|" . $nm_var_lab[5] . "||" . $nm_var_hint[5] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_funcionarios']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_funcionarios']) == "on")
{
    $menu_web_menuData['data'] .= "item_8|..|" . $nm_var_lab[6] . "|menu_web_form_php.php?sc_item_menu=item_8&sc_apl_menu=grid_funcionarios&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[6] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_8|..|" . $nm_var_lab[6] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_producto_web']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_producto_web']) == "on")
{
    $menu_web_menuData['data'] .= "item_9|..|" . $nm_var_lab[7] . "|menu_web_form_php.php?sc_item_menu=item_9&sc_apl_menu=grid_producto_web&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[7] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_9|..|" . $nm_var_lab[7] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_red']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_red']) == "on")
{
    $menu_web_menuData['data'] .= "item_3|..|" . $nm_var_lab[8] . "|menu_web_form_php.php?sc_item_menu=item_3&sc_apl_menu=grid_red&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[8] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_3|..|" . $nm_var_lab[8] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_producto_modificar']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_producto_modificar']) == "on")
{
    $menu_web_menuData['data'] .= "item_11|.|" . $nm_var_lab[9] . "|menu_web_form_php.php?sc_item_menu=item_11&sc_apl_menu=form_producto_modificar&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[9] . "||" . $this->menu_web_target('_self') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_11|.|" . $nm_var_lab[9] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_web']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_web']) == "on")
{
    $menu_web_menuData['data'] .= "item_7|.|" . $nm_var_lab[10] . "|menu_web_form_php.php?sc_item_menu=item_7&sc_apl_menu=control_web&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[10] . "||" . $this->menu_web_target('_parent') . "|" . "\n";
}
else
{
    $menu_web_menuData['data'] .= "item_7|.|" . $nm_var_lab[10] . "||||_parent|disabled\n";
}

$menu_web_menuData['data'] = array();
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_parametros']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_parametros']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[0] . "",
        'level'    => "0",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_1&sc_apl_menu=form_parametros&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[0] . "",
        'id'       => "item_1",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_1",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_publicacion']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_publicacion']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[1] . "",
        'level'    => "0",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_2&sc_apl_menu=grid_publicacion&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[1] . "",
        'id'       => "item_2",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_2",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pag']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pag']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[2] . "",
        'level'    => "0",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_5&sc_apl_menu=grid_pag&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[2] . "",
        'id'       => "item_5",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_5",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_correos']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_correos']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[3] . "",
        'level'    => "0",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_6&sc_apl_menu=grid_correos&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[3] . "",
        'id'       => "item_6",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_6",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_usuario']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_usuario']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[4] . "",
        'level'    => "0",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_4&sc_apl_menu=form_usuario&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[4] . "",
        'id'       => "item_4",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_4",
        'disabled' => "N",
    );
}
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$menu_web_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[5] . "",
    'level'    => "0",
    'link'     => "#",
    'hint'     => "" . $nm_var_hint[5] . "",
    'id'       => "item_10",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_10",
    'disabled' => "N",
);
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_funcionarios']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_funcionarios']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[6] . "",
        'level'    => "1",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_8&sc_apl_menu=grid_funcionarios&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[6] . "",
        'id'       => "item_8",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_8",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_producto_web']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_producto_web']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[7] . "",
        'level'    => "1",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_9&sc_apl_menu=grid_producto_web&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[7] . "",
        'id'       => "item_9",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_9",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_red']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_red']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[8] . "",
        'level'    => "1",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_3&sc_apl_menu=grid_red&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[8] . "",
        'id'       => "item_3",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_3",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_producto_modificar']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_producto_modificar']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[9] . "",
        'level'    => "0",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_11&sc_apl_menu=form_producto_modificar&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[9] . "",
        'id'       => "item_11",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_self') . "\"",
        'sc_id'    => "item_11",
        'disabled' => "N",
    );
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_web']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_web']) == "on")
{
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $menu_web_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[10] . "",
        'level'    => "0",
        'link'     => "menu_web_form_php.php?sc_item_menu=item_7&sc_apl_menu=control_web&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "",
        'hint'     => "" . $nm_var_hint[10] . "",
        'id'       => "item_7",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menu_web_target('_parent') . "\"",
        'sc_id'    => "item_7",
        'disabled' => "N",
    );
}

if (isset($_SESSION['scriptcase']['sc_def_menu']['menu_web']))
{
    $arr_menu_usu = $this->nm_arr_menu_recursiv($_SESSION['scriptcase']['sc_def_menu']['menu_web']);
    $this->nm_gera_menus($str_menu_usu, $arr_menu_usu, 1, 'menu_web');
    $menu_web_menuData['data'] = $str_menu_usu;
}
if (is_file("menu_web_help.txt"))
{
    $Arq_WebHelp = file("menu_web_help.txt"); 
    if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
    {
        $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
        $Tmp = explode(";", $Arq_WebHelp[0]); 
        foreach ($Tmp as $Cada_help)
        {
            $Tmp1 = explode(":", $Cada_help); 
            if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "menu" && is_file($str_root . $path_help . $Tmp1[1]))
            {
                $str_icon = "";
                $icon_aba = "";
                $icon_aba_inactive = "";
                if(empty($icon_aba) && isset($arr_menuicons['']['active']))
                {
                    $icon_aba = $arr_menuicons['']['active'];
                }
                if(empty($icon_aba_inactive) && isset($arr_menuicons['']['inactive']))
                {
                    $icon_aba_inactive = $arr_menuicons['']['inactive'];
                }
                $menu_web_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => "" . $path_help . $Tmp1[1] . "",
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->menu_web_target('_blank') . "",
                    'sc_id'    => "item_Help",
                    'disabled' => "N",
                );
            }
        }
    }
}

if (isset($_SESSION['scriptcase']['sc_menu_del']['menu_web']) && !empty($_SESSION['scriptcase']['sc_menu_del']['menu_web']))
{
    $nivel = 0;
    $exclui_menu = false;
    foreach ($menu_web_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_del']['menu_web']))
       {
          $nivel = $cada_menu['level'];
          $exclui_menu = true;
          unset($menu_web_menuData['data'][$i_menu]);
       }
       elseif ( empty($cada_menu) || ($exclui_menu && $nivel < $cada_menu['level']))
       {
          unset($menu_web_menuData['data'][$i_menu]);
       }
       else
       {
          $exclui_menu = false;
       }
    }
    $Temp_menu = array();
    foreach ($menu_web_menuData['data'] as $i_menu => $cada_menu)
    {
        $Temp_menu[] = $cada_menu;
    }
    $menu_web_menuData['data'] = $Temp_menu;
}

if (isset($_SESSION['scriptcase']['sc_menu_disable']['menu_web']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['menu_web']))
{
    $disable_menu = false;
    foreach ($menu_web_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_disable']['menu_web']))
       {
          $nivel = $cada_menu['level'];
          $disable_menu = true;
          $menu_web_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu) && $disable_menu && $nivel < $cada_menu['level'])
       { 
          $menu_web_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu))
       {
          $disable_menu = false;
       }
    }
}

/* Cabecera HTML */
if ($menu_web_menuData['iframe'])
{
    $menu_web_menuData['height'] = '100%';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> style="height: 100%">
<head>
 <title>Hepp - Configuración Web</title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <?php
 if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
  ?>
   <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' />
  <?php
 }
 ?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_btngrp.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_btngrp.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_btngrp.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_menuH.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_menuH.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $Str_btn_css ?>" /> 
<link rel="stylesheet" type="text/css" href="../_lib/css/_menuTheme/scriptcase_Gleam_DarkBlue_hor_<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir']; ?>.css<?php if (@is_file($this->path_css . '_menuTheme/' . scriptcase_Gleam_DarkBlue . '_' . hor . '.css')) { echo '?scp=' . md5($this->path_css . '_menuTheme/' . scriptcase_Gleam_DarkBlue . '_' . hor . '.css'); } ?>" />
<style>
   .scTabText {
   }</style>
</head>
<body style="height: 100%" scroll="no" class='scMenuHPage'>
<?php

if ('' != $sOutputBuffer)
{
    echo $sOutputBuffer;
}

    $NM_scr_iframe = (isset($_POST['hid_scr_iframe'])) ? $_POST['hid_scr_iframe'] : "";   
}
else
{
    $menu_web_menuData['height'] = '30px';
}

/* Archivos JS */
?>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menu_web']['glo_nm_path_prod']; ?>/third/jquery/js/jquery.js"></script>
<?php
$Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
$Lim   = strlen($Str_date);
$Ult   = "";
$Arr_D = array();
for ($I = 0; $I < $Lim; $I++)
{
    $Char = substr($Str_date, $I, 1);
    if ($Char != $Ult)
    {
        $Arr_D[] = $Char;
    }
    $Ult = $Char;
}
$Prim = true;
$Str  = "";
foreach ($Arr_D as $Cada_d)
{
    $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
    $Str .= $Cada_d;
    $Prim = false;
}
$Str = str_replace("a", "Y", $Str);
$Str = str_replace("y", "Y", $Str);
$nm_data_fixa = date($Str); 
?>
<?php
$larg_table = "100%";
$col_span   = "";
$strAlign = 'align=\'left\'';
?>
<?php
$str_bmenu = nmButtonOutput($this->arr_buttons, "bmenu", "showMenu();", "showMenu();", "bmenu", "", "" . $this->Nm_lang['lang_btns_menu'] . "", "position:absolute; top:0px; left:0px; z-index:9999;", "absmiddle", "", "0px", $this->path_botoes, "", "" . $this->Nm_lang['lang_btns_menu_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "");
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
    $menu_mobile_hide          = $mobile_menu_mobile_hide;
    $menu_mobile_inicial_state = $mobile_menu_mobile_inicial_state;
    $menu_mobile_hide_onclick  = $mobile_menu_mobile_hide_onclick;
    $menutree_mobile_float     = $mobile_menutree_mobile_float;
    $menu_mobile_hide_icon     = $mobile_menu_mobile_hide_icon;
    $menu_mobile_hide_icon_menu_position     = $mobile_menu_mobile_hide_icon_menu_position;
}
if($menu_mobile_hide == 'S')
{
    if($menu_mobile_inicial_state =='escondido')
    {
            $str_menu_display="hide";
            $str_btn_display="show";
    }
    else
    {
        $str_menu_display="show";
        $str_btn_display="hide";
    }
    if($menu_mobile_hide_icon != 'S')
    {
        $str_btn_display="show";
    }
?>
<script>
    $( document ).ready(function() {
        $('#bmenu').<?php echo $str_btn_display; ?>();
        $('#idMenuCell').<?php echo $str_menu_display; ?>();
        <?php
        if($menutree_mobile_float != 'S')
        {
        ?>
            $('#id_toolbar').<?php echo $str_menu_display; ?>();
        <?php
        }
        ?>
        if($('.scMenuHHeader').length)
        {
                  $(".scMenuHHeader").css("padding-left", $('#bmenu').outerWidth());
        }
        else if($('.scMenuToolbar').length)
        {
                  $(".scMenuToolbar").css("padding-left", $('#bmenu').outerWidth());
        }
        <?php
                if($menutree_mobile_float == 'S')
                {
                ?>
                    str_html_menu = $('#idMenuCell').html();
                    $('#idMenuCell').remove()
                    $( 'body' ).prepend( "<div id='idMenuCell' style='position:absolute; top:0px; left:0px;display:<?php echo (($menu_mobile_inicial_state =='escondido')?'none':''); ?>'>"+ str_html_menu +"</div>" );
              <?php
              if($menu_mobile_hide_icon != 'S')
              {
                  if($menu_mobile_hide_icon_menu_position == 'right')
                  {
                          ?>
                          $('#idMenuCell').css('left', $('#bmenu').outerWidth());
                          <?php
                      }
                  else
                  {
                          ?>
                          $('#idMenuCell').css('top', $('#bmenu').outerHeight());
                          <?php
                      }
              }
                }
        ?>
    });
    function showMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').hide();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
                $('#id_toolbar').fadeToggle();
      <?php
      }
      ?>
    }
    function HideMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').show();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
                $('#id_toolbar').fadeToggle();
      <?php
      }
      ?>
    }
</script>
<?php
echo $str_bmenu;
}
?>
<script>
Iframe_atual = "menu_web_iframe";
function openMenuItem(str_id)
{
    str_link   = $('#' + str_id).attr('item-href');
    str_target = $('#' + str_id).attr('item-target');
    str_id = str_id.replace('iframe_menu_web', 'menu_web');
    //test link type
    if (str_link != '' && str_link != '#')
    {
        if (str_link.substring(0, 11) == 'javascript:')
        {
            eval(str_link.substring(11));
        }
        else if (str_link != '#' && str_target != '_parent')
        {
            window.open(str_link, str_target);
        }
        else if (str_link != '#' && str_target == '_parent')
        {
            document.location = str_link;
        }
        <?php
        if ($menu_mobile_hide == 'S' && $menu_mobile_hide_onclick == 'S')
        {
        ?>
            HideMenu();
        <?php
        }
        ?>
    }
}
</script>
<table <?php echo $strAlign; ?> style="border-collapse: collapse; border-width: 0px; height: 100%; width: <?php echo $larg_table; ?>" cellpadding=0 cellspacing=0>
  <tr class="scMenuHTableCssAlt" id='idMenuLine'>
      <td <?php echo $strAlign; ?> valign="top" class="scMenuLine" style="width:100%; height:30;padding: 0px;" id='idMenuCell'>
<div id="scScrollFix" style="height: 1px"></div>
<script type="text/javascript">
function fnScrollFix() {
 var txt = document.getElementById("scScrollFix").innerHTML;
 if ("&nbsp;" == txt) { txt = "&nbsp;&nbsp;"; } else { txt = "&nbsp;"; }
 document.getElementById("scScrollFix").innerHTML = txt;
 setTimeout("fnScrollFix()", 500);
}
setTimeout("fnScrollFix()", 500);
</script>
<div id="idDivMenu">
<?php
echo $this->menu_web_escreveMenu($menu_web_menuData['data']);
?>
</div>
<?php
/* Control de iframe */
if ($menu_web_menuData['iframe'])
{
?>
    </td>
  </tr>
<?php echo $this->nm_show_toolbarmenu('', $saida_apl, $menu_web_menuData, $path_imag_cab); ?><?php echo $this->nm_gera_degrade(1, $bg_line_degrade, $path_imag_cab); ?>  <tr>
    <td style="border-width: 1px; height: 100%; padding: 0px">
<?php
$link_default = "";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_parametros']) && $_SESSION['scriptcase']['sc_apl_seg']['form_parametros'] == "on") 
{ 
    $SCR  = "";
    $link_default = " onclick=\"openMenuItem('iframe_menu_web');\" item-href=\"menu_web_form_php.php?sc_item_menu=menu_web&sc_apl_menu=form_parametros&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . "\"  item-target=\"menu_web_iframe\"";
} 
else
{ 
    $SCR  = ($NM_scr_iframe != "" ? $NM_scr_iframe : "menu_web_pag_ini.php");
} 
?>
      <iframe id="iframe_menu_web" name="menu_web_iframe" frameborder="0" class="scMenuIframe"  src="<?php echo $SCR; ?>" <?php echo $link_default ?>></iframe>
<?php
}
?></td>
  </tr>
</table>
</body>
</html>
<?php

if (isset($link_default) && !empty($link_default))
{
    echo "<script>";
    echo "   document.getElementById('iframe_menu_web').click()";
    echo "</script>";
}

}

/* Control de Target */
function menu_web_escreveMenu($arr_menu)
{
    $last      = '';
    $itemClass = ' topfirst';
    $subSize   = 2;
    $subCount  = array();
    $tabSpace  = 1;
    $intMult   = 2;
    $aMenuItemList = array();
    foreach ($arr_menu as $ind => $resto)
    {
        $aMenuItemList[] = $resto;
    }
?>
<ul id="css3menu1" class="topmenu">
<?php
    for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
        if (0 == $aMenuItemList[$i]['level']) {
            $last = $aMenuItemList[$i]['id'];
        }
    }
    for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
        if ($last == $aMenuItemList[$i]['id']) {
            $itemClass = ' toplast';
        }
        $htmlClass = '';
        if (0 == $aMenuItemList[$i]['level']) {
            $htmlClass = ' class="topmenu' . $itemClass;
            if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
                $htmlClass .= ' toproot';
            }
            $htmlClass .= '"';
        }
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><li<?php echo $htmlClass; ?>>
<?php
        $tabSpace++;
        if ('' != $aMenuItemList[$i]['icon'] && file_exists($this->path_imag_apl . "/" . $aMenuItemList[$i]['icon'])) {
            $iconHtml = '<img src="../_lib/img/' . $aMenuItemList[$i]['icon'] . '" border="0" />';
        }
        else {
            $iconHtml = '';
        }
        $sDisabledClass = '';
        if ('Y' == $aMenuItemList[$i]['disabled']) {
            $aMenuItemList[$i]['link']   = '#';
            $aMenuItemList[$i]['target'] = '';
            $sDisabledClass               = 0 == $aMenuItemList[$i]['level'] ? ' class="scdisabledmain"' : ' class="scdisabledsub"';
        }
        if (empty($aMenuItemList[$i]['link'])) {
            $aMenuItemList[$i]['link']   = '#';
        }
        if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><a href="#" onclick="openMenuItem('<?php echo $aMenuItemList[$i]['id']; ?>');" item-href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>" <?php echo $aMenuItemList[$i]['target']; ?> <?php echo $sDisabledClass; ?>><span><?php echo $iconHtml . $aMenuItemList[$i]['label']; ?></span></a>
<?php
            if (0 != $subSize && 0 < $aMenuItemList[$i + 1]['level']) {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--div class="submenu" abre-->
<?php
                $tabSpace++;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--div class="column" abre-->
<?php
                $tabSpace++;
            }
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><ul>
<?php
            $tabSpace++;
        }
        else {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><a href="#" onclick="openMenuItem('<?php echo $aMenuItemList[$i]['id']; ?>');" item-href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>"<?php echo $aMenuItemList[$i]['target'] . $sDisabledClass; ?>><?php echo $iconHtml . $aMenuItemList[$i]['label']; ?></a>
<?php
        }
        if (($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == $aMenuItemList[$i + 1]['level']) || 
            ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) ||
            (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) ||
            (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == 0)) {
            $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
            if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                if (!isset($subCount[ $aMenuItemList[$i]['level'] ])) {
                    $subCount[ $aMenuItemList[$i]['level'] ] = 0;
                }
                $subCount[ $aMenuItemList[$i]['level'] ]++;
            }
            if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) {
                for ($j = 0; $j < $aMenuItemList[$i]['level'] - $aMenuItemList[$i + 1]['level']; $j++) {
                    unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></ul>
<?php
                    if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="column" fecha-->
<?php
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="submenu" fecha-->
<?php
                    }
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
                }
            }
            elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) {
                for ($j = 0; $j < $aMenuItemList[$i]['level']; $j++) {
                    unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></ul>
<?php
                    if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="column" fecha-->
<?php
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="submenu" fecha-->
<?php
                    }
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
                }
            }
            if ($subSize == $subCount[ $aMenuItemList[$i]['level'] ]) {
                $subCount[ $aMenuItemList[$i]['level'] ] = 0;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--quebra-->
<?php
            }
        }
        $itemClass = '';
    }
?>
</ul>
<?php
}
function menu_web_target($str_target)
{
    global $menu_web_menuData;
    if ('_blank' == $str_target)
    {
        return '_blank';
    }
    elseif ('_parent' == $str_target)
    {
        return '_parent';
    }
    elseif ($menu_web_menuData['iframe'])
    {
        return 'menu_web_iframe';
    }
    else
    {
        return $str_target;
    }
}

function nm_show_toolbarmenu($col_span, $saida_apl, $menu_web_menuData, $path_imag_cab)
{
}

   function nm_prot_aspas($str_item)
   {
       return str_replace('"', '\"', $str_item);
   }

   function nm_gera_menus(&$str_line_ret, $arr_menu_usu, $int_level, $nome_aplicacao)
   {
       global $menu_web_menuData; 
       foreach ($arr_menu_usu as $arr_item)
       {
           $str_line   = array();
           $str_line['label']    = $this->nm_prot_aspas($arr_item['label']);
           $str_line['level']    = $int_level - 1;
           $str_line['link']     = "";
           $nome_apl = $arr_item['link'];
           $pos = strrpos($nome_apl, "/");
           if ($pos !== false)
           {
               $nome_apl = substr($nome_apl, $pos + 1);
           }
           if ('' != $arr_item['link'])
           {
               if ($arr_item['target'] == '_parent')
               {
                    $str_line['link'] = "menu_web_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . ""; 
               }
               else
               {
                    $str_line['link'] = "menu_web_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menu_web_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menu_web']['glo_nm_usa_grupo'] . ""; 
               }
           }
           elseif ($arr_item['target'] == '_parent')
           {
           }
           $str_line['hint']     = ('' != $arr_item['hint']) ? $this->nm_prot_aspas($arr_item['hint']) : '';
           $str_line['id']       = $arr_item['id'];
           $str_line['icon']     = ('' != $arr_item['icon_on']) ? $arr_item['icon_on'] : '';
           $str_line['icon_aba'] = (isset($arr_item['icon_aba']) && '' != $arr_item['icon_aba']) ? $arr_item['icon_aba'] : '';
           $str_line['icon_aba_inactive'] = (isset($arr_item['icon_aba_inactive']) && '' != $arr_item['icon_aba_inactive']) ? $arr_item['icon_aba_inactive'] : '';
           if ('' == $arr_item['link'] && $arr_item['target'] == '_parent')
           {
               $str_line['target'] = '_parent';
           }
           else
           {
                $str_line['target'] = ('' != $arr_item['target'] && '' != $arr_item['link']) ?  $this->menu_web_target( $arr_item['target']) : "_self"; 
           }
           $str_line['target']   = ' item-target="' . $str_line['target']  . '" ';
           $str_line['sc_id']    = $arr_item['id'];
           $str_line['disabled'] = "N";
           $str_line_ret[] = $str_line;
           if (!empty($arr_item['menu_itens']))
           {
               $this->nm_gera_menus($str_line_ret, $arr_item['menu_itens'], $int_level + 1, $nome_aplicacao);
           }
       }
   }

   function nm_arr_menu_recursiv($arr, $id_pai = '')
   {
         $arr_return = array();
         foreach ($arr as $id_menu => $arr_menu)
         {
             if ($id_pai == $arr_menu['pai']) 
             {
                 $arr_return[] = array('label'      => $arr_menu['label'],
                                        'link'       => $arr_menu['link'],
                                        'target'     => $arr_menu['target'],
                                        'icon_on'    => $arr_menu['icon'],
                                        'icon_aba'   => $arr_menu['icon_aba'],
                                        'icon_aba_inactive'   => $arr_menu['icon_aba_inactive'],
                                        'hint'       => $arr_menu['hint'],
                                        'id'         => $id_menu,
                                        'menu_itens' => $this->nm_arr_menu_recursiv($arr, $id_menu));
             }
         }
         return $arr_return;
   }
   //1 horizontal
   //2 vertical
   function nm_gera_degrade($menu_opc, $bg_line_degrade, $path_imag_cab)
   {
       $str_retorno = "";
       //have bg color degrade
       if(!empty($bg_line_degrade) && count($bg_line_degrade)>0)
       {
           if($menu_opc == 1)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<tr style=\"height:1px; padding: 0px;\">\r\n";
                       $str_retorno .= "  <td style=\"height:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\"><img src='". $path_imag_cab ."/transparent.png' border=\"0\" style=\"height:1px;\"></td>\r\n";
                       $str_retorno .= "</tr>\r\n";
                   }
               }
           }
           elseif($menu_opc == 2)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<td style=\"width:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\">\r\n";
                       $str_retorno .= "<img src='" . $path_imag_cab . "/transparent.png' border=\"0\" style=\"width:1px;\">\r\n";
                       $str_retorno .= "</td>\r\n";
                   }
               }
           }
       }
       return $str_retorno;
   }
   function Gera_sc_init($apl_menu)
   {
        $_SESSION['scriptcase']['menu_web']['sc_init'][$apl_menu] = 1;
        return  1;
   }
   function regionalDefault()
   {
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "ddmmyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['html_dir']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
       $_SESSION['scriptcase']['reg_conf']['css_dir']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "LTR";
       $_SESSION['scriptcase']['reg_conf']['html_dir_only'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
   }

}
if ((isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang") || (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "force_lang"))
{
    if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang")
    {
        $nmgp_opcao  = $_POST['nmgp_opcao'];
        $nmgp_idioma = $_POST['nmgp_idioma'];
    }
    else
    {
        $nmgp_opcao  = $_GET['nmgp_opcao'];
        $nmgp_idioma = $_GET['nmgp_idioma'];
    }
    $Temp_lang = explode(";" , $nmgp_idioma);
    if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))
    {
        $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
    }
    if (isset($Temp_lang[1]) && !empty($Temp_lang[1]))
    {
        $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
    }
}
$contr_menu_web = new menu_web_class;
$contr_menu_web->menu_web_menu();

?>
