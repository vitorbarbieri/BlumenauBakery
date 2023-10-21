<?php
headerLoja($data);

$banner = media() . "/loja/img/bg_contato.jpg";
?>

<script>
    document.querySelector("header").classList.add('header-v4');
</script>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
    <h2 class="ltext-105 cl0 txt-center">
        Contato
    </h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form>
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Envie uma Mensagem
                    </h4>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Seu e-mail eletrônico">
                        <img class="how-pos4 pointer-none" src="<?= media() ?>/loja/img/icons/icon-email.png" alt="ICON">
                    </div>

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Como podemos ajudar?"></textarea>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Enviar
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Endereço
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            <?= ENDERECO ?>
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Vamos Conversar
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            <?= TELEFONE ?>
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Suporte
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            <?= SUPORTE ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Map -->
<div class="map m-b-300">
    <div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28466.731830914192!2d-49.098997912713195!3d-26.8926556815055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94df18c3029c59cf%3A0x274ee00fa5617468!2sNeumarkt%20Shopping!5e0!3m2!1spt-BR!2sbr!4v1697929592602!5m2!1spt-BR!2sbr" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<?= footerLoja($data); ?>