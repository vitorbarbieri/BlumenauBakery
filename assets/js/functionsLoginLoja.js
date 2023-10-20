document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector("#formLogin")) {
        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function (e) {
            e.preventDefault();

            email = document.querySelector("#txtEmail").value;
            senha = document.querySelector("#txtSenha").value;

            if (email == "" || senha == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Todos os campos são obrigatórios!',
                    didClose: () => {
                        $("#txtEmail").select();
                    }
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/LoginLoja/loginUser';
            var formData = new FormData(formLogin);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) {
                    return
                }
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        window.location = base_url;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Atenção',
                            text: objData.msg,
                            didClose: () => {
                                $("#txtEmail").select();
                            }
                        });
                        document.querySelector("#txtEmail").value = "";
                        document.querySelector("#txtSenha").value = "";
                    }
                } else {
                    swal.fire("Atenção", "Erro ao validar usuário", "error");
                }
            }
        }
    }

    if (document.querySelector("#formRegister")) {
        let formRegister = document.querySelector("#formRegister");
        formRegister.onsubmit = function (e) {
            e.preventDefault();

            nome = document.querySelector("#txtNome").value;
            email = document.querySelector("#txtEmail").value;
            endereco = document.querySelector("#txtEndereco").value;
            numero = document.querySelector("#txtNumero").value;
            bairro = document.querySelector("#txtBairro").value;
            cidade = document.querySelector("#txtCidade").value;
            estado = parseInt(document.querySelector("#listEstado").value);
            cep = document.querySelector("#txtCep").value;
            dataNascimento = document.querySelector("#txtDataNascimento").value;
            sexo = parseInt(document.querySelector("#listSexo").value);
            senha = document.querySelector("#txtSenha").value;
            senhaConfirma = document.querySelector("#txtSenhaConf").value;

            if (nome == "" || email == "" || endereco == "" || numero == "" || bairro == "" || cidade == "" || estado == 0 || cep == "" || dataNascimento == "" || sexo == 0 || senha == "" || senhaConfirma == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Todos os campos são obrigatórios!',
                    didClose: () => {
                        $("#txtNome").select();
                    }
                });
                return false;
            }

            if (senha != senhaConfirma) {
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Senhas não são iguais!',
                    didClose: () => {
                        $("#txtSenha").select();
                    }
                });
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/LoginLoja/registrarCliente';
            var formData = new FormData(formRegister);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) {
                    return
                }
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        window.location = base_url;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Atenção',
                            text: objData.msg,
                            didClose: () => {
                                $("#txtNome").select();
                            }
                        });
                    }
                } else {
                    swal.fire("Atenção", "Erro ao validar usuário", "error");
                }
            }
        }
    }
}, false);