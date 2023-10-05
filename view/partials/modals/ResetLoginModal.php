<div class="modal fade" id="modalResetLogin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Alterar Senha</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formResetLogin" name="formResetLogin" class="form-horizontal">
                            <input type="hidden" id="idUsuario" name="idUsuario">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Pergunta Secreta</label>
                                    <input class="form-control" id="txtPergunta" name="txtPergunta" type="text" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="txtResposta">Resposta</label>&nbsp;
                                    <input class="form-control" id="txtResposta" name="txtResposta" tabindex="1" type="text">
                                </div>
                            </div>
                            <div class="tile-footer text-center">
                                <button class="btn btn-primary" id="btnActionForm" type="submit" tabindex="2" accesskey="a">
                                    <i class="fa-solid fa-circle-check"></i>&nbsp;
                                    <u>A</u>lterar
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" tabindex="3" accesskey="v" data-dismiss="modal" onclick="cancelar();">
                                    <i class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    <u>V</u>oltar Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>