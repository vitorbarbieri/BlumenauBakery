<?php
$total = 0;
if (isset($_SESSION['arrCarrinho']) && count($_SESSION['arrCarrinho']) > 0) {
?>
    <ul class="header-cart-wrapitem w-full">
        <?php
        foreach ($_SESSION['arrCarrinho'] as $produto) {
            $total += $produto['quantidade'] * $produto['preco'];
            $idProduto = openssl_encrypt($produto['idProduto'], METHODENCRIPT, KEY);
        ?>
            <li class="header-cart-item flex-w flex-t m-b-12">
                <div class="header-cart-item-img" idpr="<?= $idProduto ?>" op="1" onclick="fntdelItem(this);">
                    <img src="<?= $produto['imagem'] ?>" alt="<?= $produto['produto'] ?>">
                </div>
                <div class="header-cart-item-txt p-t-8">
                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                        <?= $produto['produto'] ?>
                    </a>
                    <span class="header-cart-item-info">
                        <?= $produto['quantidade'] . " x " . formatMoney($produto['preco']) ?>
                    </span>
                </div>
            </li>
        <?php } ?>
    </ul>

    <div class="w-full">
        <div class="header-cart-total w-full p-tb-40">
            Total: <?= formatMoney($total) ?>
        </div>
        <div class="header-cart-buttons flex-w w-full">
            <a href="<?= base_url() ?>/carrinho" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                Ver Carrinho
            </a>
            <a href="<?= base_url() ?>/processarpago" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                Pagar
            </a>
        </div>
    </div>
<?php } ?>