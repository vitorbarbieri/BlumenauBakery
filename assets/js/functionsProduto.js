let tableProdutos;

// inserir o plugin "JsBarcode" - somente na vista Produto
document.write(`<script src="${base_url}/assets/js/plugins/JsBarcode.all.min.js"></script>`);
if (document.querySelector("#txtCodigo")) {
    let inputCodigo = document.querySelector("#txtCodigo");
    inputCodigo.onkeyup = function () {
        if (inputCodigo.value.length >= 5) {
            document.querySelector('#divBarCode').classList.remove("notBlock");
            gerarBarcode();
        } else {
            document.querySelector('#divBarCode').classList.add("notBlock");
        }
    };
}
function gerarBarcode() {
    let codigo = document.querySelector("#txtCodigo").value;
    JsBarcode("#barcode", codigo);
}
function imprimirBarcode(area) {
    var h = $(window).height();
    var w = $(window).width();
    let elemntArea = document.querySelector(area);
    let vprint = window.open(' ', 'popimpr', height = '+h', width = '+w');
    vprint.document.write(elemntArea.innerHTML);
    vprint.document.close();
    vprint.print();
    vprint.close();
}

// Inserir o plugin "Tinymce"
$(document).on('focusin', function (e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});
tinymce.init({
    selector: '#txtDescricao',
    width: "100%",
    height: 400,
    resize: false,
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    content_css: `${base_url}/assets/css/style.css`
});

// Carregar selec Categorias
window.addEventListener('load', function () {
    carregarCategorias();
}, false);
function carregarCategorias() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Produto/getCategorias';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listCategoria').innerHTML += request.responseText;
        }
    }
}

// let rowTable = "";
document.addEventListener('DOMContentLoaded', function () {
    // Carregar DataTabel produtos
    tableProdutos = $('#tableProduto').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "scrollY": true,
        "scrollX": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        "ajax": {
            "url": " " + base_url + "/produto/getProdutos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id", "width": "0%" },
            { "data": "codigo", "width": "15%" },
            { "data": "nome", "width": "30%" },
            { "data": "cNome", "width": "15%" },
            { "data": "estoque", "width": "10%" },
            { "data": "preco", "width": "10%" },
            { "data": "status", "width": "10%" },
            { "data": "opcoes", "width": "10%" }
        ],
        "columnDefs": [
            { "visible": false, "targets": 0 },
            { 'className': "textCenter", "targets": [4] },
            { 'className': "textRight", "targets": [5] },
            { 'className': "textCenter", "targets": [6] }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary",
                "exportOptions": {
                    "columns": [1, 2, 5]
                }
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Esportar a Excel",
                "className": "btn btn-success"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Esportar a PDF",
                "className": "btn btn-danger"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[1, "desc"]]
    });

    // Salvar produto no Banco de Dados
    var formProduto = document.querySelector("#formProduto");
    formProduto.onsubmit = function (e) {
        e.preventDefault();

        $camposOk = true;
        validaCampos(".valid");
        if (!$camposOk) {
            Swal.fire({
                icon: 'error',
                title: 'Atenção',
                text: 'Todos os campos são obrigatórios!',
                didClose: () => {
                    $("#txtNome").select();
                }
            });
            return false;
        }

        // if ($("#txtCodigo").length < 5) {
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Atenção',
        //         text: 'Código deve ter no mínimo 5 dígitos!',
        //         didClose: () => {
        //             $("#txtCodigo").select();
        //         }
        //     });
        //     return false;
        // }

        tinymce.triggerSave(); // Salva a sinformações do editor para o "textarea"

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Produto/setProduto';
        var formData = new FormData(formProduto);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                // console.log(request.responseText);
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    cancelar();
                    Swal.fire('Atenção', objData.msg, 'success');
                    document.querySelector("#idProduto").value = objData.idProducto;
                    document.querySelector("#containerGallery").classList.remove("notBlock");
                    tableProdutos.api().ajax.reload(function () { });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: objData.msg,
                        didClose: () => {
                            $("#txtNome").select();
                        }
                    });
                }
            }
        }
    }
}, false);

