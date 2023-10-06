<?php

class UsuarioController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (!$_SESSION['login']) {
            header('location: ' . base_url() . '/login');
        }
    }

    public function usuario()
    {
        if($_SESSION['userData']['idCargo'] != 1){
            header("Location:".base_url().'/cliente');
        }

        $data['page_id'] = 2;
        $data['page_tag'] = "Usuário - Blumenau Bakery";
        $data['page_title'] = "Usuários";
        $data['page_name'] = "usuario";
        $data['page_functions_js'] = "functionsUsuario.js";
        $this->views->getView($this, "usuario", $data);
    }

    public function getUsuarios()
    {
        $arrData = $this->model->selectUsuarios();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Ativo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inativo</span>';
            }

            $arrData[$i]['opcao'] = '
            <div class="text-center">
                <button class="btn btn-secondary btn-sm" onClick="verUsuario(' . $arrData[$i]['id'] . ')" title="Permissão" type="button">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <button class="btn btn-primary btn-sm" onClick="editarUsuario(' . $arrData[$i]['id'] . ')" title="Editar" type="button">
                    <i class="fa-solid fa-pencil"></i>
                </button>
                <button class="btn btn-danger btn-sm" onClick="deletarUsuario(' . $arrData[$i]['id'] . ')" title="Eliminar" type="button">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getUsuario($id)
    {
        $intId = intval(strClean($id));

        if ($intId > 0) {
            $arrData = $this->model->selectUsuario($intId);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => "Usuário não existe");
            } else {
                $arrData['data_criacao'] = date("d/m/Y", strtotime($arrData['data_criacao']));
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setUsuario($id)
    {
        if ($_POST) {
            $intId = intval(strClean($_POST['idUsuario']));
            $strNome = ucwords(strClean($_POST['txtNome']));
            $strSobrenome = ucwords(strClean($_POST['txtSobrenome']));
            $strTelefone = strClean($_POST['txtTelefone']);
            $strEmail = strtolower(strClean($_POST['txtEmail']));
            $intCargo = intval(strClean($_POST['listCargo']));
            $intStatus = intval(strClean($_POST['listStatus']));
            $dateCadastro = date('Y-m-d H:i:s',);
            $intPergunta = intval(strClean($_POST['listPergunta']));
            $strResposta = strClean($_POST['txtResposta']);
            
            $strCpf = "";
            if (isset($_POST['txtCpf'])) {
                $strCpf = strClean($_POST['txtCpf']);
            }

            $strSenha = "";
            if ($_POST['txtSenha'] != "") {
                $strSenha = hash("SHA256", $_POST['txtSenha']);
            }

            if ($intId == 0) {
                $request = $this->model->insertUsuario($strCpf, $strNome, $strSobrenome, $strTelefone, $strEmail, $intCargo, $intStatus, $strSenha, $dateCadastro, $intPergunta, $strResposta);
                $option = 1;
            } else {
                $request = $this->model->updateUsuario($intId, $strNome, $strSobrenome, $strTelefone, $strEmail, $intCargo, $intStatus, $strSenha, $intPergunta, $strResposta);
                $option = 2;
            }

            if ($request == 1) {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Usuário salvo com sucesso');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Usuário atualizado com sucesso');
                }
            } else {
                if ($request == 2) {
                    $arrResponse = array('status' => false, 'msg' => 'Atenção, CPF já está sendo utilizado');
                } else {
                    if ($option == 1) {
                        $arrResponse = array('status' => false, 'msg' => 'Erro ao salvar o usuário');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'Erro ao atualizar o usuário');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delUsuario($id)
    {
        $intId = intval(strClean($_POST['id']));

        $request = $this->model->deleteUsuario($intId);

        if ($request == 1) {
            $arrResponse = array('status' => true, 'msg' => 'Usuário excluído com sucesso');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Erro ao excluir o usuário');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getSelectPerguntas()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectPerguntas();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                if ($arrData[$i]['id'] ==  $_SESSION['userData']['id_pergunta']) {
                    $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '" selected>' . $arrData[$i]['pergunta'] . '</option>';
                } else {
                    $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '">' . $arrData[$i]['pergunta'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
}
