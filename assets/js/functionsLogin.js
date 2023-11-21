// Login Page Flipbox control
$('.login-content [data-toggle="flip"]').click(function () {
    document.getElementById("txtEmail").classList.remove("is-invalid");
    document.getElementById("txtSenha").classList.remove("is-invalid");
    document.getElementById("txtEmailReset").classList.remove("is-invalid");
    $('.login-box').toggleClass('flipped');
    return false;
});

var divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {
    // Verificar e-mail e senha informado pra acessar o sistema
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

            divLoading.style.display = "flex";
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
                        document.querySelector("#txtSenha").value = "";
                    }
                } else {
                    swal.fire("Atenção", "Erro ao validar usuário", "error");
                }
                divLoading.style.display = "none";
            }
        }
    }

    // Buscar pergunta secreta
    if (document.querySelector("#formResetPass")) {
        let formResetPass = document.querySelector("#formResetPass");
        formResetPass.onsubmit = function (e) {
            e.preventDefault(); // Sempre usar em um form (submit), para que a página não seja recarregada

            let strEmail = document.querySelector("#txtEmailReset").value;
            if (strEmail == "") {
                document.getElementById("txtEmailReset").classList.add("is-invalid");
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'O campo e-mail é obrigatório!',
                    didClose: () => {
                        $("#txtEmailReset").select();
                    }
                });
                return false;
            } else {
                document.getElementById("txtEmailReset").classList.remove("is-invalid");
            }

            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Login/getUsuarioPergunta/' + strEmail;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        document.querySelector("#idUsuario").value = objData.data.id;
                        document.querySelector("#txtPergunta").value = objData.data.pergunta;
                        $('#modalResetLogin').modal('show');
                    } else {
                        swal.fire("Atenção", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
            }
        }
    }

    // Validar resposta da pergunta secreta
    if (document.querySelector("#formResetLogin")) {
        let formResetLogin = document.querySelector("#formResetLogin");
        formResetLogin.onsubmit = function (e) {
            e.preventDefault();

            let intId = document.querySelector("#idUsuario").value;
            let strRresposta = document.querySelector("#txtResposta").value;
            if (strRresposta == "") {
                document.getElementById("txtResposta").classList.add("is-invalid");
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'O campo resposta é obrigatório!',
                    didClose: () => {
                        $("#txtResposta").select();
                    }
                });
                return false;
            } else {
                document.getElementById("txtResposta").classList.remove("is-invalid");
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Login/criarNovaSenha/' + intId + "/" + strRresposta;
            var formData = new FormData(formResetLogin);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) {
                    return
                }
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Atenção',
                            text: 'Foi gerado uma senha temporária para acesso: ' + objData.senha,
                            didClose: () => {
                                $("#txtEmail").select();
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = base_url + "/login";
                            }
                        });
                    } else {
                        document.querySelector("#txtResposta").value = "";
                        Swal.fire({
                            icon: 'error',
                            title: 'Atenção',
                            text: objData.msg,
                            didClose: () => {
                                $("#txtResposta").select();
                            }
                        });
                    }
                } else {
                    swal.fire("Atenção", "Erro ao criar nova senha!", "error");
                }
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

function cancelar() {
    window.location = base_url + "/login";
    document.getElementById("txtResposta").classList.remove("is-invalid");
}