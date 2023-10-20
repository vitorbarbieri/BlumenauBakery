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
}, false);