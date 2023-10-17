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

                    $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                    sessionUser($_SESSION['idUser']);

                    $arrResponse = array('status' => true, 'msg' => "OK");
                } else {
                    $arrResponse = array('status' => false, 'msg' => "Usuário inativo");
                }
            }
            sleep(1.5);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    
    public function getUsuarioPergunta($email)
    {
        $strEmail = strClean($email);
        if ($strEmail != "") {
            $arrData = $this->model->selectUsuarioPergunta($strEmail);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Cliente não existe.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            sleep(1.5);
            echo json_encode($arrResponse);
        }
        die();
    }

    public function criarNovaSenha($entrada)
    {
        $params = explode(",", $entrada);
        $intId = intval($params[0]);
        $strResposta = strClean($params[1]);

        if ($strResposta != "") {
            $arrData = $this->model->buscaRespostaUsuario($intId);

            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Cliente não existe.');
            } else { 
                if (strtolower($arrData['resposta']) == strtolower($strResposta)) {
                    $senha = passGenerator();
                    $strSenha = hash("SHA256", $senha);
                    $this->model->setSenha($intId, $strSenha);
                    $arrResponse = array('status' => true, 'senha' => $senha);
                } else {
                    $arrResponse = array('status' => false, 'msg' => "Resposa informada está incorreta");
                }
            }
            echo json_encode($arrResponse);
        }
        die();
    }

    public function loginClient()
    {
        if ($_POST) {
            $strUsuario = strtolower(strClean($_POST['txtEmail']));
            $strPassword = hash("SHA256", $_POST['txtSenha']);
            $requestUser = $this->model->loginClient($strUsuario, $strPassword);

            if (empty($requestUser)) {
                $arrResponse = array('status' => false, 'msg' => "Dados informados estão incorreta");
            } else {
                $arrData = $requestUser;
                if ($arrData['status'] == 1) {
                    $_SESSION['idUser'] = $arrData['id'];
                    $_SESSION['login'] = true;

                    $arrData = $this->model->sessionLoginCliente($_SESSION['idUser']);
                    sessionUser($_SESSION['idUser']);

                    $arrResponse = array('status' => true, 'msg' => "OK");
                } else {
                    $arrResponse = array('status' => false, 'msg' => "Usuário inativo");
                }
            }
            sleep(1.5);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
