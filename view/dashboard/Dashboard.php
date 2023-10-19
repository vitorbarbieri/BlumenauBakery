<?= headerAdmin($data); ?>
<?= navAdmin($data); ?>

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
                        <h4>Usuarios</h4>
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
                        <h4>Productos</h4>
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
                                    <td><?= $pedido['descricao'] ?></td>
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
    </div>
</main>

<?= footerAdmin($data); ?>