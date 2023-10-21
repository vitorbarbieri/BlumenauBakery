<?php
headerLoja($data);
$arrProdutos = $data['produtos'];
?>

<br /><br /><br />
<hr />

<!-- Product -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <h3><?= $data['page_title'] ?></h3>
            </div>
        </div>

        <div class="row isotope-grid">
            <?php
            if (!empty($arrProdutos)) {
                for ($i = 0; $i < count($arrProdutos); $i++) {
                    if (count($arrProdutos[$i]['images']) > 0) {
                        $portada = $arrProdutos[$i]['images'][0]['url_image'];
                    } else {
                        $portada = media() . '/img/uploads/produto.png';
                    }
            ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="<?= $portada ?>" alt="<?= $arrProdutos[$i]['nome'] ?>" alt="IMG-PRODUCT">
                                <a href="<?= base_url() . '/loja/produto/' . $arrProdutos[$i]['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    Ver Produto
                                </a>
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l">
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
            <?php
                }
            } else {
                echo "Não há produtos a ser exibido";
            }
            ?>
        </div>

        <!-- Load more -->
        <?php
        if (count($data['produtos']) > 0) {
            $prevPagina = $data['pagina'] - 1;
            $nextPagina = $data['pagina'] + 1;
        ?>
            <div class="flex-c-m flex-w w-full p-t-45">
                <?php if ($data['pagina'] > 1) { ?>
                    <a href="<?= base_url() ?>/loja/search?p=<?= $prevPagina ?>&s=<?= $data['busca'] ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        <i class="fa-solid fa-chevron-left"></i>&numsp;
                        Anterior
                    </a>&numsp;&numsp;&numsp;
                <?php } ?>
                <?php if ($data['pagina'] != $data['total_paginas']) { ?>
                    <a href="<?= base_url() ?>/loja/search?p=<?= $nextPagina ?>&s=<?= $data['busca'] ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        Próxima&numsp;
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                <?php } ?>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?= footerLoja($data); ?>