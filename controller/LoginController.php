<?php

class LoginController extends Controller
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header('location: ' . base_url() . '/dashboard');
        }
        
            parent::__construct();
    }

    public function login()
    {
        $data['page_tag'] = "Login - Blumenau Bakery";
        $data['page_title'] = "Blumenau Bakery";
        $data['page_name'] = "Login";
        $data['page_functions_js'] = "functionsLogin.js";
        $this->views->getView($this, "login", $data);
    }

    public function loginUser()
    {
        if ($_POST) {
            $strUsuario = strtolower(strClean($_POST['txtEmail']));
            $strPassword = hash("SHA256", $_POST['txtSenha']);
            $requestUser = $this->model->loginUser($strUsuario, $strPassword);

            if (empty($requestUser)) {
                $arrResponse = array('status' => false, 'msg' => "Dados informados estão incorreta");
            } else {
                $arrData = $requestUser;
                if ($arrData['status'] == 1) {
                    $_SESSION['idUser'] = $arrData['id'];
                    $_SESSION['login'] = true;

                    $arrData = $this->model->SessionLogin($_SESSION['idUser']);
                    $_SESSION['userData'] = $arrData;

                    $arrResponse = array('status' => true, 'msg' => "OK");
                } else {
                    $arrResponse = array('status' => false, 'msg' => "Usuário inativo");
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function resetPass()
    {
        dep($_POST);
        die();
    }
}
