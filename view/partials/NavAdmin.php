<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="<?= media(); ?>/img/avatar.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nome'] ?></p>
            <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nomeCargo'] ?></p>
        </div>
    </div>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>" target="_blank">
                <i class="app-menu__icon fa fa-globe"></i>
                <span class="app-menu__label">Ver Site</span>
            </a>
        </li>
    <ul class="app-menu">
        <?php if ($_SESSION['userData']['idCargo'] == 1) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['userData']['idCargo'] == 1) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/usuario">
                    <i class="app-menu__icon fa-solid fa-users"></i>
                    <span class="app-menu__label">Usuários</span>
                </a>
            </li>
        <?php } ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/cliente">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Clientes</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/produto">
                <i class="app-menu__icon fa fa-archive"></i>
                <span class="app-menu__label">Produtos</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/pedido">
                <i class="app-menu__icon fa fa-shopping-cart"></i>
                <span class="app-menu__label">Pedidos</span>
            </a>
        </li>
    </ul>
</aside>