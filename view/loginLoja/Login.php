<!doctype html>
<html lang="pt-br">

<head>
    <title><?= $data['page_tag'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= media(); ?>/css/loginLoja.css">

</head>

<body class="img js-fullheight" style="background-image: url(<?= media(); ?>/img/bgLoginLoja.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <img src="<?= media(); ?>/loja/img/icons/logo.png" alt="Logo">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form id="formLogin" name="formLogin" class="signin-form">
                            <h3 class="mb-4 text-center">LOGIN</h3>
                            <div class="form-group">
                                <input id="txtEmail" name="txtEmail" type="text" class="form-control" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input id="txtSenha" name="txtSenha" id="password-field" type="password" class="form-control" placeholder="Senha">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">
                                    <i class="fa-solid fa-right-to-bracket"></i>&numsp;
                                    Entrar
                                </button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <a href="">Não tenho conta</a>
                                </div>
                                <div class="w-50 text-center">
                                    <a href="#">Esquece sua senha?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const base_url = "<?= base_url(); ?>";
    </script>

    <script src="<?= media(); ?>/js/jqueryLoja.js"></script>
    <script src="<?= media(); ?>/js/popperLoja.js"></script>
    <script src="<?= media(); ?>/js/bootstrapLoja.js"></script>
    <script src="<?= media(); ?>/js/mainLoja.js"></script>
    <!-- Font Awesome -->
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <!-- Sweet alert 2 - https://sweetalert2.github.io/ -->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>

    <script src="<?= media(); ?>/js/<?= $data['page_functions_js'] ?>"></script>

</body>

</html>