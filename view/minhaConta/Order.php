<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= media(); ?>/img/favicon.ico" type="image/x-icon">
    <title><?= $data['page_tag'] ?></title>
    <!-- Bootstrap-select -->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/css/bootstrap-select.min.css">
    <!-- https://jqueryui.com/ -->
    <script type="text/javascript" src="<?= media(); ?>/js/datepicker/jquery-ui.min.css"></script>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/css/style.css">
</head>

<body>
    <main style="margin: 20px 50px;">
        <div>
            <div>
                <h1>
                    <i class="fa fa-dashboard"></i>&nbsp;
                    <?= $data['page_title'] ?>
                </h1>
            </div>
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
                                    <h5>De:</h5>
                                    <address>
                                        <strong><?= NOME_EMPRESA; ?></strong><br>
                                        <?= ENDERECO ?><br>
                                        <?= TELEFONE ?><br>
                                        <?= EMAIL ?><br>
                                        <?= SITE ?>
                                    </address>
                                </div>
                                <div class="col-4">
                                    <h5>Para:</h5>
                                    <address>
                                        <strong><?= $cliente['nome'] ?></strong><br>
                                        Endereço: <?= $pedido['endereco_entrega']; ?><br>
                                        E-mail: <?= $cliente['email'] ?>
                                    </address>
                                </div>
                                <div class="col-4">
                                    <h5>Informações:</h5>
                                    <b>Orden #<?= $pedido['id'] ?></b><br>
                                    <b>Pagamento: </b><?= $pedido['pagamento'] ?><br>
                                    <b>Status:</b> <?= $pedido['descricao'] ?> <br>
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
</body>


<!-- Font Awesome -->
<script src="<?= media(); ?>/js/fontawesome.js"></script>

</html>