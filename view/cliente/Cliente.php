<?= headerAdmin($data); ?>
<?= navAdmin($data); ?>
<?php getModal('ClienteModal', $data); ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-user"></i>&nbsp;
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
                        <table class="table table-hover table-bordered" id="tableCliente">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Última Compra</th>
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