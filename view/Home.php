<?php
headerLoja($data);
$arrProdutos = $data['produtos'];
?>

<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            <div class="item-slick1 fundo-fosco" style="background-image: url(<?= media() ?>/loja/img/banner-1.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                Blumenau Bakery
                            </span>
                        </div>
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                Bebidas
                            </h2>
                        </div>
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="<?= base_url() . '/loja/categoria/1/Bebidas' ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Comprar Agora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-slick1" style="background-image: url(<?= media() ?>/loja/img/banner-2.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                Blumenau Bakery
                            </span>
                        </div>
                        <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                Salgados
                            </h2>
                        </div>
                        <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                            <a href="<?= base_url() . '/loja/categoria/2/Salgados' ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Comprar Agora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-slick1" style="background-image: url(<?= media() ?>/loja/img/banner-3.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                Blumenau Bakery
                            </span>
                        </div>
                        <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                Doces
                            </h2>
                        </div>
                        <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                            <a href="<?= base_url() . '/loja/categoria/3/Doces' ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Comprar Agora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1">
                    <img src="<?= media() ?>/loja/img/banner-bebidas.jpg" alt="IMG-BANNER">
                    <a href="<?= base_url() . '/loja/categoria/1/Bebidas' ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Bebidas
                            </span>
                        </div>
                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Comprar Agora
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1">
                    <img src="<?= media() ?>/loja/img/banner-salgados.jpg" alt="IMG-BANNER">
                    <a href="<?= base_url() . '/loja/categoria/2/Salgados' ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Salgados
                            </span>
                        </div>
                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Comprar Agora
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1">
                    <img src="<?= media() ?>/loja/img/banner-doces.jpg" alt="IMG-BANNER">
                    <a href="<?= base_url() . '/loja/categoria/3/Doces' ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Doces
                            </span>
                        </div>
                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Comprar Agora
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Produtos Novos
            </h3>
        </div>
        <hr>
        <div class="row isotope-grid">
            <?php
            for ($i = 0; $i < count($arrProdutos); $i++) {
                if (count($arrProdutos[$i]['images']) > 0) {
                    $portada = $arrProdutos[$i]['images'][0]['url_image'];
                } else {
                    $portada = media() . '/img/uploads/produto.png';
                }
            ?>
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item container-produto">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="<?= $portada ?>" alt="<?= $arrProdutos[$i]['nome'] ?>">
                            <a href="<?= base_url() . '/loja/produto/' . $arrProdutos[$i]['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                Quick View
                            </a>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="<?= base_url() . '/loja/produto/' . $arrProdutos[$i]['id'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 p-r-5">
                                    <?= $arrProdutos[$i]['nome'] ?>
                                </a>
                                <span class="stext-105 cl3">
                                    <?= formatMoney($arrProdutos[$i]['preco']); ?>
                                </span>
                            </div>
                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" id="<?= openssl_encrypt($arrProdutos[$i]['id'], METHODENCRIPT, KEY); ?>" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</section>

<?= footerLoja($data); ?>