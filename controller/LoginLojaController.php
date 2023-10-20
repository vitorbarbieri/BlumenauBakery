<?php

class LoginLojaController extends Controller
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION['loginCliente'])) {
            header('location: ' . base_url());
        }

        parent::__construct();
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

    public function criarConta()
    {
        $data['page_tag'] = "Registrar - Blumenau Bakery";
        $data['page_title'] = "Registrar";
        $data['page_name'] = "registrar";
        $data['page_functions_js'] = "functionsLoginLoja.js";
        $this->views->getView($this, "registrar", $data);
    }
}
