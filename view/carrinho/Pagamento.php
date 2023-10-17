<?php
headerLoja($data);

$subTotal = 0;
$total = 0;

if (isset($_SESSION['arrCarrinho'])) {
    foreach ($_SESSION['arrCarrinho'] as $produto) {
        $subTotal += $produto['preco'] * $produto['quantidade'];
    }
}

if ($subTotal <= 100) {
    $total = $subTotal + CUSTOENVIO;
} else {
    $total = $subTotal;
}


?>
<br><br><br>
<hr>
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="<?= base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
            Inicio
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">
            <?= $data['page_title'] ?>
        </span>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
                <div>
                    <?php
                    if (isset($_SESSION['login'])) {
                    ?>
                        <div>
                            <label for="tipopago">Endereço</label>
                            <div class="bor8 bg0 m-b-12">
                                <input id="txtDireccion" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="Endereço">
                            </div>
                            <div class="bor8 bg0 m-b-22">
                                <input id="txtCiudad" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Cidade / Estado">
                            </div>
                        </div>
                    <?php } else { ?>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Iniciar Seção</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="profile" aria-selected="false">Criar Conta</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                                <br>
                                <form id="formLogin">
                                    <div class="form-group">
                                        <label for="txtEmail">Usuário</label>
                                        <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtSenha">Senha</label>
                                        <input type="password" class="form-control" id="txtSenha" name="txtSenha">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Entrar</button>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                                <br>
                                <form id="formRegister">
                                    <div class="row">
                                        <div class="col col-md-6 form-group">
                                            <label for="txtNombre">Nome</label>
                                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                                        </div>
                                        <div class="col col-md-6 form-group">
                                            <label for="txtApellido">Sobrenome</label>
                                            <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6 form-group">
                                            <label for="txtTelefono">Telefone</label>
                                            <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
                                        </div>
                                        <div class="col col-md-6 form-group">
                                            <label for="txtEmailCliente">E-mail</label>
                                            <input type="email" class="form-control valid validEmail" id="txtEmailCliente" name="txtEmailCliente" required="">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                <h4 class="mtext-109 cl2 p-b-30">
                    Resumo
                </h4>
                <div class="flex-w flex-t bor12 p-b-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Subtotal:
                        </span>
                    </div>
                    <div class="size-209">
                        <span id="subTotalCompra" class="mtext-110 cl2">
                            <?= formatMoney($subTotal) ?>
                        </span>
                    </div>
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Envio:
                        </span>
                    </div>
                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?php
                            if ($subTotal <= 100) {
                                echo formatMoney(CUSTOENVIO);
                            } else {
                                echo "R$ 0,00";
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t p-t-27 p-b-33">
                    <div class="size-208">
                        <span class="mtext-101 cl2">
                            Total:
                        </span>
                    </div>

                    <div class="size-209 p-t-1">
                        <span id="totalCompra" class="mtext-110 cl2">
                            <?= formatMoney($total) ?>
                        </span>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['login'])) {
                ?>
                    <h4 class="mtext-109 cl2 p-b-30">
                        Método de pago
                    </h4>
                    <div class="divmetodpago">
                        <div id="divtipopago" class="notblock">
                            <label for="listtipopago">Tipo de pago</label>
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                <select id="listtipopago" class="js-select2" name="listtipopago">
                                    <option value="0">-- Selecionar --</option>
                                    <option value="1">Dinheiro</option>
                                    <option value="2">PIX</option>
                                    <option value="3">Cartão de Débito</option>
                                    <option value="4">Cartão de Crédito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <button type="submit" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Pagar</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
footerLoja($data);
?>