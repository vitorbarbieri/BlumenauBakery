window.addEventListener('load', function () {
    carregarPerguntasSecretas();
}, false);

function carregarPerguntasSecretas() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuario/getSelectPerguntas';
    // Abrir requisição ao servidor
    request.open("GET", ajaxUrl, true);
    // Enviar requisição ao servidor
    request.send();
    // Obter o reseultado da requisição AJAX
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listPergunta').innerHTML += request.responseText;
            // document.querySelector('#listPergunta').value += 0;
            // $('#listPergunta').selectpicker('render');
            // $('#listPergunta').selectpicker('refresh');
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Salvar Fomrulário Perfil Dados Pessoais
    if (document.querySelector("#formPerfil")) {
        var formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function (e) {
            e.preventDefault();

            $camposOk = true;
            validaCampos(".valid");
            if (!$camposOk) {
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Todos os campos são obrigatórios!',
                    didClose: () => {
                        $("#txtCpf").select();
                    }
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Perfil/atualizarDadosPessoais';
            var formData = new FormData(formPerfil);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;

                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        Swal.fire({
                            icon: 'success',
                            title: 'Atenção',
                            text: objData.msg
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true);
                            }
                        });
                    } else {
                        $('#txtIdentificacao').select();
                        swal.fire("Erro", objData.msg, "error");
                    }
                }
            }
        }
    }

    // Salvar Fomrulário Perfil Configurações
    if (document.querySelector("#formPerfilConfig")) {
        var formPerfilConfig = document.querySelector("#formPerfilConfig");
        formPerfilConfig.onsubmit = function (e) {
            e.preventDefault();

            $camposOk = true;
            validaCampos(".validConfig");
            if (!$camposOk) {
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Todos os campos são obrigatórios!',
                    didClose: () => {
                        $("#txtSenha").select();
                    }
                });
                return false;
            }

            var senhaOK = validaSenha();
            if (!senhaOK) {
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Perfil/atualizarConfig';
            var formData = new FormData(formPerfilConfig);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;

                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        Swal.fire({
                            icon: 'success',
                            title: 'Atenção',
                            text: objData.msg
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true);
                            }
                        });
                    } else {
                        $('#txtIdentificacao').select();
                        swal.fire("Erro", objData.msg, "error");
                    }
                }
            }
        }
    }
}, false);

function openModalPerfil() {
    removeClass();
    $("#modalFormPerfil").modal("show");
}

function modalFormPerfilConfig() {
    removeClass();
    $("#modalFormPerfilConfig").modal("show");
}

function cancelar() {
    removeClass(".valid");
    
    document.querySelector("#formPerfil").reset();
    $("#modalFormPerfil").modal("hide");
}

function cancelar2() {
    removeClass(".valid");
    ocultarSenha();

    document.querySelector("#formPerfilConfig").reset();
    $("#modalFormPerfilConfig").modal("hide");
}