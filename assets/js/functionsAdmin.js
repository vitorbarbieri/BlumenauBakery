function formataCampo(texto, mascara, classe) {
    var valor = document.querySelector(texto).value;

    if (texto == "#txtTelefone") {
        if (valor.length != 10 && valor.length != 11) {
            document.querySelector(texto).value = "";
            document.querySelector(texto).select();
            return;
        }
        if (valor.length == 10) {
            mascara = "(##)####-####";
        }
    }

    if (texto == "#txtCpf" && valor.length != 11) {
        document.querySelector(texto).value = "";
        document.querySelector(texto).select();
        return;
    }

    if (valor != "") {
        var retorno = "";
        var j = 0;
        for (let i = 0; i < mascara.length; i++) {
            var eValor = valor[j];
            var eMascara = mascara[i];
            if (eMascara != "#") {
                retorno = retorno + eMascara;
            } else {
                retorno = retorno + eValor;
                j++;
            }
        }
        document.querySelector(texto).value = retorno;
    }
    alteraClassInvalido(classe);
}

function validaEmail(classe) {
    const emailRegex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i;
    var valor = document.querySelector("#txtEmail").value;
    var emailOk = emailRegex.test(valor);

    if (emailOk || valor == "") {
        document.querySelector("#btnActionForm").disabled = false;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Atenção',
            text: 'E-mail no formato incorreto!',
            didClose: () => {
                $("#txtEmail").select();
            }
        });
        document.querySelector("#btnActionForm").disabled = true;
    }

    alteraClassInvalido(classe);
}

function alteraClassInvalido(classe) {
    var inputs = document.querySelectorAll(classe);
    inputs.forEach(element => {
        if (element.tagName == "INPUT") {
            if (element.value != "") {
                element.classList.remove('is-invalid');
            }
        } else {
            if (element.value != 0) {
                element.classList.remove('is-invalid');
            }
        }
    });
}

function removeClass(classe) {
    $(classe).each(function () {
        $(this).removeClass("is-invalid");
    });
}

function mostrarSenha() {
    var tipo = document.querySelector("#txtSenha").type;
    if (tipo == "text") {
        $("#txtSenha").attr("type", "password");
        $("#txtSenhaConfirma").attr("type", "password");
        $("#txtSenha").select();
    } else {
        $("#txtSenha").attr("type", "text");
        $("#txtSenhaConfirma").attr("type", "text");
        $("#txtSenha").select();
    }
}

function ocultarSenha() {
    $("#txtSenha").attr("type", "password");
    $("#txtSenhaConfirma").attr("type", "password");
}

function validaSenha() {
    // var id = document.querySelector("#txtSenha").getAttribute("id");
    // if (id == "txtSenha" || id == "txtSenhaConfirma" && document.querySelector("#txtSenha").value == "" && document.querySelector("#txtSenhaConfirma").value == "") {
    //     return true;
    // }

    var strSenha = document.querySelector("#txtSenha");
    var strSenhaConfirma = document.querySelector("#txtSenhaConfirma");
    if (strSenha.value != strSenhaConfirma.value) {
        strSenha.classList.add('is-invalid');
        strSenhaConfirma.classList.add('is-invalid');
        Swal.fire({
            icon: 'error',
            title: 'Atenção',
            text: 'Senhas são diferentes!',
            didClose: () => {
                $("#txtSenha").select();
            }
        });
        return false;
    }
    else {
        if (strSenha.value.length < 5) {
            Swal.fire({
                icon: 'info',
                title: 'Atenção',
                text: 'Senha deve ter no mínimo 5 caracteres!',
                didClose: () => {
                    $("#txtSenha").select();
                }
            });
            return false;
        } else {
            return true;
        }
    }
}

function validaCampos(classe) {
    $(classe).each(function () {
        var elementType = $(this).prop('nodeName');

        switch (elementType) {
            case "INPUT":
            case "TEXTAREA":
                if ($(this).val() == "") {
                    // var id = $(this).attr("id");
                    // if (id == "txtSenha" || id == "txtSenhaConfirma" && $("#txtSenha").val() == "" && $("#txtSenhaConfirma").val() == "") {
                    //     break;
                    // }
                    $(this).addClass("is-invalid");
                    $camposOk = false;
                }
                break;
            case "SELECT":
                if ($(this).val() == 0) {
                    $(this).addClass("is-invalid");
                    $camposOk = false;
                }
                break;
        }
    });
}