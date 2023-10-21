<?php
headerLoja($data);
$arrProduto = $data['produto'];
$arrProdutos = $data['produtos'];
$arrImages = $arrProduto['images'];
?>

<br /><br /><br />
<hr />

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="<?= base_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
            Inicio
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <a href="<?= base_url() . '/loja/categoria/' . $arrProduto['id_categoria'] . "/" . $arrProduto['cNome']; ?>" class="stext-109 cl8 hov-cl1 trans-04">
            <?= $arrProduto['cNome'] ?>
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">
            <?= $arrProduto['nome'] ?>
        </span>
    </div>
</div>

<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                        <div class="slick3 gallery-lb">
                            <?php
                            if (!empty($arrImages)) {
                                for ($img = 0; $img < count($arrImages); $img++) {
                            ?>
                                    <div class="item-slick3" data-thumb="<?= $arrImages[$img]['url_image']; ?>">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="<?= $arrImages[$img]['url_image']; ?>" alt="<?= $arrProducto['nome']; ?>">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?= $arrImages[$img]['url_image']; ?>">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        <?= $arrProduto['nome'] ?>
                    </h4>
                    <span class="mtext-106 cl2">
                        <?= formatMoney($arrProduto['preco']); ?>
                    </span>
                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>
                                    <input id="qtdProduto" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" min="1">
                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                                <button id="<?= openssl_encrypt($arrProduto['id'], METHODENCRIPT, KEY); ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10 h4">
                        <b>Descrição</b>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                <?= $arrProduto['descricao'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <h3>Produtos Relacionados</h3>
    </div>
</section>
<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                <?php
                if (!empty($arrProdutos)) {
                    for ($p = 0; $p < count($arrProdutos); $p++) {
                        if (count($arrProdutos[$p]['images']) > 0) {
                            $portada = $arrProdutos[$p]['images'][0]['url_image'];
                        } else {
                            $portada = media() . '/img/uploads/produto.png';
                        }
                ?>
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="<?= $portada ?>" alt="<?= $arrProdutos[$p]['nome'] ?>">

                                    <a href="<?= base_url() . '/loja/produto/' . $arrProdutos[$p]['id']; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                        Ver Produto
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            <?= $arrProdutos[$p]['nome'] ?>
                                        </a>
                                        <span class="stext-105 cl3">
                                            <?= formatMoney($arrProdutos[$p]['preco']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>
<?= footerLoja($data); ?>