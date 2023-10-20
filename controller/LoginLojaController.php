<?php

class LoginLojaController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function loginLoja()
    {
        $data['page_tag'] = "Login - Blumenau Bakery";
        $data['page_title'] = "Login";
        $data['page_name'] = "login";
        $data['page_functions_js'] = "functionsLoginLoja.js";
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
                    $_SESSION['loginCliente'] = true;
                    sessionCliente($arrData['id']);

                    $arrResponse = array('status' => true, 'msg' => "OK");
                } else {
                    $arrResponse = array('status' => false, 'msg' => "Usuário inativo");
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
