<!-- Modal Criar e Editar Produto -->
<div class="modal fade" id="modalFormProdutos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- modal-xl = Extra large (1140px) -->
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Criar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProduto" name="formProduto" class="form-horizontal">
                    <input type="hidden" id="idProduto" name="idProduto" value="">
                    <div class="form-group">
                        <label class="corVermelha">*</label>&nbsp;
                        <label class="control-label">Campo obrigatório</label>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label" for="txtNome">Nome</label>&nbsp;
                                <label class="corVermelha">*</label>
                                <input class="form-control valid" id="txtNome" name="txtNome" tabindex="1" type="text" maxlength="100" placeholder="Digite o nome" onblur="alteraClassInvalido('.valid');">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descrição</label>
                                <textarea class="form-control" id="txtDescricao" name="txtDescricao" tabindex="2" placeholder="Digite a descrição"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="txtCodigo">Código</label>&nbsp;
                                <label class="corVermelha">*</label>
                                <input class="form-control valid" id="txtCodigo" name="txtCodigo" tabindex="3" type="text" placeholder="Código de barra" onblur="alteraClassInvalido('.valid');">
                                <div id="divBarCode" class="notBlock textCenter">
                                    <br />
                                    <div id="printCode">
                                        <svg id="barcode"></svg>
                                    </div>
                                    <button class="btn btn-success btn-sm" type="button" onClick="imprimirBarcode('#printCode');">
                                        <i class="fas fa-print"></i>&nbsp;
                                        Imprimir
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label" for="txtPreço">Preço</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtPreço" name="txtPreço" tabindex="4" type="text" placeholder="Valor preço" onblur="alteraClassInvalido('.valid');">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label" for="txtEstoque">Estoque</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <input class="form-control valid" id="txtEstoque" name="txtEstoque" tabindex="5" type="text" placeholder="Quantidade estoque" onblur="alteraClassInvalido('.valid');">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label" for="listCategoria">Categoria</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <select class="form-control valid block" id="listCategoria" name="listCategoria" tabindex="6" onchange="alteraClassInvalido('.valid');">
                                        <option value="0">-- Selecionar --</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Status</label>&nbsp;
                                    <label class="corVermelha">*</label>
                                    <select class="form-control valid block" id="listStatus" name="listStatus" tabindex="7" onchange="alteraClassInvalido('.valid');">
                                        <option value="0">-- Selecionar --</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6 form-group">
                                    <button class="btn btn-primary btn-lg btn-block" id="btnActionForm" type="submit" tabindex="8" accesskey="s">
                                        <i class="fa-solid fa-circle-check"></i>&nbsp;
                                        <span id="btnText"><u>S</u>alvar</span>
                                    </button>
                                </div>
                                <div class="col-md-6 form-group">
                                    <a class="btn btn-danger btn-lg btn-block" tabindex="9" accesskey="c" data-dismiss="modal" onclick="cancelar();">
                                        <i class="fa-solid fa-circle-xmark"></i>&nbsp;
                                        <span id="btnText2"><u>C</u>ancelar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="form-group col-md-12">
                            <div id="containerGallery">
                                <span>Adicionar Foto (440 x 545)</span>&numsp;
                                <button class="btnAddImage btn btn-info btn-sm" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <hr>
                            <div id="containerImages">
                                <div id="div24">
                                    <div class="prevImage">
                                        <img src="<?= media(); ?>/img/uploads/coca-cola-350-ml-(1).png">
                                    </div>
                                    <input type="file" name="foto" id="img1" class="inputUploadfile">
                                    <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                                    <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                <div id="div24">
                                    <div class="prevImage">
                                        <img class="loading" src="<?= media(); ?>/img/loading.svg">
                                    </div>
                                    <input type="file" name="foto" id="img1" class="inputUploadfile">
                                    <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                                    <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>