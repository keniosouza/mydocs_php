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

<div class="container-center mt-3">

    <div class="row align-items-start">

        <h5 class="card-title col">

            <strong>

                <i class="fas fa-cog me-1"></i>Configurações

            </strong>

            <i class="fas fa-chevron-right regular"></i>Email
            <i class="fas fa-chevron-right regular"></i>Edição
        </h5>
    
    <div class="text-end col"> 
        <button class="btn btn-primary btn-sm mb-1" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_EMAIL_PREFERENCE_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-chevron-left me-1"></i>Voltar

        </button>
    </div>
    </div>
</div>


<!-------------------------------------------------------------------------------------------------------------------------------------->
<form role="form" id="formConfigurations" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <div class="form-group">

                    <label for="host">

                        <b>Host</b>

                    </label>

                    <input type="text" class="form-control" id="host" name="host" value="<?php echo @(string)$resultConfiguration->preferences->email->host ?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="username">

                        <b>Usuário</b>

                    </label>

                    <input type="text" class="form-control" id="username" name="username" value="<?php echo @(string)$resultConfiguration->preferences->email->username ?>">

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label for="port">

                        <b>Porta</b>

                    </label>

                    <input type="text" class="form-control" id="port" name="port" value="<?php echo @(string)$resultConfiguration->preferences->email->port ?>">

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group">

                    <label for="password">

                        <b>Senha</b>

                    </label>

                    <input type="text" class="form-control" id="password" name="password" value="<?php echo @(string)$resultConfiguration->preferences->email->password ?>">

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-group mb-0 text-end">

                    <button type="button" class="btn btn-success mt-2" onclick="sendRequest('formConfigurations', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                        <i class="far fa-save me-1"></i>Salvar

                    </button>

                </div>

            </div>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="CONFIGURATIONS">
    <input type="hidden" name="ACTION" value="CONFIGURATIONS_EMAIL_PREFERENCE_SAVE">
    <input type="hidden" name="configuration_id" value="<?php echo @(int)$resultConfiguration->configuration_id ?>">

</form>