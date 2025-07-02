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

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-cog me-1"></i>Configurações

            </strong>

        </h5>

    </div>

    <div class="col-md-6 text-end">

        <button class="btn btn-outline-secondary btn-sm" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_PRINT_PREFERENCE_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-print me-1"></i>Impressão

        </button>

        <?php

        /** Verifico se existem registros */
        if (@(int)$resultConfiguration->configuration_id === 0) { ?>

            <button class="btn btn-primary btn-sm" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_FORM', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">>

                <i class="fas fa-plus-circle me-1"></i>Adicionar

            </button>


        <?php } else { ?>

            <button class="btn btn-primary btn-sm" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_FORM&CONFIGURATION_ID=<?php echo @(int)$resultConfiguration->configuration_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-pencil-alt me-1"></i>Editar

            </button>

        <?php } ?>

    </div>

    <?php

    /** Verifico se existem registros */
    if (@(int)$resultConfiguration->configuration_id === 0) { ?>

        <div class="col-md-12">

            <div class="alert alert-warning border-warning shadow-sm" role="alert">

                <h4 class="alert-heading">

                    <strong>

                        Ooops!

                    </strong>

                </h4>

                <p>

                    Não foram localizados registros

                </p>

            </div>

        </div>

    <?php } else { ?>

        <!--Titulo-->
        <div class="col-md-12 mt-1 mb-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">

                        <strong>

                            <?php echo @(string)$resultConfiguration->nickname ?> - <?php echo @(string)$resultConfiguration->name_fantasy ?>

                        </strong>

                    </h5>

                    <h6 class="card-subtitle">

                        <?php echo @(string)$resultConfiguration->name_business ?>

                    </h6>

                </div>

            </div>

        </div>

        <!--Dados da empresa-->
        <div class="col-md d-flex">

            <div class="card shadow-sm w-100">

                <div class="card-body">

                    <ul class="list-unstyled">

                        <li class="media">

                            <div class="media-body">
                                Geral

                                <h6 class="mt-0 mb-1">
                                    <i class="fas fa-user me-1"></i><b>Responsavel</b>

                                </h6>

                                <p>

                                    <span>
                                        <?php echo @(string)$resultConfiguration->responsible ?>
                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">
                                    <i class="fas fa-user me-1"></i><b>Responsável Cargo</b>
                                    

                                </h6>

                                <p>

                                    <span>
                                        <?php echo @(string)$resultConfiguration->responsible_office ?>
                                        

                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">
                                <i class="far fa-building me-1"></i><b>CNPJ</b>
                                    

                                </h6>

                                <p>

                                    <span>
                                    <?php echo @(string)$resultConfiguration->cnpj ?>
                                        

                                    </span>

                                </p>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!--Endereço-->
        <div class="col-md d-flex">

            <div class="card shadow-sm w-100">

                <div class="card-body">

                    <ul class="list-unstyled">

                        <li class="media">

                            <div class="media-body">
                                 Contatos

                                <h6 class="mt-0 mb-1">

                                <i class="fas fa-phone-alt me-1"></i><b>Telefone</b>

                                </h6>

                                <p>

                                    <span>

                                    <?php echo @(string)$resultConfiguration->telephone ?>


                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                <i class="fas fa-phone-alt me-1"></i><b>Celular</b>

                                </h6>

                                <p>

                                    <span>
                                    <?php echo @(string)$resultConfiguration->cellphone ?>


                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                <i class="fas fa-at me-1"></i><b>Email</b>    
                                

                                </h6>

                                <p>

                                    <span>
                                    <?php echo @(string)$resultConfiguration->email ?>
                                  
                                    </span>

                                </p>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!--Endereço-->
        <div class="col-md d-flex">

            <div class="card shadow-sm w-100">

                <div class="card-body">

                    <ul class="list-unstyled">

                        <li class="media">

                            <div class="media-body">
                                Endereço
                                <h6 class="mt-0 mb-1">

                                    <i class="far fa-flag me-1"></i><b>CEP</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->cep ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="far fa-flag me-1"></i><b>Estado</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->state ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="far fa-flag me-1"></i><b>Cidade</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->city ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="far fa-flag me-1"></i><b>Endereço</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->complement ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>
        <!------------------------------------------------------------------------------------------------------>
        <div class="col-md d-flex">

            <div class="card shadow-sm w-100">

                <div class="card-body">

                    <ul class="list-unstyled">

                        <li class="media">

                            <div class="media-body">
                                E-mail
                                
                                <h6 class="mt-0 mb-1">

                                    <i class="far fa-flag me-1"></i><b>Host</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->preferences->email->host ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="far fa-flag me-1"></i><b>Usuario</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->preferences->email->username ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="far fa-flag me-1"></i><b>Porta</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->preferences->email->port ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                        <li class="media">

                            <div class="media-body">

                                <h6 class="mt-0">

                                    <i class="far fa-flag me-1"></i><b>Senha</b>

                                </h6>

                                <p>

                                    <span>

                                        <?php echo @(string)$resultConfiguration->preferences->email->password ?>

                                    </span>

                                </p>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    <?php } ?>

</div>