document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector("#formLogin")) {
        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function (e) {
            e.preventDefault();

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/login/loginCliente';
            var formData = new FormData(formLogin);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) {
                    return
                }
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        window.location.reload(false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Atenção',
                            text: objData.msg,
                            didClose: () => {
                                $("#txtEmail").select();
                            }
                        });
                        document.querySelector("#txtSenha").value = "";
                    }
                } else {
                    swal.fire("Atenção", "Erro ao validar usuário", "error");
                }
            }
        }
    }

    // Inserir novo usuário
    var formRegister = document.querySelector("#formRegister");
    formRegister.onsubmit = function (e) {
        e.preventDefault();

        nome = document.querySelector("#txtNome").value;
        email = document.querySelector("#txtEmailCliente").value;
        cep = document.querySelector("#txtCep").value;
        endereco = document.querySelector("#txtEndereco").value;
        numero = document.querySelector("#txtNumero").value;
        bairro = document.querySelector("#txtBairro").value;
        cidade = document.querySelector("#txtCidade").value;
        estado = document.querySelector("#listEstado").value;
        sexo = document.querySelector("#listSexo").value;
        dataNascimento = document.querySelector("#txtDataNascimento").value;
        senha = document.querySelector("#txtSenhaCadastro").value;

        // if (nome == "" || email == "" || cep == "" || endereco == "" || numero == "" || bairro == "" || cidade == "" || estado == 0 || sexo == 0 || dataNascimento == "" || senha == "") {
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Atenção',
        //         text: 'Todos os campos são obrigatórios!',
        //         didClose: () => {
        //             $("#txtNome").select();
        //         }
        //     });
        //     return false;
        // }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/loja/setCliente';
        var formData = new FormData(formRegister);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    window.location.reload(false);
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

$(".js-select2").each(function () {
    $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
    });
});

$('.parallax100').parallax100();

$('.gallery-lb').each(function () { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
            enabled: true
        },
        mainClass: 'mfp-fade'
    });
});

$('.js-addwish-b2').on('click', function (e) {
    e.preventDefault();
});

$('.js-addwish-b2').each(function () {
    var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
    $(this).on('click', function () {
        // swal.fire(nameProduct, "foi adicionado ao carrinho!", "success");
    });
});

$('.js-addwish-detail').each(function () {
    var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

    $(this).on('click', function () {
        swal.fire(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-detail');
        $(this).off('click');
    });
});

/*---------------------------------------------*/

$('.js-addcart-detail').each(function () {
    let nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
    let cant = 1;
    $(this).on('click', function () {
        let id = this.getAttribute('id');

        if (document.querySelector('#qtdProduto')) {
            cant = document.querySelector('#qtdProduto').value;
        }

        if (this.getAttribute('pr')) {
            cant = this.getAttribute('pr');
        }

        if (isNaN(cant) || cant < 1) {
            swal.fire("", "A quantidade deve ser maior que 1", "error");
            return;
        }
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Loja/addCarrinho';
        let formData = new FormData();
        formData.append('id', id);
        formData.append('cant', cant);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                // console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    document.querySelector("#produtosCarrinho").innerHTML = objData.htmlCarrinho;
                    // document.querySelector("#qtdCarrinho").setAttribute("data-notify", objData.qtdCarrinho);
                    //document.querySelectorAll("#qtdCarrinho")[1].setAttribute("data-notify",objData.qtdCarrinho);
                    const cants = document.querySelectorAll("#qtdCarrinho");
                    cants.forEach(element => {
                        element.setAttribute("data-notify", objData.qtdCarrinho)
                    });
                    // swal.fire(nameProduct, "foi adicionado ao carrinho!", "success");
                    swal.fire("", "Produto adicionado ao carrinho!", "success");
                } else {
                    swal.fire("", objData.msg, "error");
                }
            }
            return false;
        }
    });
});

$('.js-pscroll').each(function () {
    $(this).css('position', 'relative');
    $(this).css('overflow', 'hidden');
    var ps = new PerfectScrollbar(this, {
        wheelSpeed: 1,
        scrollingThreshold: 1000,
        wheelPropagation: false,
    });

    $(window).on('resize', function () {
        ps.update();
    })
});

