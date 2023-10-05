var tableCliente;

document.addEventListener('DOMContentLoaded', function () {
    // Carregar datatable
    tableCliente = $('#tableCliente').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "scrollY": true,
        "scrollX": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        "ajax": {
            "url": " " + base_url + "/Cliente/getClientes",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id", "width": "0%" },
            { "data": "nome", "width": "35%" },
            { "data": "email", "width": "30%" },
            { "data": "ultima_compra", "width": "15%" },
            { "data": "status", "width": "10%" },
            { "data": "opcao", "width": "10%" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Esportar Excel",
                "className": "btn btn-success"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Esportar PDF",
                "className": "btn btn-danger"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Esportar CSV",
                "className": "btn btn-info"
            }
        ],
        "columnDefs": [
            { "visible": false, "targets": 0 } // Desativar coluna de índice 0 (id)
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[1, "asc"]]
    });
}, false);


function openModal() {
    // document.querySelector("#formUsuario").reset();
    $("#modalFormCliente").modal("show");
}

function verCliente(id) {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Cliente/getCliente/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            if (objData.status) {
                var status = objData.data.status == 1 ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>';
                if (objData.data.sexo == "M") {
                    sexo = "Masculino";
                } else {
                    sexo = "Feminino";
                }

                document.querySelector("#txtNome").innerHTML = objData.data.nome;
                document.querySelector("#txtEmail").innerHTML = objData.data.email;
                document.querySelector("#txtSexo").innerHTML = sexo;
                document.querySelector("#txtDataNascimento").innerHTML = objData.data.data_nascimento;
                document.querySelector("#txtEndereco").innerHTML = objData.data.endereco;
                document.querySelector("#txtNumero").innerHTML = objData.data.numero;
                document.querySelector("#txtBairro").innerHTML = objData.data.bairro;
                document.querySelector("#txtCidade").innerHTML = objData.data.cidade;
                document.querySelector("#txtEstado").innerHTML = objData.data.estado;
                document.querySelector("#txtCep").innerHTML = objData.data.cep;
                document.querySelector("#txtStatus").innerHTML = status;
                document.querySelector("#txtUltimaCompra").innerHTML = objData.data.ultima_compra;
                $('#modalViewUser').modal('show');
            } else {
                swal.fire("Atenção", objData.msg, "error");
            }
        }
    }
}