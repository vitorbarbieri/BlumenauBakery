function formataCampo(texto, mascara) {
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
}