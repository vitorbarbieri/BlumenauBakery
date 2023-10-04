function formataCampo(texto, mascara) {
    var valor = document.querySelector(texto).value;

    if (texto == "#txtTelefone" && valor.length == 10) {
        mascara = "(##)####-####";
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
    alteraClassInvalido();
}

function validaEmail(){
    const emailRegex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i
    var emailOk = emailRegex.test(document.querySelector("#txtEmail").value);

    if (emailOk) {
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

    alteraClassInvalido();
}

function alteraClassInvalido() {
    var inputs = document.querySelectorAll(".valid");
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

function removeClass() {
    $(".valid").each(function () {
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