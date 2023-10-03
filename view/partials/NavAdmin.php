<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="<?= media(); ?>/img/avatar.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">Vitor Barbieri</p>
            <p class="app-sidebar__user-designation">Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/cliente">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Usuários</span>
            </a>
        </li>
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
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out"></i>
                <span class="app-menu__label">Logouts</span>
            </a>
        </li>
    </ul>
</aside>