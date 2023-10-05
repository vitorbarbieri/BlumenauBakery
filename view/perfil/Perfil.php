<?= headerAdmin($data); ?>
<?= navAdmin($data); ?>
<?php getModal("PerfilModal", $data); ?>

<main class="app-content">
    <div class="row user">
        <div class="col-md-12">
            <div class="profile">
                <div class="info"><img class="user-img" src="<?= media(); ?>/img/avatar.png">
                    <h4><?= $_SESSION['userData']['nome'] . $_SESSION['userData']['sobrenome'] ?></h4>
                    <p><?= $_SESSION['userData']['nomeCargo'] ?></p>
                </div>
                <div class="cover-image"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Dados Pessoais</a></li>
                    <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Configurações</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                    <div class="tile user-settings">
                        <div class="post-media"><a href="#"></a>
                            <div class="content">
                                <h4 class="line-head">
                                    Dados Pessoais&numsp;
                                    <button class="btn btn-sm btn-info" type="button" onclick="openModalPerfil();">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </h4>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:150px;">CPF:</td>
                                    <td><?= $_SESSION['userData']['cpf']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nome:</td>
                                    <td><?= $_SESSION['userData']['nome']; ?></td>
                                </tr>
                                <tr>
                                    <td>Sobrenome:</td>
                                    <td><?= $_SESSION['userData']['sobrenome']; ?></td>
                                </tr>
                                <tr>
                                    <td>Telefone:</td>
                                    <td><?= $_SESSION['userData']['telefone']; ?></td>
                                </tr>
                                <tr>
                                    <td>E-mail:</td>
                                    <td><?= $_SESSION['userData']['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Cargo:</td>
                                    <td><?= $_SESSION['userData']['nomeCargo']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-settings">
                    <div class="tile user-settings">
                        <h4 class="line-head">
                            Configurações&numsp;
                            <button class="btn btn-sm btn-info" type="button" onclick="modalFormPerfilConfig();">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </h4>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:150px;">Senha:</td>
                                    <td>••••••••••</td>
                                </tr>
                                <tr>
                                    <td>Pergunta Secreta:</td>
                                    <td><?= $_SESSION['userData']['pergunta']; ?></td>
                                </tr>
                                <tr>
                                    <td>Resposta:</td>
                                    <td><?= $_SESSION['userData']['resposta']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= footerAdmin($data); ?>