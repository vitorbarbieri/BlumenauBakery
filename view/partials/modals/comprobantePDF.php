<?php
$cliente = $data['cliente'];
$pedido = $data['pedido'];
$detalhe = $data['detalhe_pedido'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura</title>
    <style>
        table {
            width: 100%;
        }

        table td,
        table th {
            font-size: 12px;
        }

        h4 {
            margin-bottom: 0px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .wd33 {
            width: 33.33%;
        }

        .tbl-cliente {
            border: 1px solid #CCC;
            border-radius: 10px;
            padding: 5px;
        }

        .wd10 {
            width: 10%;
        }

        .wd15 {
            width: 15%;
        }

        .wd25 {
            width: 25%;
        }

        .wd40 {
            width: 40%;
        }

        .wd50 {
            width: 50%;
        }

        .wd55 {
            width: 55%;
        }

        .tbl-detalle {
            border-collapse: collapse;
        }

        .tbl-detalle thead th {
            padding: 5px;
            background-color: #009688;
            color: #FFF;
        }

        .tbl-detalle tbody td {
            border-bottom: 1px solid #CCC;
            padding: 5px;
        }

        .tbl-detalle tfoot td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <table class="tbl-hader">
        <tbody>
            <tr>
                <td class="wd25">
                    <!-- <img src="<?= media(); ?>/loja/img/icons/logo.png" alt="Logo"> -->
                </td>
                <td class="text-center wd50">
                    <h4><strong><?= NOME_EMPRESA ?></strong></h4><br />
                    <p>
                        <?= ENDERECO ?><br>
                        Telefone: <?= TELEFONE ?> <br>
                        E-mail: <?= EMAIL ?>
                    </p>
                </td>
                <td class="text-right wd25">
                    <p>No. Orden <strong><?= $pedido['id'] ?></strong><br>
                        Fecha: <?= $pedido['data'] ?> <br>
                        Tipo Pagamento: <?= $pedido['pagamento'] ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="tbl-cliente">
        <tbody>
            <tr>
                <td class="wd10">E-mail:</td>
                <td class="wd40"><?= $cliente['email'] ?></td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td><?= $cliente['nome'] ?></td>
            </tr>
            <tr>
                <td>Endereço:</td>
                <td><?= $pedido['endereco_entrega'] ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="tbl-detalle">
        <thead>
            <tr>
                <th class="wd55">Descrição</th>
                <th class="wd15 text-right">Preço</th>
                <th class="wd15 text-center">Quantidade</th>
                <th class="wd15 text-right">Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subTotal = 0;
            foreach ($detalhe as $produto) {
                $valor = $produto['preco'] * $produto['quantidade'];
                $subTotal = $subTotal + $valor;
            ?>
                <tr>
                    <td><?= $produto['produto'] ?></td>
                    <td class="text-right"><?= formatMoney($produto['preco']) ?></td>
                    <td class="text-center"><?= $produto['quantidade'] ?></td>
                    <td class="text-right"><?= formatMoney($valor) ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">Subtotal:</td>
                <td class="text-right"><?= formatMoney($subTotal) ?></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Entrega:</td>
                <td class="text-right"><?= formatMoney($pedido['custo_envio']); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Total:</td>
                <td class="text-right"><?= formatMoney($pedido['total']); ?></td>
            </tr>
        </tfoot>
    </table>
    <div class="text-center">
        <p>Se tem pergunta sobre seu pedido, <br> entre em contato com a gente</p>
        <h4>Obrigado por comprar com a gente!</h4>
    </div>
</body>

</html>