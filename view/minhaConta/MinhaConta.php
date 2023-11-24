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
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="tab-content">
                <div>
                    <div>
                        <div class="post-media"><a href="#"></a>
                            <div class="content">
                                <h4 class="line-head">
                                    Configurações
                                </h4>
                            </div>
                        </div>
                        <div>
                            <form id="formUsuario" name="formUsuario" class="form-horizontal">
                                <input type="hidden" id="idUsuario" name="idUsuario">
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label class="control-label" for="txtBairro">Bairro</label>
                                <input class="form-control" id="txtBairro" name="txtBairro" tabindex="3" type="text" value="<?= $_SESSION['userData']['bairro']; ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label class="control-label" for="txtCidade">Cidade</label>
                                <input class="form-control" id="txtCidade" name="txtCidade" tabindex="4" type="text" value="<?= $_SESSION['userData']['cidade']; ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label" for="listEstado">Estado</label>
                                <select class="form-control" id="listEstado" name="listEstado">
                                    <option style="color: black;" value="1">AC</option>
                                    <option style="color: black;" value="2">AL</option>
                                    <option style="color: black;" value="3">AP</option>
                                    <option style="color: black;" value="4">AM</option>
                                    <option style="color: black;" value="5">BA</option>
                                    <option style="color: black;" value="6">CE</option>
                                    <option style="color: black;" value="7">DF</option>
                                    <option style="color: black;" value="8">ES</option>
                                    <option style="color: black;" value="9">GO</option>
                                    <option style="color: black;" value="10">MA</option>
                                    <option style="color: black;" value="11">MT</option>
                                    <option style="color: black;" value="12">MS</option>
                                    <option style="color: black;" value="13">MG</option>
                                    <option style="color: black;" value="14">PA</option>
                                    <option style="color: black;" value="15">PB</option>
                                    <option style="color: black;" value="16">PR</option>
                                    <option style="color: black;" value="17">PE</option>
                                    <option style="color: black;" value="18">PI</option>
                                    <option style="color: black;" value="19">RJ</option>
                                    <option style="color: black;" value="20">RN</option>
                                    <option style="color: black;" value="21">RS</option>
                                    <option style="color: black;" value="22">RO</option>
                                    <option style="color: black;" value="23">RR</option>
                                    <option style="color: black;" value="24">SC</option>
                                    <option style="color: black;" value="25">SP</option>
                                    <option style="color: black;" value="26">SE</option>
                                    <option style="color: black;" value="27">TO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="txtSenha">Senha</label>
                                <input class="form-control" id="txtSenha" name="txtSenha" tabindex="6" type="text" placeholder="••••••••••">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="txtConfirmarSenha">Confirmar</label>
                                <input class="form-control" id="txtConfirmarSenha" name="txtConfirmarSenha" tabindex="7" type="text" placeholder="••••••••••">
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-flex justify-content-end">
                            <button class="btn btn-primary" onclick="editarCliente(<?= $_SESSION['userData']['id']; ?>);">Salvar</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <hr />
                </div>
                <div>
                    <h4 class="line-head">
                        Pedidos
                    </h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table">
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
                                                <?php for ($i = 0; $i < count($data['pedidos']); $i++) { ?>
                                                    <tr>
                                                        <td><?= $data['pedidos'][$i]['id'] ?></td>
                                                        <td><?= $data['pedidos'][$i]['data'] ?></td>
                                                        <td><?= $data['pedidos'][$i]['total'] ?></td>
                                                        <td><?= $data['pedidos'][$i]['pagamento'] ?></td>
                                                        <td><?= $data['pedidos'][$i]['status'] ?></td>
                                                        <td>
                                                            <div class="text-center">
                                                                <!-- <a title="Ver Pedido" href="<?php ?>" target="_blank" class="btn btn-secondary btn-sm"> -->
                                                                <a title="Ver Pedido" href="http://localhost/blumenaubakery/minhaConta/verPedido/<?= $data['pedidos'][$i]['id'] ?> " target="_blank" class="btn btn-secondary btn-sm">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
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