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
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-b2');
        $(this).off('click');
    });
});

$('.js-addwish-detail').each(function () {
    var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

    $(this).on('click', function () {
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-detail');
        $(this).off('click');
    });
});

/*---------------------------------------------*/

$('.js-addcart-detail').each(function () {
    var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
    $(this).on('click', function () {
        let id = this.getAttribute('id');
        let cant = document.querySelector('#qtdProduto').value;

        if (isNaN(cant) || cant < 1) {
            swal("", "A quantidade deve ser maior que 1", "error");
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
                    swal(nameProduct, "foi adicionado ao carrinho!", "success");
                } else {
                    swal("", objData.msg, "error");
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
                    swal("", objData.msg, "error");
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
                    swal("", objData.msg, "error");
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