<?= headerAdmin($data); ?>
<?= navAdmin($data); ?>
<?php // getModal('ProdutoModal', $data); ?>

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
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablePedido">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Data</th>
                                    <th>Cliente</th>
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
</main>

<?= footerAdmin($data); ?>