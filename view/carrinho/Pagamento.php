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
                    if (isset($_SESSION['loginCliente'])) {
                    ?>
                        <div>
                            <label for="tipopago">Endereço</label>
                            <div class="bor8 bg0 m-b-12">
                                <input id="txtEndereco" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="Endereço" value="<?= $_SESSION['userData']['endereco'] . ", " . $_SESSION['userData']['numero'] ?>">
                            </div>
                            <div class="bor8 bg0 m-b-22">
                                <input id="txtCidade" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Cidade" value="<?= $_SESSION['userData']['cidade'] ?>">
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
                                            <label for="txtNome">Nome</label>
                                            <input type="text" class="form-control" id="txtNome" name="txtNome">
                                        </div>
                                        <div class="col col-md-6 form-group">
                                            <label for="txtEmailCliente">E-mail</label>
                                            <input type="email" class="form-control" id="txtEmailCliente" name="txtEmailCliente">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-3 form-group">
                                            <label for="txtCep">CEP</label>
                                            <input type="text" class="form-control" id="txtCep" name="txtCep" maxlength="8" onblur="formataCampo('#txtCep', '#####-###');">
                                        </div>
                                        <div class="col col-md-7 form-group">
                                            <label for="txtEndereco">Endereço</label>
                                            <input type="text" class="form-control" id="txtEndereco" name="txtEndereco">
                                        </div>
                                        <div class="col col-md-2 form-group">
                                            <label for="txtNumero">Número</label>
                                            <input type="text" class="form-control" id="txtNumero" name="txtNumero">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-4 form-group">
                                            <label for="txtBairro">Bairro</label>
                                            <input type="text" class="form-control" id="txtBairro" name="txtBairro">
                                        </div>
                                        <div class="col col-md-5 form-group">
                                            <label for="txtCidade">Cidade</label>
                                            <input type="text" class="form-control" id="txtCidade" name="txtCidade">
                                        </div>
                                        <div class="col col-md-3 form-group">
                                            <label for="listEstado">Estado</label>
                                            <select class="form-control" id="listEstado" name="listEstado">
                                                <option value="0">-- Selecionar --</option>
                                                <option value="1">AC</option>
                                                <option value="2">AL</option>
                                                <option value="3">AP</option>
                                                <option value="4">AM</option>
                                                <option value="5">BA</option>
                                                <option value="6">CE</option>
                                                <option value="7">DF</option>
                                                <option value="8">ES</option>
                                                <option value="9">GO</option>
                                                <option value="10">MA</option>
                                                <option value="11">MT</option>
                                                <option value="12">MS</option>
                                                <option value="13">MG</option>
                                                <option value="14">PA</option>
                                                <option value="15">PB</option>
                                                <option value="16">PR</option>
                                                <option value="17">PE</option>
                                                <option value="18">PI</option>
                                                <option value="19">RJ</option>
                                                <option value="20">RN</option>
                                                <option value="21">RS</option>
                                                <option value="22">RO</option>
                                                <option value="23">RR</option>
                                                <option value="24">SC</option>
                                                <option value="25">SP</option>
                                                <option value="26">SE</option>
                                                <option value="27">TO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-3 form-group">
                                            <label for="txtDataNascimento">Data de Nascimento</label>
                                            <input type="date" class="form-control" id="txtDataNascimento" name="txtDataNascimento" maxlength="8">
                                        </div>
                                        <div class="col col-md-3 form-group">
                                            <label for="listSexo">Sexo</label>
                                            <select class="form-control" id="listSexo" name="listSexo">
                                                <option value="0">-- Selecionar --</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Feminino</option>
                                            </select>
                                        </div>
                                        <div class="col col-md-6 form-group">
                                            <label for="txtSenhaCadastro">Senha</label>
                                            <input type="password" class="form-control" id="txtSenhaCadastro" name="txtSenhaCadastro">
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
                if (isset($_SESSION['loginCliente'])) {
                ?>
                    <h4 class="mtext-109 cl2 p-b-30">
                        Método de pago
                    </h4>
                    <div class="divmetodpago">
                        <div id="divtipopago" class="notblock">
                            <label for="listTipoPago">Tipo de pago</label>
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                <select id="listTipoPago" class="teste" name="listTipoPago">
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