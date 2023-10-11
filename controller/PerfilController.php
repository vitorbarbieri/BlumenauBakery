<?php

class PerfilController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (!$_SESSION['login']) {
            header('location: ' . base_url() . '/login');
        }
    }

    public function perfil()
    {
        $data['page_id'] = 4;
        $data['page_tag'] = "Perfil - Blumenau Bakery";
        $data['page_title'] = "Perfil";
        $data['page_name'] = "Perfil";
        $data['page_functions_js'] = "functionsPerfil.js";
        $this->views->getView($this, "perfil", $data);
    }

    public function atualizarDadosPessoais()
    {
        if ($_POST) {
            $idUsuario = $_SESSION['idUser'];
            $strNome = strClean($_POST['txtNome']);
            $strSobrenome = strClean($_POST['txtSobrenome']);
            $strTelefono = strClean($_POST['txtTelefone']);

            $request_user = $this->model->updatePerfil($idUsuario, $strNome, $strSobrenome, $strTelefono, "", "", "");
            if ($request_user) {
                sessionUser($_SESSION['idUser']);
                $arrResponse = array('status' => true, 'msg' => 'Usuário atualizado com sucesso!');
            } else {
                $arrResponse = array("status" => false, "msg" => 'Erro ao atualizar o usuário!');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function atualizarConfig()
    {
        if ($_POST) {
            $idUsuario = $_SESSION['idUser'];
            $strSenha = strClean($_POST['txtSenha']);
            $intPergunta = intval(strClean($_POST['listPergunta']));
            $strResposta = strClean($_POST['txtResposta']);

            $strSenha = "";
            if (!empty($_POST['txtSenha'])) {
                $strSenha = hash("SHA256", $_POST['txtSenha']);
            }

            $request_user = $this->model->updatePerfil($idUsuario, "", "", "", $strSenha, $intPergunta, $strResposta);
            if ($request_user) {
                sessionUser($_SESSION['idUser']);
                $arrResponse = array('status' => true, 'msg' => 'Usuário atualizado com sucesso!');
            } else {
                $arrResponse = array("status" => false, "msg" => 'Erro ao atualizar o usuário!');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
