<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Novo Usuário</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formUsuario" name="formUsuario" class="form-horizontal">
                            <input type="hidden" id="idUsuario" name="idUsuario">
                            <div class="form-group">
                                <label class="corVermelha">*</label>&nbsp;
                                <label class="control-label">Campo obrigatório</label>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtCpf">CPF</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtCpf" name="txtCpf" tabindex="1" type="text" maxlength="11" placeholder="Digite seu CPF" onblur="formataCampo('#txtCpf','###.###.###-##');">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNome">Nome</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtNome" name="txtNome" tabindex="2" type="text" placeholder="Digite seu nome" onblur="alteraClassInvalido();">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSobrenome">Sobrenome</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtSobrenome" name="txtSobrenome" tabindex="3" type="text" placeholder="Digite seu sobrenome" onblur="alteraClassInvalido();">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTelefone">Telefone</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtTelefone" name="txtTelefone" tabindex="4" type="text" maxlength="11" placeholder="Digite seu telefone com DDD" onblur="formataCampo('#txtTelefone','(##)#####-####');">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtEmail">Email</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtEmail" name="txtEmail" tabindex="5" type="text" placeholder="Digite seu e-mail" onblur="validaEmail();">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Cargo</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <select class="form-control valid" id="listCargo" name="listCargo" tabindex="6" onchange="alteraClassInvalido();">
                                        <option value="0">-- Selecionar --</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Vendedor</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Email</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <select class="form-control valid" id="listStatus" name="listStatus" tabindex="7" onchange="alteraClassInvalido();">
                                        <option value="0">-- Selecionar --</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSenha">Senha</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtSenha" name="txtSenha" tabindex="8" type="password" placeholder="Digite sua senha" onblur="alteraClassInvalido();">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSenhaConfirma">Confirmação Senha</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <div style="display: flex; align-items: center;">
                                        <input class="form-control valid" id="txtSenhaConfirma" name="txtSenhaConfirma" tabindex="9" type="password" placeholder="Digite sua senha" onBlur="alteraClassInvalido();">
                                        &nbsp;
                                        <i class="fa-solid fa-eye imgSenha" onclick="mostrarSenha();"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" id="btnActionForm" type="submit" tabindex="10" accesskey="s">
                                    <i class="fa-solid fa-circle-check"></i>&nbsp;
                                    <span id="btnText"><u>S</u>alvar</span>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="#" tabindex="11" accesskey="c" data-dismiss="modal" onclick="cancelar();">
                                    <i class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    <u>C</u>ancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>