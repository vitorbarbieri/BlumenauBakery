<?php
headerLoja($data);

if ($data['cliente']['ultima_compra'] == "00/00/0000") {
    $dataUltimaCompra = "";
} else {
    $dataUltimaCompra = $data['cliente']['ultima_compra'];
}

if ($data['cliente']['sexo'] = "M") {
    $sexo = "Masculino";
} else {
    $sexo = "Feminino";
}

if ($data['cliente']['status'] == 1) {
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
                                        <input class="form-control" id="txtNome" name="txtNome" tabindex="1" type="text" value="<?= $data['cliente']['nome']; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Data Nascimento</label>
                                        <input class="form-control" type="text" value="<?= $data['cliente']['data_nascimento']; ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Sexo</label>
                                        <input class="form-control" type="text" value="<?= $sexo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="txtEmail">E-mail</label>
                                        <input class="form-control" id="txtEmail" name="txtEmail" tabindex="2" type="text" value="<?= $data['cliente']['email']; ?>">
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
                                        <input class="form-control" id="txtEndereço" name="txtEndereço" tabindex="3" type="text" value="<?= $data['cliente']['endereco']; ?>">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="control-label" for="txtNumero">Numero</label>
                                        <input class="form-control" id="txtNumero" name="txtNumero" tabindex="4" type="text" value="<?= $data['cliente']['numero']; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label" for="txtCep">Cep</label>
                                        <input class="form-control" id="txtCep" name="txtCep" tabindex="5" type="text" value="<?= $data['cliente']['cep']; ?>">
                                    </div>
                                </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label class="control-label" for="txtBairro">Bairro</label>
                                <input class="form-control" id="txtBairro" name="txtBairro" tabindex="3" type="text" value="<?= $data['cliente']['bairro']; ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label class="control-label" for="txtCidade">Cidade</label>
                                <input class="form-control" id="txtCidade" name="txtCidade" tabindex="4" type="text" value="<?= $data['cliente']['cidade']; ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label" for="listEstado">Estado</label>
                                <select class="form-control" id="listEstado" name="listEstado">
                                    <option style="color: black;" value="1" <?= $data['cliente']['estado'] == 1 ? "selected" : ""; ?>>AC</option>
                                    <option style="color: black;" value="2" <?= $data['cliente']['estado'] == 2 ? "selected" : ""; ?>>AL</option>
                                    <option style="color: black;" value="3" <?= $data['cliente']['estado'] == 3 ? "selected" : ""; ?>>AP</option>
                                    <option style="color: black;" value="4" <?= $data['cliente']['estado'] == 4 ? "selected" : ""; ?>>AM</option>
                                    <option style="color: black;" value="5" <?= $data['cliente']['estado'] == 5 ? "selected" : ""; ?>>BA</option>
                                    <option style="color: black;" value="6" <?= $data['cliente']['estado'] == 6 ? "selected" : ""; ?>>CE</option>
                                    <option style="color: black;" value="7" <?= $data['cliente']['estado'] == 7 ? "selected" : ""; ?>>DF</option>
                                    <option style="color: black;" value="8" <?= $data['cliente']['estado'] == 8 ? "selected" : ""; ?>>ES</option>
                                    <option style="color: black;" value="9" <?= $data['cliente']['estado'] == 9 ? "selected" : ""; ?>>GO</option>
                                    <option style="color: black;" value="10" <?= $data['cliente']['estado'] == 10 ? "selected" : ""; ?>>MA</option>
                                    <option style="color: black;" value="11" <?= $data['cliente']['estado'] == 11 ? "selected" : ""; ?>>MT</option>
                                    <option style="color: black;" value="12" <?= $data['cliente']['estado'] == 12 ? "selected" : ""; ?>>MS</option>
                                    <option style="color: black;" value="13" <?= $data['cliente']['estado'] == 13 ? "selected" : ""; ?>>MG</option>
                                    <option style="color: black;" value="14" <?= $data['cliente']['estado'] == 14 ? "selected" : ""; ?>>PA</option>
                                    <option style="color: black;" value="15" <?= $data['cliente']['estado'] == 15 ? "selected" : ""; ?>>PB</option>
                                    <option style="color: black;" value="16" <?= $data['cliente']['estado'] == 16 ? "selected" : ""; ?>>PR</option>
                                    <option style="color: black;" value="17" <?= $data['cliente']['estado'] == 17 ? "selected" : ""; ?>>PE</option>
                                    <option style="color: black;" value="18" <?= $data['cliente']['estado'] == 18 ? "selected" : ""; ?>>PI</option>
                                    <option style="color: black;" value="19" <?= $data['cliente']['estado'] == 19 ? "selected" : ""; ?>>RJ</option>
                                    <option style="color: black;" value="20" <?= $data['cliente']['estado'] == 20 ? "selected" : ""; ?>>RN</option>
                                    <option style="color: black;" value="21" <?= $data['cliente']['estado'] == 21 ? "selected" : ""; ?>>RS</option>
                                    <option style="color: black;" value="22" <?= $data['cliente']['estado'] == 22 ? "selected" : ""; ?>>RO</option>
                                    <option style="color: black;" value="23" <?= $data['cliente']['estado'] == 23 ? "selected" : ""; ?>>RR</option>
                                    <option style="color: black;" value="24" <?= $data['cliente']['estado'] == 24 ? "selected" : ""; ?>>SC</option>
                                    <option style="color: black;" value="25" <?= $data['cliente']['estado'] == 25 ? "selected" : ""; ?>>SP</option>
                                    <option style="color: black;" value="26" <?= $data['cliente']['estado'] == 26 ? "selected" : ""; ?>>SE</option>
                                    <option style="color: black;" value="27" <?= $data['cliente']['estado'] == 27 ? "selected" : ""; ?>>TO</option>
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
                            <button class="btn btn-primary" onclick="editarCliente(<?= $data['cliente']['id']; ?>);">Salvar</button>
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