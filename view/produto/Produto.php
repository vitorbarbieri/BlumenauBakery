<?= headerAdmin($data); ?>
<?= navAdmin($data); ?>
<?php getModal('ProdutoModal', $data); ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-dashboard"></i>&nbsp;
                <?= $data['page_title'] ?>&numsp;
                <button class="btn btn-primary" type="button" onclick="openModal();">
                    <i class="fa-solid fa-circle-plus"></i>&nbsp;
                    Novo
                </button>
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
                        <table class="table table-hover table-bordered" id="tableProduto">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Estoque</th>
                                    <th>Preço</th>
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