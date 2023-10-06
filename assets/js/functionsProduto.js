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

function openModal() {
    // rowTable = "";
    // document.querySelector("#divBarCode").classList.add("notblock");
    // document.querySelector("#containerGallery").classList.add("notblock");
    // document.querySelector("#containerImages").innerHTML = "";


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