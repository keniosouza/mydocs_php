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

<div class="row">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-cog me-1"></i>Configurações

            </strong>

            /Email/

            <button type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-chevron-left me-1 "></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-6 text-end">

        <button class="btn btn-primary btn-sm" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_EMAIL_PREFERENCE_FORM', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-pencil-alt me-1"></i>Editar

        </button>

    </div>

</div>

<?php

/** Verifico se existem registros */
if (!empty($resultConfiguration->preferences->email)) { ?>

    <div class="row mt-3 animate slideIn">

        <div class="col-md-12 mb-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="row grid-divider">

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Host</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->email->host ?>

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Usuário</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->email->username ?>

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Porta</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->email->port ?>

                                </span>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Senha</b>

                            </h6>

                            <h6>

                                <span>

                                    <?php echo @(string)$resultConfiguration->preferences->email->password ?>

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

        Não foi localizado nenhum email cadastrado.

    </p>

    </div>

   
<?php } ?>