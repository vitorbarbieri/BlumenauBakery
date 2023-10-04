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
    document.querySelector('.modal-header').classList.replace("headerView", "headerRegister");
    document.querySelector('#btnCancelar').classList.replace("btn-secondary", "btn-danger");
    document.querySelector('#btnText').innerHTML = "<u>S</u>alvar";
    document.querySelector("#btnActionForm").setAttribute("accesskey", "s");
    document.querySelector('#btnText2').innerHTML = "<u>C</u>ancelar";
    document.querySelector("#btnCancelar").setAttribute("accesskey", "c");
    document.getElementById('btnActionForm').style.display = "";
    document.getElementById('divDataCriacao').style.display = "none";
    document.getElementById('divSenha').style.display = "";
    statusCampos("habilita");
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

function statusCampos(param) {
    var elementos = document.getElementsByClassName("valid");
    for (let i = 0; i < elementos.length; i++) {
        const item = elementos[i];
        if (param == "habilita") {
            item.removeAttribute("disabled");
        } else {
            item.setAttribute("disabled", "disabled");
        }
    }
}

function verUsuario(id) {
    document.querySelector('#titleModal').innerHTML = "Ver Usuário";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerView");
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerView");
    document.querySelector('#btnCancelar').classList.replace("btn-danger", "btn-secondary");
    document.querySelector('#btnText2').innerHTML = "<u>V</u>oltar";
    document.querySelector("#btnCancelar").setAttribute("accesskey", "v");
    document.getElementById('btnActionForm').style.display = "none";
    document.getElementById('divDataCriacao').style.display = "";
    document.getElementById('divSenha').style.display = "none";
    statusCampos("desabilita");

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuario/getUsuario/' + id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
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
                $('#modalViewUser').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
        $("#modalFormUsuario").modal("show");
    }
}