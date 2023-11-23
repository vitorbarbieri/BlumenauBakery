<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-6 align-content-center p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CATEGORIAS
                </h4>
                <ul>
                    <li class="p-b-10">
                        <a href="<?= base_url() . '/loja/categoria/1/Bebidas' ?>" class="stext-107 cl7 hov-cl1 trans-04">
                            Bebidas
                        </a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= base_url() . '/loja/categoria/2/Salgados' ?>" class="stext-107 cl7 hov-cl1 trans-04">
                            Salgados
                        </a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= base_url() . '/loja/categoria/3/Doces' ?>" class="stext-107 cl7 hov-cl1 trans-04">
                            Doces
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-6 align-content-center p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CONTATO
                </h4>
                <p class="stext-107 cl7 size-218">
                    <?= ENDERECO ?><br />
                    <?= TELEFONE ?><br />
                    <?= EMAIL ?><br />
                    <?= SITE ?>
                </p>
                <div class="p-t-27">
                    <a href="https://facebook.com" class="fs-18 cl7 hov-cl1 trans-04 m-r-16" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="https://instagram.com" class="fs-18 cl7 hov-cl1 trans-04 m-r-16" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="p-t-10 size-111 m-b-10">
                <p class="stext-107 cl6 txt-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                </p>
            </div>
        </div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<script>
    const base_url = "<?= base_url(); ?>";
    const smony = "<?= SMONEY . " "; ?>";
</script>

<script src="<?= media() ?>/loja/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?= media() ?>/loja/vendor/animsition/js/animsition.min.js"></script>
<script src="<?= media() ?>/loja/vendor/bootstrap/js/popper.js"></script>
<script src="<?= media() ?>/loja/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= media() ?>/loja/vendor/select2/select2.min.js"></script>
<script src="<?= media() ?>/loja/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= media() ?>/loja/vendor/daterangepicker/daterangepicker.js"></script>
<script src="<?= media() ?>/loja/vendor/slick/slick.min.js"></script>
<script src="<?= media() ?>/loja/js/slick-custom.js"></script>
<script src="<?= media() ?>/loja/vendor/parallax100/parallax100.js"></script>
<script src="<?= media() ?>/loja/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script src="<?= media() ?>/loja/vendor/isotope/isotope.pkgd.min.js"></script>
<!-- Sweet alert 2 - https://sweetalert2.github.io/ -->
<script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>
<!-- Font Awesome -->
<script src="<?= media(); ?>/js/fontawesome.js"></script>

<script src="<?= media() ?>/loja/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= media() ?>/loja/js/main.js"></script>
<script src="<?= media() ?>/loja/js/functions.js"></script>
<script src="<?= media() ?>/loja/js/minhaConta.js"></script>

</body>

</html>