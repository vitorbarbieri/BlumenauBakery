// Login Page Flipbox control
$('.login-content [data-toggle="flip"]').click(function () {
    $('.login-box').toggleClass('flipped');
    return false;
});

document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector("#formLogin")) {
        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function (e) {
            e.preventDefault();

            $camposOk = true;
            validaCamposLogin();
            if (!$camposOk) {
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
            var ajaxUrl = base_url + '/Login/loginUser';
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
                        window.location = base_url + "/dashboard";
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
                        $('#txtEmail').select();
                    }
                } else {
                    swal.fire("Atenção", "Erro ao validar usuário", "error");
                }
            }
        }
    }

    if (document.querySelector("#formRecetPass")) {
        let formRecetPass = document.querySelector("#formRecetPass");
        formRecetPass.onsubmit = function (e) {
            e.preventDefault();

            let strEmail = document.querySelector("#txtEmailReset").value;
            if (strEmail == "") {
                document.getElementById("txtEmail").classList.add("is-invalid");
                swal.fire("Atenção", "O campo e-mail é obrigatório", "error");
                return false;
            } else {
                document.getElementById("txtEmail").classList.remove("is-invalid");
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Login/resetPass';
            var formData = new FormData(formRecetPass);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) {
                    return
                }
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        document.querySelector("#idUsuario").value = objData.data.id;
                        document.querySelector("#txtCpf").value = objData.data.cpf;
                        document.querySelector("#txtDataCriacao").value = objData.data.data_criacao;
                        document.querySelector("#txtNome").value = objData.data.nome;
                        document.querySelector("#txtSobrenome").value = objData.data.sobrenome;
                        document.querySelector("#txtTelefone").value = objData.data.telefone;
                        document.querySelector("#txtEmail").value = objData.data.email;
                        document.querySelector("#listCargo").value = objData.data.cId;
                        document.querySelector("#listStatus").value = objData.data.status;
                        $('#modalResetLogin').modal('show');
                    } else {
                        swal.fire("Atenção", objData.msg, "error");
                    }
                } else {
                    swal("Atenção", "Erro no processo", "error");
                }
                return false;
            }
        }
    }
}, false);

function validaCamposLogin() {
    $(".validLogin").each(function () {
        if ($(this).val() == "" || $(this).val() == 0) {
            $(this).addClass("is-invalid");
            $camposOk = false;
        }
    });
}