function fntdelItem(elemento) {
    //Option 1 = Modal Carrinho
    //Option 2 = Vista Carrinho
    let option = elemento.getAttribute("op");
    let idpr = elemento.getAttribute("idpr");

    if (option == 1 || option == 2) {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/loja/delCarrinho';
        let formData = new FormData();
        formData.append('id', idpr);
        formData.append('option', option);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                // console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    if (option == 1) {
                        document.querySelector("#produtosCarrinho").innerHTML = objData.htmlCarrito;
                        const qtds = document.querySelectorAll("#qtdCarrinho");
                        qtds.forEach(elemento => {
                            elemento.setAttribute("data-notify", objData.qtdCarrinho)
                        });
                    } else {
                        elemento.parentNode.parentNode.remove();
                        let valor = parseFloat(objData.subTotal.slice(2).replace(',', '.')).toFixed(2);
                        if (valor <= 100) {
                            document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                            document.querySelector("#valorFrete").innerHTML = "R$ 10,00";
                            document.querySelector("#totalCompra").innerHTML = objData.total;
                        } else {
                            document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                            document.querySelector("#valorFrete").innerHTML = "R$ 0,00";
                            document.querySelector("#totalCompra").innerHTML = objData.subTotal;
                        }
                        if (document.querySelectorAll("#tblCarrito tr").length == 1) {
                            window.location.href = base_url;
                        }
                    }
                } else {
                    swal.fire("", objData.msg, "error");
                }
            }
            return false;
        }
    }
}

function fntUpdateQtd(pro, qtd) {
    if (qtd <= 0) {
        document.querySelector("#btnComprar").classList.add("notBlock");
    } else {
        document.querySelector("#btnComprar").classList.remove("notBlock");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/loja/updateCarrinho';
        let formData = new FormData();
        formData.append('id', pro);
        formData.append('quantidade', qtd);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    let colSubTotal = document.getElementsByClassName(pro)[0];
                    colSubTotal.cells[4].textContent = objData.totalProduto;
                    let valor = parseFloat(objData.subTotal.slice(2).replace(',', '.')).toFixed(2);
                    if (valor <= 100) {
                        document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                        document.querySelector("#valorFrete").innerHTML = "R$ 10,00";
                        document.querySelector("#totalCompra").innerHTML = objData.total;
                    } else {
                        document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                        document.querySelector("#valorFrete").innerHTML = "R$ 0,00";
                        document.querySelector("#totalCompra").innerHTML = objData.subTotal;
                    }
                } else {
                    swal.fire("", objData.msg, "error");
                }
            }

        }
    }
    return false;
}

/*==================================================================

[ +/- Num produto ]*/
$('.btn-num-product-down').on('click', function () {
    let numProduct = Number($(this).next().val());
    let idpr = this.getAttribute('idpr');
    if (numProduct > 1) $(this).next().val(numProduct - 1);
    let qtd = $(this).next().val();
    if (idpr != null) {
        fntUpdateQtd(idpr, qtd);
    }
});

$('.btn-num-product-up').on('click', function () {
    let numProduct = Number($(this).prev().val());
    let idpr = this.getAttribute('idpr');
    $(this).prev().val(numProduct + 1);
    let qtd = $(this).prev().val();
    if (idpr != null) {
        fntUpdateQtd(idpr, qtd);
    }
});

// Atualizar produto
if (document.querySelector(".num-product")) {
    let inputCant = document.querySelectorAll(".num-product");
    inputCant.forEach(function (inputCant) {
        inputCant.addEventListener('keyup', function () {
            let idpr = this.getAttribute('idpr');
            let cant = this.value;
            if (idpr != null) {
                fntUpdateQtd(idpr, cant);
            }
        });
    });
}

/* ================================================== Processar Pagamento ================================================== */

if (document.querySelector("#btnComprar")) {
    let btnPago = document.querySelector("#btnComprar");
    btnPago.addEventListener('click', function () {
        let endereco = document.querySelector("#txtEndereco").value;
        let cidade = document.querySelector("#txtCidade").value;
        let intTipoPago = parseInt(document.querySelector("#listTipoPago").value);
        if (endereco == "" || cidade == "" || intTipoPago == 0) {
            swal.fire("", "Complete os dados de envio", "error");
            return;
        } else {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/loja/processarVenda';
            let formData = new FormData();
            formData.append('endereco', endereco);
            formData.append('cidade', cidade);
            formData.append('intTipoPago', intTipoPago);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        window.location = base_url + "/loja/confirmarPedido/";
                    } else {
                        swal.fire("", objData.msg, "error");
                    }
                }
                return false;
            }
        }

    }, false);
}

/* ================================================== Editar Cliente ================================================== */

function editarCliente(idCliente) {
    document.querySelector("#idUsuario").value = parseInt(idCliente);

    if (document.querySelector("#txtSenha").value != document.querySelector("#txtConfirmarSenha").value) {
        Swal.fire({
            icon: 'error',
            title: 'Atenção',
            text: 'Senhas não são iguais!',
            didClose: () => {
                $("#txtSenha").select();
            }
        });
        return;
    }

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/minhaConta/setUsuario';
    var formData = new FormData(formUsuario);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                Swal.fire('Atenção', objData.msg, 'success');
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