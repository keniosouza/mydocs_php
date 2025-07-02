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

    <div class="row align-items-start">

        <h5 class="card-title col">

            <strong>

                <i class="fas fa-cog me-1"></i>Configurações

            </strong>

            <i class="fas fa-chevron-right regular"></i> Impressão
        </h5>

    

    <div class="col text-end ms-4">


        <button class="btn btn-primary btn-sm" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_PRINT_PREFERENCE_FORM', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-pencil-alt me-1"></i>Editar

        </button>

        <button type="button" class="btn btn-primary btn-sm" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-chevron-left me-1 "></i>Voltar

        </button>


    </div>
    </div>

</div>

<?php

/** Verifico se existem registros */
if (isset($resultConfiguration->preferences->page)) { ?>

    <div class="row mt-3 animate slideIn">

        <div class="col-md-12 mb-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="row grid-divider">

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Altura</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->height ?>

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Largura</b>
                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->width ?>

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Orientação</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->orientation ?>

                                </span>

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6 class="card-title">

                        <b>Margens do Corpo</b>

                    </h6>

                    <div class="row grid-divider">

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Esquerda</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_left ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Direita</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_right ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Superior</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_top ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Inferior</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_bottom ?> cm

                                </span>

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6 class="card-title">

                        <b>Margens do Cabeçalho</b>

                    </h6>

                    <div class="row grid-divider">

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Esquerda</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_left ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Direita</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_right ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Superior</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_top ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Inferior</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->header->margin_bottom ?> cm

                                </span>

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6 class="card-title">

                        <b>Margens do Rodapé</b>

                    </h6>

                    <div class="row grid-divider">

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Esquerda</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->footer->margin_left ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Direita</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->footer->margin_right ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Superior</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->footer->margin_top ?> cm

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Inferior</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->page->footer->margin_bottom ?> cm

                                </span>

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php

} else { ?>

    <div class="alert alert-warning border-warning shadow-sm mt-3" role="alert">

        <h4 class="alert-heading">

            <strong>

                Ooops!

            </strong>

        </h4>

        <p>

            Não encontramos nenhum parâmetro de configuração para impressão.

        </p>

    </div>

<?php } ?>