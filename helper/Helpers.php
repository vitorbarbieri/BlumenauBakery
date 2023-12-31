<?php

// Retornar a URL do projeto
function base_url()
{
    return BASE_URL;
}

// Retorna a URL da pasta  /assets
function media()
{
    return BASE_URL . "/assets";
}

// Exibe o Header
function headerAdmin($data = "")
{
    $view_header = "./view/partials/HeaderAdmin.php";
    require_once($view_header);
}
function headerLoja($data = "")
{
    $view_header = "./view/partials/HeaderLoja.php";
    require_once($view_header);
}

// Exibe o Nav
function navAdmin($data = "")
{
    $view_nav = "./view/partials/NavAdmin.php";
    require_once($view_nav);
}

// Exibe o Footer
function footerAdmin($data = "")
{
    $view_footer = "./view/partials/FooterAdmin.php";
    require_once($view_footer);
}
function footerLoja($data = "")
{
    $view_footer = "./view/partials/FooterLoja.php";
    require_once($view_footer);
}

// Mosta a informação formatada
function dep($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

// Exibe o Modal
function getModal(string $nameModal, $data)
{
    $view_modal = "./view/partials/modals/{$nameModal}.php";
    require_once($view_modal);
}

// Iniciar sessão - Admin
function sessionUser(int $id)
{
    require_once("model/LoginModel.php");
    $objLogin = new LoginModel();
    $request = $objLogin->sessionLogin($id);
    return $request;
}

// Iniciar sessão - Loja
function sessionCliente(int $id)
{
    require_once("model/LoginModel.php");
    $objLogin = new LoginModel();
    $request = $objLogin->sessionLoginCliente($id);
    return $request;
}

// Subir imagem para o projeto (servidor)
function uploadImage(array $data, string $name)
{
    $url_temp = $data['tmp_name'];
    $destino = 'assets/img/uploads/' . $name;
    $move = move_uploaded_file($url_temp, $destino);
    return $move;
}

// Deletar arquivo da pasta "assets/img/uploads"
function deleteFile(string $name)
{
    unlink('assets/img/uploads/' . $name);
}

function getFile(string $url, $data)
{
    ob_start();
    require_once("view/{$url}.php");
    $file = ob_get_clean();
    return $file;
}

// Limpa string
function strClean($strCadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}

// Gera senha de 10 caracteres
function passGenerator($length = 10)
{
    $pass = "";
    $longitudPass = $length;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena = strlen($cadena);

    for ($i = 1; $i <= $longitudPass; $i++) {
        $pos = rand(0, $longitudCadena - 1);
        $pass .= substr($cadena, $pos, 1);
    }
    return $pass;
}

// Gera token
function token()
{
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
    return $token;
}

// Formato para valor monetário
function formatMoney($cantidad)
{
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return SMONEY . " " . $cantidad;
}

function Meses(){
    $meses = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    return $meses;
}