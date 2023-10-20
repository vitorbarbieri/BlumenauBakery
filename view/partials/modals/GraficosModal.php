<?php
if ($grafica = "tipoPagoMes") {
    $pagosMes = $data;
?>
    <script>
        Highcharts.chart('pagosMesAno', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Vendas por Tipo de Pagamento - <?= $pagosMes['mes'] . ' de ' . $pagosMes['ano'] ?>'
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
                    foreach ($pagosMes['tipospago'] as $pagos) {
                        echo "{name:'" . $pagos['descricao'] . "', y:" . $pagos['total'] . "},";
                    }
                    ?>
                ]
            }]
        });
    </script>
<?php } ?>

<?php
if ($grafica = "vendasMes") {
    $vendasMes = $data;
?>
    <script>
        Highcharts.chart('graficaMes', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Vendas de <?= $vendasMes['mes'] . ' de ' . $vendasMes['ano'] ?> - (Pedidos Entregue)'
            },
            subtitle: {
                text: 'Total Vendas <?= formatMoney($vendasMes['total']) ?> '
            },
            xAxis: {
                categories: [
                    <?php
                    foreach ($vendasMes['vendas'] as $dia) {
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
                    foreach ($vendasMes['vendas'] as $dia) {
                        echo $dia['total'] . ",";
                    }
                    ?>
                ]
            }]
        });
    </script>
<?php } ?>

<?php
if ($grafica = "vendasAno") {
    $ventasAnio = $data;
?>
    <script>
        Highcharts.chart('graficaAnio', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Ventas del año <?= $ventasAnio['anio'] ?> '
            },
            subtitle: {
                text: 'Esdística de ventas por mes'
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
                pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
            },
            series: [{
                name: 'Population',
                data: [
                    <?php
                    foreach ($ventasAnio['meses'] as $mes) {
                        echo "['" . $mes['mes'] . "'," . $mes['venta'] . "],";
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    </script>
<?php } ?>