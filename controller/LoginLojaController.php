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

    public function registrarCliente()
    {
        if ($_POST) {
            $strNome = ucwords(strClean($_POST['txtNome']));
            $strEmail = strtolower(strClean($_POST['txtEmail']));
            $strEndereco = ucwords(strClean($_POST['txtEndereco']));
            $intNumero = intval($_POST['txtNumero']);
            $strBairro = ucwords(strClean($_POST['txtBairro']));
            $strCidade = ucwords(strClean($_POST['txtCidade']));
            $intEstado = intval($_POST['listEstado']);
            $strCep = strClean($_POST['txtCep']);
            $strDataNascimento = implode("-", array_reverse(explode("/", strClean($_POST['txtDataNascimento'])))); // Salvar no banco de dados (aaaa/mm/dd)
            // $data = implode("/",array_reverse(explode("-",$data))); // Buscar no BD e mostrar na tela (dd/mm/aaaa)
            $intSexo = intval($_POST['listSexo']);
            $strSenha = hash("SHA256", $_POST['txtSenha']);

            $request = $this->model->insertUsuario($strNome, $strEmail, $strEndereco, $intNumero, $strBairro, $strCidade, $intEstado, $strCep, $strDataNascimento, $intSexo, $strSenha);

            $arrData = $request;
            if ($arrData['status'] == 1) {
                $_SESSION['idUser'] = $arrData['id'];
                $_SESSION['loginCliente'] = true;
                sessionCliente($arrData['id']);
                $arrResponse = array('status' => true, 'msg' => "OK");
            } else {
                if ($arrData['status'] == 2) {
                    $arrResponse = array('status' => false, 'msg' => "E-mail ja cadastrado, utilize outro!");
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Erro ao atualizar o usuário');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
