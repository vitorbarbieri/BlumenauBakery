<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= media(); ?>/img/favicon.ico" type="image/x-icon">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <title><?= $data['page_tag'] ?></title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1><?= $data['page_title'] ?></h1>
        </div>
        <div class="login-box">
            <form class="login-form" name="formLogin" id="formLogin">
                <h3 class="login-head">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    Iniciar Sessão
                </h3>
                <div class="form-group">
                    <label class="control-label">Usuário</label>
                    <input id="txtEmail" name="txtEmail" class="form-control valid validLogin" type="text" placeholder="Digite seu e-mail" onblur="alteraClassInvalido();">
                </div>
                <div class="form-group">
                    <label class="control-label">Senha</label>
                    <div style="display: flex; align-items: center;">
                        <input id="txtSenha" name="txtSenha" class="form-control valid validLogin" type="password" placeholder="Digite sua senha" onblur="alteraClassInvalido();">
                        &nbsp;
                        <i class="fa-solid fa-eye imgSenha" onclick="mostrarSenha();"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="utility">
                        <p class="semibold-text mb-2">
                            <a href="#" data-toggle="flip">Esqueceu a senha?</a>
                        </p>
                    </div>
                </div>
                <div id="alertLogin" class="text-center"></div>
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa-solid fa-right-to-bracket"></i>&numsp;
                        Entrar
                    </button>
                </div>
            </form>
            <form id="formRecetPass" name="formRecetPass" class="forget-form">
                <h3 class="login-head">
                    <i class="fa fa-lg fa-fw fa-lock"></i>
                    Esqueceu a senha?
                </h3>
                <div class="form-group">
                    <label class="control-label">E-mail</label>
                    <input id="txtEmailReset" name="txtEmailReset" class="form-control valid validReset" type="text" placeholder="Digite seu e-mail" onblur="alteraClassInvalido();">
                </div>
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa-solid fa-unlock"></i>&numsp;
                        Reiniciar
                    </button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0">
                        <a href="#" data-toggle="flip">
                            <i class="fa-solid fa-angle-left"></i>&numsp;
                            Voltar ara Login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>
    <script>
        const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/functionsAdmin.js"></script>
    <!-- Sweet alert 2 - https://sweetalert2.github.io/ -->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>

    <script src="<?= media(); ?>/js/<?= $data['page_functions_js'] ?>"></script>
</body>

</html>