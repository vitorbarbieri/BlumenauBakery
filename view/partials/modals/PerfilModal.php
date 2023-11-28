<!-- Modal Perfil Dados Pessoais -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModal">Editar Dados Pessoais</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formPerfil" name="formPerfil" class="form-horizontal">
                            <div class="form-group">
                                <label class="corVermelha">*</label>&nbsp;
                                <label class="control-label">Campo obrigatório</label>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtCpf">CPF</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid block" id="txtCpf" name="txtCpf" tabindex="1" type="text" maxlength="11" placeholder="Digite seu CPF" onblur="formataCampo('#txtCpf','###.###.###-##', '.valid');" value="<?= $_SESSION['userData']['cpf']; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNome">Nome</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid block" id="txtNome" name="txtNome" tabindex="2" type="text" placeholder="Digite seu nome" onblur="alteraClassInvalido('.valid');" value="<?= $_SESSION['userData']['nome']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSobrenome">Sobrenome</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid block" id="txtSobrenome" name="txtSobrenome" tabindex="3" type="text" placeholder="Digite seu sobrenome" onblur="alteraClassInvalido('.valid');" value="<?= $_SESSION['userData']['sobrenome']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTelefone">Telefone</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid block" id="txtTelefone" name="txtTelefone" tabindex="4" type="text" maxlength="11" placeholder="Digite seu telefone com DDD" onblur="formataCampo('#txtTelefone','(##)#####-####', '.valid');" value="<?= $_SESSION['userData']['telefone']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtEmail">Email</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid block" id="txtEmail" name="txtEmail" tabindex="5" type="text" placeholder="Digite seu e-mail" onblur="validaEmail('.valid');" value="<?= $_SESSION['userData']['email']; ?>">
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit" tabindex="6" accesskey="s">
                                    <i class="fa-solid fa-circle-check"></i>&nbsp;
                                    <span id="btnText"><u>S</u>alvar</span>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="#" tabindex="7" accesskey="a" data-dismiss="modal" onclick="cancelar('.valid');">
                                    <i class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    C<u>a</u>ncelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Perfil Configuração -->
<div class="modal fade" id="modalFormPerfilConfig" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModal">Editar Configurações</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formPerfilConfig" name="formPerfilConfig" class="form-horizontal">
                            <div class="form-group">
                                <label class="corVermelha">*</label>&nbsp;
                                <label class="control-label">Campo obrigatório</label>
                            </div>
                            <div id="divSenha" class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSenha">Senha</label>
                                    <input class="form-control block" id="txtSenha" name="txtSenha" tabindex="1" type="password" placeholder="Digite sua senha" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSenhaConfirma">Confirmação Senha</label>
                                    <div style="display: flex; align-items: center;">
                                        <input class="form-control block" id="txtSenhaConfirma" name="txtSenhaConfirma" tabindex="2" type="password" placeholder="Digite sua senha" value="">
                                        &nbsp;
                                        <i class="fa-solid fa-eye imgSenha" onclick="mostrarSenha();"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="listPergunta">Pergunta Secreta</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <select class="form-control validConfig block" data-live-search="true" id="listPergunta" name="listPergunta" tabindex="3" onchange="alteraClassInvalido('.validConfig');" value="<?= $_SESSION['userData']['id_pergunta']; ?>">
                                        <option value="0">-- Selecionar --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="txtResposta">Resposta Secreta</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control validConfig block" id="txtResposta" name="txtResposta" tabindex="4" type="text" placeholder="Digite sua resposta secreta" onblur="alteraClassInvalido('.validConfig');" value="<?= $_SESSION['userData']['resposta']; ?>">
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit" tabindex="5" accesskey="a">
                                    <i class="fa-solid fa-circle-check"></i>&nbsp;
                                    <span id="btnText"><u>A</u>tualizar</span>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="#" tabindex="6" accesskey="a" data-dismiss="modal" onclick="cancelar2('.validConfig');">
                                    <i class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    C<u>a</u>ncelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>