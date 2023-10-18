<?php headerAdmin($data); ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-dashboard"></i>&nbsp;
                <?= $data['page_title'] ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <i class="fa-solid fa-house"></i>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() . '/' . $data['page_name']; ?>">
                    <?= $data['page_name']; ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                if (empty($data['arrPedido'])) {
                ?>
                    <p>Pedido não encontrado</p>
                <?php
                } else {
                    $cliente = $data['arrPedido']['cliente'];
                    $pedido = $data['arrPedido']['pedido'];
                    $detalhe = $data['arrPedido']['detalhe_pedido'];
                ?>
                    <section id="sPedido" class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><img src="<?= media(); ?>/loja/img/icons/logo.png"></h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">
                                    Data: <?= date("d/m/Y", strtotime($pedido['data'])) ?>&numsp;-&numsp;
                                    Hora: <?= date("h:m:s", strtotime($pedido['data'])) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">
                                <address><strong><?= NOME_EMPRESA; ?></strong><br>
                                    <?= ENDERECO ?><br>
                                    <?= TELEFONE ?><br>
                                    <?= EMAIL ?><br>
                                    <?= SITE ?>
                                </address>
                            </div>
                            <div class="col-4">
                                <address><strong><?= $cliente['nome'] ?></strong><br>
                                    Endereço: <?= $pedido['endereco_entrega']; ?><br>
                                    E-mail: <?= $cliente['email'] ?>
                                </address>
                            </div>
                            <div class="col-4">
                                <b>Orden #<?= $pedido['id'] ?></b><br>
                                <b>Pagamento: </b><?= $pedido['pagamento'] ?><br>
                                <b>Status:</b> <?= $pedido['status'] ?> <br>
                                <b>Valor:</b> <?= formatMoney($pedido['total']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Descrição</th>
                                            <th class="text-right">Preço</th>
                                            <th class="text-center">Quantidade</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subTotal = 0;
                                        if (count($detalhe) > 0) {
                                            foreach ($detalhe as $produto) {
                                                $subTotal += $produto['quantidade'] * $produto['preco'];
                                        ?>
                                                <tr>
                                                    <td><?= $produto['produto'] ?></td>
                                                    <td class="text-right"><?= formatMoney($produto['preco']) ?></td>
                                                    <td class="text-center"><?= $produto['quantidade'] ?></td>
                                                    <td class="text-right"><?= formatMoney($produto['quantidade'] * $produto['preco']) ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Sub-Total:</th>
                                            <td class="text-right"><?= formatMoney($subTotal) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Envío:</th>
                                            <td class="text-right"><?= formatMoney($pedido['custo_envio']) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Total:</th>
                                            <td class="text-right"><?= formatMoney($pedido['total']) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <a class="btn btn-primary" href="javascript:window.print('#sPedido');">
                                    <i class="fa fa-print"></i>&nbsp;
                                    Imprimir
                                </a>
                            </div>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php footerAdmin($data); ?>