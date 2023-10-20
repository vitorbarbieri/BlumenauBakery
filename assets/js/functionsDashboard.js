$('.date-picker').datepicker({
    closeText: 'Fechar',
    prevText: 'Ant',
    nextText: 'Pro',
    currentText: 'Hoje',
    monthNames: ['1 -', '2 -', '3 -', '4 -', '5 -', '6 -', '7 -', '8 -', '9 -', '10 -', '11 -', '12 -'],
    monthNamesShort: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    showDays: false,
    onClose: function (dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }
});

function fntSearchPagos() {
    let data = document.querySelector(".pagoMes").value;
    if (data == "") {
        swal.fire("Atenção", "Selecione o mês e ano", "error");
        return false;
    } else {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/dashboard/tipoPagoMes';
        let formData = new FormData();
        formData.append('data', data);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                $("#pagosMesAno").html(request.responseText);
                return false;
            }
        }
    }
}

function fntSearchVMes() {
    let data = document.querySelector(".vendasMes").value;
    if (data == "") {
        swal.fire("Atenção", "Selecione o mês e ano", "error");
        return false;
    } else {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/dashboard/vendasMes';
        let formData = new FormData();
        formData.append('data', data);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                $("#graficaMes").html(request.responseText);
                return false;
            }
        }
    }
}

function fntSearchVAno() {
    let ano = document.querySelector(".vendasAno").value;
    if (ano == "") {
        swal.fire("Atenção", "Informa o ano ", "error");
        return false;
    } else {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/dashboard/vendasAno';
        let formData = new FormData();
        formData.append('ano', ano);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                $("#graficaAno").html(request.responseText);
                return false;
            }
        }
    }
}