var tableUsuario;

document.addEventListener('DOMContentLoaded', function () {
    // Carregar datatable
    tableUsuario = $('#tabelaUsuario').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "scrollY": true,
        "scrollX": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        "ajax": {
            "url": " " + base_url + "/Usuario/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id", "width": "0%" },
            { "data": "nome", "width": "15%" },
            { "data": "sobrenome", "width": "20%" },
            { "data": "email", "width": "30%" },
            { "data": "cNome", "width": "15%" },
            { "data": "status", "width": "10%" },
            { "data": "opcao", "width": "10%" }
        ],
        "columnDefs": [
            { "visible": false, "targets": 0 } // Desativar coluna de índice 0 (id)
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[1, "asc"]]
    });

    // Inserir novo usuário
    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function (e) {
        e.preventDefault();

        var strcpf = document.querySelector("#txtCpf").value;
        var strNome = document.querySelector("#txtNome").value;
        var strSobrenome = document.querySelector("#txtSobrenome").value;
        var strTelefone = document.querySelector("#txtTelefone").value;
        var strEmail = document.querySelector("#txtEmail").value;
        var intCargo = document.querySelector("#listCargo").value;
        var intStatus = document.querySelector("#listStatus").value;
        var strSenha = document.querySelector("#txtSenha").value;
        var strConfirmaSenha = document.querySelector("#txtSenhaConfirma").value;

        $camposOk = true;
        validaCampos();
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

        var senhaOK = validaSenha();
        if (!senhaOK) {
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Usuario/setUsuario';
        var formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormUsuario').modal("hide");
                    cancelar();
                    Swal.fire('Atenção', objData.msg, 'success');
                    tableUsuario.api().ajax.reload(function () { });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: objData.msg,
                        didClose: () => {
                            $("#txtCpf").select();
                        }
                    });
                }
            }
        }
    }
}, false);

function openModal() {
    document.querySelector('#idUsuario').value = "";
    document.querySelector('#titleModal').innerHTML = "Criar Usuário";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "<u>S</u>alvar";
    document.querySelector("#btnActionForm").setAttribute("accesskey", "s");
    document.querySelector("#formUsuario").reset();
    $("#modalFormUsuario").modal("show");
    $('#txtCpf').select();
}

function cancelar() {
    removeClass();
    ocultarSenha();

    document.querySelector("#formUsuario").reset();
    $("#modalFormUsuario").modal("hide");
}

function validaCampos() {
    $(".valid").each(function () {
        if ($(this).val() == "" || $(this).val() == 0) {
            $(this).addClass("is-invalid");
            $camposOk = false;
        }
    });
}