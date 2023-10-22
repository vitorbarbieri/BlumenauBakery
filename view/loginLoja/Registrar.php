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
                <div class="col-md-12 col-lg-10">
                    <div class="login-wrap p-0">
                        <form id="formRegister" name="formRegister" class="signin-form">
                            <h3 class="mb-4 text-center">REGISTRAR</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input id="txtNome" name="txtNome" type="text" class="form-control" placeholder="Nome Completo">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="txtEmail" name="txtEmail" type="text" class="form-control" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <input id="txtEndereco" name="txtEndereco" type="text" class="form-control" placeholder="Endereço">
                                </div>
                                <div class="form-group col-md-3">
                                    <input id="txtNumero" name="txtNumero" type="text" class="form-control" placeholder="Número">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <input id="txtBairro" name="txtBairro" type="text" class="form-control" placeholder="Bairro">
                                </div>
                                <div class="form-group col-md-5">
                                    <input id="txtCidade" name="txtCidade" type="text" class="form-control" placeholder="Cidade">
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="listEstado" name="listEstado">
                                        <option style="color: black;" value="0">Estado</option>
                                        <option style="color: black;" value="1">AC</option>
                                        <option style="color: black;" value="2">AL</option>
                                        <option style="color: black;" value="3">AP</option>
                                        <option style="color: black;" value="4">AM</option>
                                        <option style="color: black;" value="5">BA</option>
                                        <option style="color: black;" value="6">CE</option>
                                        <option style="color: black;" value="7">DF</option>
                                        <option style="color: black;" value="8">ES</option>
                                        <option style="color: black;" value="9">GO</option>
                                        <option style="color: black;" value="10">MA</option>
                                        <option style="color: black;" value="11">MT</option>
                                        <option style="color: black;" value="12">MS</option>
                                        <option style="color: black;" value="13">MG</option>
                                        <option style="color: black;" value="14">PA</option>
                                        <option style="color: black;" value="15">PB</option>
                                        <option style="color: black;" value="16">PR</option>
                                        <option style="color: black;" value="17">PE</option>
                                        <option style="color: black;" value="18">PI</option>
                                        <option style="color: black;" value="19">RJ</option>
                                        <option style="color: black;" value="20">RN</option>
                                        <option style="color: black;" value="21">RS</option>
                                        <option style="color: black;" value="22">RO</option>
                                        <option style="color: black;" value="23">RR</option>
                                        <option style="color: black;" value="24">SC</option>
                                        <option style="color: black;" value="25">SP</option>
                                        <option style="color: black;" value="26">SE</option>
                                        <option style="color: black;" value="27">TO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input id="txtCep" name="txtCep" type="text" class="form-control" placeholder="CEP" maxlength="8" onblur="formataCampo('#txtCep','#####-###')">
                                </div>
                                <div class="form-group col-md-4">
                                    <input id="txtDataNascimento" name="txtDataNascimento" type="text" class="form-control" placeholder="Data de Nascimento" maxlength="8" onblur="formataCampo('#txtDataNascimento','##/##/####')">
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control" id="listSexo" name="listSexo">
                                        <option style="color: black;" value="0">Sexo</option>
                                        <option style="color: black;" value="1">Masculino</option>
                                        <option style="color: black;" value="2">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input id="txtSenha" name="txtSenha" id="password-field" type="password" class="form-control" placeholder="Senha">
                                    <!-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> -->
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="txtSenhaConf" name="txtSenhaConf" id="password-field" type="password" class="form-control" placeholder="Confirmar Senha">
                                    <!-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">
                                    <i class="fa-solid fa-right-to-bracket"></i>&numsp;
                                    Registrar
                                </button>
                            </div>
                            <div class="form-group d-md-flex justify-content-center">
                                <a href="<?= base_url() ?>/LoginLoja">Voltar para Login</a>
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
    
    <script type="text/javascript" src="<?= media(); ?>/js/scriptsBasicos.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js'] ?>"></script>

</body>

</html>