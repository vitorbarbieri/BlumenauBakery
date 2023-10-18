<!-- Modal -->
<div class="modal fade" id="modalFormPedido" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModal">Atualizar Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUpdatePedido" name="formUpdatePedido" class="form-horizontal">
                    <input type="hidden" id="idPedido" name="idPedido" value="<?= $data['pedido']['id'] ?>">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="210">Nº Pedido:</td>
                                <td><?= $data['pedido']['id'] ?></td>
                            </tr>
                            <tr>
                                <td>Cliente:</td>
                                <td><?= $data['cliente']['nome'] ?></td>
                            </tr>
                            <tr>
                                <td>Valor Total:</td>
                                <td><?= SMONEY . ' ' . $data['pedido']['total'] ?></td>
                            </tr>
                            <tr>
                                <td>Tipo Pagamento:</td>
                                <td><?= $data['pedido']['pagamento'] ?></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>
                                    <select name="listEstado" id="listEstado" class="form-control">
                                        <?php
                                        for ($i = 0; $i < count($data['statusPedido']); $i++) {
                                            $selected = "";
                                            if ($data['statusPedido'][$i]['id'] == $data['pedido']['status']) {
                                                $selected = " selected ";
                                            }
                                        ?>
                                            <option value="<?= $data['statusPedido'][$i]['id'] ?>" <?= $selected ?>><?= $data['statusPedido'][$i]['descricao'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span>Atualizar</span></button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>