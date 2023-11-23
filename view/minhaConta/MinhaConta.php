<?php
headerLoja($data);

if ($_SESSION['userData']['ultima_compra'] == null) {
    $dataUltimaCompra = "";
} else {
    $dataUltimaCompra = "31/12/2023";
}

$dataNscimento = date('d/m/Y', strtotime($_SESSION['userData']['data_nascimento']));

if ($_SESSION['userData']['sexo'] = "M") {
    $sexo = "Masculino";
} else {
    $sexo = "Feminino";
}

if ($_SESSION['userData']['status'] == 1) {
    $status = "Ativo";
} else {
    $status = "Inativo";
}

?>

<script>
    document.querySelector("header").classList.add('header-v4');
</script>

<h2 class="txt-center">
    Minha Conta
</h2>
<div style="margin: 20px 150px;">
    <div class="row user">
        <div class="col-md-2">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Dados Pessoais</a></li>
                    <li class="nav-item"><a class="nav-link" href="#user-orders" data-toggle="tab">Pedidos</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                    <div class="tile user-settings mx">
                        <div class="post-media"><a href="#"></a>
                            <div class="content">
                                <h4 class="line-head">
                                    Configurações
                                </h4>
                            </div>
                        </div>
                        <div>
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="txtNome">Nome</label>
                                        <input class="form-control" id="txtNome" name="txtNome" tabindex="1" type="text" value="<?= $_SESSION['userData']['nome']; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Data Nascimento</label>
                                        <input class="form-control" type="text" value="<?= $dataNscimento; ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Sexo</label>
                                        <input class="form-control" type="text" value="<?= $sexo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="txtEmail">E-mail</label>
                                        <input class="form-control" id="txtEmail" name="txtEmail" tabindex="2" type="text" value="<?= $_SESSION['userData']['email']; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Data Última Compra</label>
                                        <input class="form-control" type="text" value="<?= $dataUltimaCompra; ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Status</label>
                                        <input class="form-control" type="text" value="<?= $status; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label class="control-label" for="txtEndereço">Endereço</label>
                                        <input class="form-control" id="txtEndereço" name="txtEndereço" tabindex="3" type="text" value="<?= $_SESSION['userData']['endereco']; ?>">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="control-label" for="txtNumero">Numero</label>
                                        <input class="form-control" id="txtNumero" name="txtNumero" tabindex="4" type="text" value="<?= $_SESSION['userData']['numero']; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label" for="txtCep">Cep</label>
                                        <input class="form-control" id="txtCep" name="txtCep" tabindex="5" type="text" value="<?= $_SESSION['userData']['cep']; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="txtSenha">Senha</label>
                                        <input class="form-control" id="txtSenha" name="txtSenha" tabindex="6" type="text" value="••••••••••">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="txtConfirmarSenha">Confirmar</label>
                                        <input class="form-control" id="txtConfirmarSenha" name="txtConfirmarSenha" tabindex="7" type="text" value="••••••••••">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-orders">
                    <div class="tile user-orders">
                        <h4 class="line-head">
                            Pedidos
                        </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tile">
                                    <div class="tile-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="tablePedido">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Data</th>
                                                        <th>Valor</th>
                                                        <th>Tipo Pagamento</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
footerLoja($data);
?>