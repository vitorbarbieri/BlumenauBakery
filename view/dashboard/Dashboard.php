<?= headerAdmin($data); ?>
<?= navAdmin($data); ?>

<div id="divModal"></div>
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
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/usuario" class="linkw">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Usuários</h4>
                        <p><b><?= $data['usuarios'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/cliente" class="linkw">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
                    <div class="info">
                        <h4>Clientes</h4>
                        <p><b><?= $data['clientes'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/produto" class="linkw">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
                    <div class="info">
                        <h4>Produtos</h4>
                        <p><b><?= $data['produtos'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/pedido" class="linkw">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
                    <div class="info">
                        <h4>Pedidos</h4>
                        <p><b><?= $data['pedidos'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Últimos Pedidos</h3>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Tipo Pagamento</th>
                            <th>Status</th>
                            <th class="text-right">Valor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($data['lastOrders']) > 0) {
                            foreach ($data['lastOrders'] as $pedido) {
                        ?>
                                <tr>
                                    <td><?= $pedido['id'] ?></td>
                                    <td><?= $pedido['nome'] ?></td>
                                    <td><?= $pedido['data'] ?></td>
                                    <td><?= $pedido['pagamento'] ?></td>
                                    <?php
                                    if ($pedido['descricao'] == "Pedido Entregue") {
                                    ?>
                                        <td><?= $pedido['descricao'] ?></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td style="color: red; cursor: pointer;" onclick="editarStatus(<?= $pedido['id'] ?>)"><?= $pedido['descricao'] ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td class="text-right"><?= formatMoney($pedido['total']) ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>/pedido/verPedido/<?= $pedido['id'] ?>" target="_blank">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <div class="container-title">
                    <h3 class="tile-title">Tipo de Pagos por Mês</h3>
                    <div class="dflex">
                        <input class="date-picker pagoMes" name="pagoMes" placeholder="Mês e Ano">
                        <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchPagos()"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div id="pagosMesAno"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="container-title">
                    <h3 class="tile-title">Vendas por Mês</h3>
                    <div class="dflex">
                        <input class="date-picker vendasMes" name="vendasMes" placeholder="Mês e Ano">
                        <button type="button" class="btnVendasMes btn btn-info btn-sm" onclick="fntSearchVMes()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div id="graficaMes"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <div class="container-title">
                    <h3 class="tile-title">Vendas por Ano</h3>
                    <div class="dflex">
                        <input class="vendasAno" name="vendasAno" placeholder="Ano" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
                        <button type="button" class="btnVendasAno btn btn-info btn-sm" onclick="fntSearchVAno()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div id="graficaAno"></div>
            </div>
        </div>
    </div>
</main>

<?= footerAdmin($data); ?>

<script>
    Highcharts.chart('pagosMesAno', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Vendas por Tipo de Pagamento - <?= $data['pagosMes']['mes'] . ' de ' . $data['pagosMes']['ano'] ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.2f} %'
                }
            }
        },
        series: [{
            name: 'Qtd',
            colorByPoint: true,
            data: [
                <?php
                foreach ($data['pagosMes']['tipospago'] as $pagos) {
                    echo "{name:'" . $pagos['descricao'] . "', y:" . $pagos['total'] . "},";
                }
                ?>
            ]
        }]
    });

    Highcharts.chart('graficaMes', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Vendas de <?= $data['vendasMDia']['mes'] . ' de ' . $data['vendasMDia']['ano'] ?> - (Pedidos Entregue)'
        },
        subtitle: {
            text: 'Total Vendas <?= formatMoney($data['vendasMDia']['total']) ?> '
        },
        xAxis: {
            categories: [
                <?php
                foreach ($data['vendasMDia']['vendas'] as $dia) {
                    echo $dia['dia'] . ",";
                }
                ?>
            ]
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Valor Total (R$)',
            data: [
                <?php
                foreach ($data['vendasMDia']['vendas'] as $dia) {
                    echo $dia['total'] . ",";
                }
                ?>
            ]
        }]
    });

    Highcharts.chart('graficaAno', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Vendas do Ano <?= $data['vendasAno']['ano'] ?> - (Pedidos Entregue)'
        },
        subtitle: {
            text: 'Estatísticas de Vendas por Ano'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total: <b>R$ {point.y:.2f}</b>'
        },
        series: [{
            name: 'Population',
            data: [
                <?php
                foreach ($data['vendasAno']['meses'] as $mes) {
                    echo "['" . $mes['mes'] . "'," . $mes['venda'] . "],";
                }
                ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.2f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
</script>