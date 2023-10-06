function openModal()
{
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