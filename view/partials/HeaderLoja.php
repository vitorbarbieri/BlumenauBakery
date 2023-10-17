<?php
$qtdCarrinho = 0;
if (isset($_SESSION['arrCarrinho']) && count($_SESSION['arrCarrinho']) > 0) {
    foreach ($_SESSION['arrCarrinho'] as $produto) {
        $qtdCarrinho += $produto['quantidade'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?= $data['page_tag'] ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= media(); ?>/loja/img/icons/favicon.png" />
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/fonts/linearicons-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/MagnificPopup/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/loja/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/css/style.css">
</head>

<body class="animsition">
    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Entrega grátis para compra acima de R$100,00
                    </div>
                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            Minha Conta
                        </a>
                        <a href="<?= base_url() ?>/logout" class="flex-c-m trans-04 p-lr-25">
                            <?php if (isset($_SESSION['loginCliente'])) { ?>
                                Sair
                            <?php } else { ?>
                                Entrar
                            <?php } ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">
                    <!-- Logo desktop -->
                    <a href="<?= base_url(); ?>" class="logo">
                        <img src="<?= media(); ?>/loja/img/icons/logo.png" alt="Logo">
                    </a>
                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="<?= base_url(); ?>">Home</a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>/loja">Loja</a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>/sobre">Sobre</a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>/contato">Contato</a>
                            </li>
                        </ul>
                    </div>
                    <?php if ($data['page_name'] != "carrinho") { ?>
                        <!-- Icon header -->
                        <div class="wrap-icon-header flex-w flex-r-m">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                                <i class="zmdi zmdi-search"></i>
                            </div>

                            <div id="qtdCarrinho" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= $qtdCarrinho ?>">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>
                    <?php } ?>
                </nav>
            </div>
        </div>
        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="<?= base_url(); ?>">
                    <img src="<?= media(); ?>/loja/img/icons/logo.png" alt="Logo">
                </a>
            </div>
            <?php if ($data['page_name'] != "carrinho") { ?>
                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                    <div id="qtdCarrinho" class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= $qtdCarrinho ?>">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            <?php } ?>
            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        Entrega grátis para compra acima de R$100,00
                    </div>
                </li>
                <li>
                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            Minha Conta
                        </a>
                        <a href="<?= base_url() ?>/logout" class="flex-c-m p-lr-10 trans-04">
                            <?php if (isset($_SESSION['loginCliente'])) { ?>
                                Sair
                            <?php } else { ?>
                                Entrar
                            <?php } ?>
                        </a>
                    </div>
                </li>
            </ul>
            <ul class="main-menu-m">
                <li>
                    <a href="<?= base_url(); ?>">Home</a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/loja">Loja</a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/sobre">Sobre</a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>/contato">Contato</a>
                </li>
            </ul>
        </div>
        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="<?= media(); ?>/loja/images/icons/icon-close2.png" alt="CLOSE">
                </button>
                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Buscar...">
                </form>
            </div>
        </div>
    </header>

    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Seu carrinho
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div id="produtosCarrinho" class="header-cart-content flex-w js-pscroll">
                <?php getModal('CarrinhoModal', $data); ?>
            </div>
        </div>
    </div>