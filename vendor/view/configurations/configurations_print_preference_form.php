<?php

/** Importação de classes */

use vendor\model\Configurations;

/** Instânciamento de Classes */
$Configurations = new Configurations();

/** Busco a configuração */
$resultConfiguration = $Configurations->All();

/** Decodifico as preferencias */
$resultConfiguration->preferences = (object)json_decode($resultConfiguration->preferences);

?>

<div class="container-center">

    <div class="row align-items-center">

        <h5 class=" col card-title">

            <strong>

                <i class="fas fa-cog me-1"></i>Configurações

            </strong>

            <i class="fas fa-chevron-right regular"></i>Impressão 
            <i class="fas fa-chevron-right regular"></i>Edição
        </h5>
        
        <div class="col text-end">
            <button type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_PRINT_PREFERENCE_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>
        </div>
        

    </div>

</div>

<!-- Formulario-->


<ul class="nav nav-tabs" id="pills-tab" role="tablist">

    <li class="nav-item nav-link-pill me-1" role="pagina">

        <button class="nav-link active" id="pills-pagina-tab" data-bs-toggle="tab" data-bs-target="#pills-pagina" type="button" role="tab" aria-controls="pills-pagina" aria-selected="false">Página</button>

    </li>

    <li class="nav-item nav-link-pill me-1" role="cabecalho">

        <button class="nav-link" id="illps-cabecalho-tab" data-bs-toggle="tab" data-bs-target="#pills-cabecalho" type="button" role="tab" aria-controls="pills-cabecalho" aria-selected="false">Cabeçalho</button>

    </li>

    <li class="nav-item nav-link-pill me-1" role="rodape">

        <button class="nav-link" id="pills-rodape-tab" data-bs-toggle="tab" data-bs-target="#pills-rodape" type="button" role="tab" aria-controls="pills-rodape" aria-selected="false">Rodapé</button>

    </li>

</ul>
<div class="card shadow-sm animate slideIn">
    <form role="form" id="formGConfigCertidao" class="tab-content">

        <div class="tab-content" id="pills-tabContent">

            <!--Pagina-->
            <div class="tab-pane fade active show" id="pills-pagina" role="tabpanel" aria-labelledby="pills-pagina-tab">
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="orientation">

                                    <b>Orientação</b>

                                </label>

                                <select name="orientation" id="orientation" class="form-select" aria-label="Default select example">

                                    <option value="portrait">

                                        Retrato

                                    </option>

                                    <option value="landscape">

                                        Paisagem

                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="height">

                                    <b>Altura</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="height" name="height" value="<?php echo @(string)$resultConfiguration->preferences->page->height ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="width">

                                    <b>Largura</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="width" name="width" value="<?php echo @(string)$resultConfiguration->preferences->page->width ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <h6 class="card-title text-muted">

                        <i class="fas fa-info me-1"></i>Area de Impressão

                    </h6>

                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="body_margin_left">

                                    <b>Margem Esquerda</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" name="body_margin_left" id="body_margin_left" value="<?php echo @(string)$resultConfiguration->preferences->page->body->margin_left ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="body_margin_right">

                                    <b>Margem Direita</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="body_margin_right" name="body_margin_right" value="<?php echo @(string)$resultConfiguration->preferences->page->body->margin_right ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="body_margin_top">

                                    <b>Margem Superior</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="body_margin_top" name="body_margin_top" value="<?php echo @(string)$resultConfiguration->preferences->page->body->margin_top ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="body_margin_bottom">

                                    <b>Margem Inferior</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="body_margin_bottom" name="body_margin_bottom" value="<?php echo @(string)$resultConfiguration->preferences->page->body->margin_bottom ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!--Cabeçalho-->
            <div class="tab-pane fade" id="pills-cabecalho" role="tabpanel" aria-labelledby="pills-cabecalho-tab">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="header_margin_left">

                                    <b>Margem Esquerda</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" name="header_margin_left" id="header_margin_left" value="<?php echo @(string)$resultConfiguration->preferences->page->header->margin_left ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="header_margin_right">

                                    <b>Margem Direita</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="header_margin_right" name="header_margin_right" value="<?php echo @(string)$resultConfiguration->preferences->page->header->margin_right ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="header_margin_top">

                                    <b>Margem Superior</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="header_margin_top" name="header_margin_top" value="<?php echo @(string)$resultConfiguration->preferences->page->header->margin_top ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="header_margin_bottom">

                                    <b>Margem Inferior</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="header_margin_bottom" name="header_margin_bottom" value="<?php echo @(string)$resultConfiguration->preferences->page->header->margin_bottom ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <div id="header_content_toolbar"></div>

                                <div id="header_content" class="border editor">

                                    <?php echo base64_decode(@(string)$resultConfiguration->preferences->page->header->content) ?>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!--Rodapé-->
            <div class="tab-pane fade" id="pills-rodape" role="tabpanel" aria-labelledby="pills-rodape-tab">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="footer_margin_left">

                                    <b>Margem Esquerda</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" name="footer_margin_left" id="footer_margin_left" value="<?php echo @(string)$resultConfiguration->preferences->page->footer->margin_left ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="footer_margin_right">

                                    <b>Margem Direita</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="footer_margin_right" name="footer_margin_right" value="<?php echo @(string)$resultConfiguration->preferences->page->footer->margin_right ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="footer_margin_top">

                                    <b>Margem Superior</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="footer_margin_top" name="footer_margin_top" value="<?php echo @(string)$resultConfiguration->preferences->page->footer->margin_top ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="footer_margin_bottom">

                                    <b>Margem Inferior</b>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" id="footer_margin_bottom" name="footer_margin_bottom" value="<?php echo @(string)$resultConfiguration->preferences->page->footer->margin_bottom ?>">

                                    <div class="input-group-append">

                                        <span class="input-group-text" id="basic-addon2">

                                            cm

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <div id="footer_content_toolbar"></div>

                                <div id="footer_content" class="border editor">


                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="form-group mb-2  me-2 text-end">
        
            <button type="button" class="btn btn-success" onclick="sendRequest('formGConfigCertidao', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="far fa-save me-1"></i>Salvar

            </button>

        </div>

        <input type="hidden" name="configuration_id" value="<?php echo $resultConfiguration->configuration_id ?>">
        <input type="hidden" name="FOLDER" value="ACTION">
        <input type="hidden" name="TABLE" value="CONFIGURATIONS">
        <input type="hidden" name="ACTION" value="CONFIGURATIONS_PRINT_PREFERENCE_SAVE">

    </form>

</div>

<script>
    /** Carrego o Editor de Texto */
    loadCKEditor();
</script>