function openModal() {
    // rowTable = "";
    document.querySelector("#divBarCode").classList.add("notBlock");
    document.querySelector("#containerGallery").classList.add("notBlock");
    document.querySelector("#containerImages").innerHTML = "";


    document.querySelector('#idProduto').value = "";
    document.querySelector('#titleModal').innerHTML = "Criar Usuário";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('.modal-header').classList.replace("headerView", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    // document.querySelector('#btnCancelar').classList.replace("btn-secondary", "btn-danger");
    document.querySelector('#btnText').innerHTML = "<u>S</u>alvar";
    // document.querySelector("#btnActionForm").setAttribute("accesskey", "s");
    // document.querySelector('#btnText2').innerHTML = "<u>C</u>ancelar";
    // document.querySelector("#btnCancelar").setAttribute("accesskey", "c");
    // document.getElementById('btnActionForm').style.display = "";
    // document.getElementById('divDataCriacao').style.display = "none";
    // document.getElementById('divSenha').style.display = "";
    // statusCampos("habilita");
    // document.getElementById('txtCpf').removeAttribute("disabled");
    document.querySelector("#formProduto").reset();
    $("#modalFormProdutos").modal("show");
}

function cancelar() {
    removeClass(".valid");
}

function adicionarImagem() {
    let key = Date.now();
    let newElement = document.createElement("div");
    newElement.id = "div" + key;
    newElement.innerHTML = `
        <div class="prevImage"></div>
        <input type="file" name="foto" id="img${key}" class="inputUploadfile">
        <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
        <button class="btnDeleteImage notBlock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
    document.querySelector("#containerImages").appendChild(newElement);
    document.querySelector("#div" + key + " .btnUploadfile").click();
    fntInputFile();
}

function fntInputFile() {
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function (inputUploadfile) {
        inputUploadfile.addEventListener('change', function () {
            let idProduto = document.querySelector("#idProduto").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");
            let uploadFoto = document.querySelector("#" + idFile).value;
            let fileimg = document.querySelector("#" + idFile).files;
            let prevImg = document.querySelector("#" + parentId + " .prevImage");
            let nav = window.URL || window.webkitURL;
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    prevImg.innerHTML = "Arquivo em formato não válido";
                    uploadFoto.value = "";
                    return false;
                } else {
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/assets/img/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + '/Produto/setImage';
                    let formData = new FormData();
                    formData.append('idProduto', idProduto);
                    formData.append("foto", this.files[0]);
                    request.open("POST", ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function () {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#" + parentId + " .btnDeleteImage").setAttribute("imgname", objData.imgname);
                                document.querySelector("#" + parentId + " .btnUploadfile").classList.add("notBlock");
                                document.querySelector("#" + parentId + " .btnDeleteImage").classList.remove("notBlock");
                            } else {
                                swal.fire("Erro", objData.msg, "error");
                            }
                        }
                    }
                }
            }
        });
    });
}

function verProduto(idProduto) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Produto/getProduto/' + idProduto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImage = "";
                let objProduto = objData.data;
                let estadoProduto = objProduto.status == 1 ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>';

                document.querySelector("#celCodigo").innerHTML = objProduto.codigo;
                document.querySelector("#celNome").innerHTML = objProduto.nome;
                document.querySelector("#celPreco").innerHTML = objProduto.preco;
                document.querySelector("#celEstoque").innerHTML = objProduto.estoque;
                document.querySelector("#celCategoria").innerHTML = objProduto.nomeCategoria;
                document.querySelector("#celStatus").innerHTML = estadoProduto;
                if (objProduto.descripcion == null) {
                    document.querySelector("#celDescricao").innerHTML = "";
                } else {
                    document.querySelector("#celDescricao").innerHTML = objProduto.descripcion;
                }

                if (objProduto.images.length > 0) {
                    let objProdutos = objProduto.images;
                    for (let p = 0; p < objProdutos.length; p++) {
                        htmlImage += `<img src="${objProdutos[p].url_image}"></img>`;
                    }
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewProduto').modal('show');
            } else {
                swal.fire("Erro", objData.msg, "error");
            }
        }
    }
}