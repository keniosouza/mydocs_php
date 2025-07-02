<?php

/** Importação de classes */

use \vendor\model\Situations;
use \vendor\controller\situations\SituationsValidate;

/** Instânciamento de classes */
$Situations = new Situations();
$SituationsValidate = new SituationsValidate();

/** Tratamento dos dados de entrada */
$SituationsValidate->setSituationId(@(int)filter_input(INPUT_POST, 'SITUATION_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Busca de registro */
$resultSituation = $Situations->get($SituationsValidate->getSituationId());

?>

<div class="row">

    <div class="container-center mb-1">
        <div class="row align-items-center">
            <h5 class="col card-title">

                <strong>
                    <i class="fas fa-thermometer-half me-1"></i>
                    Situações
                </strong>
                <i class="fas fa-chevron-right regular"></i> Edição
            </h5>

            <div class="col text-end">
                <a type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                    <i class="fas fa-chevron-left me-1"></i>Voltar

                </a>
            </div>

        </div>
    </div>

    <div class="col-md-12 animate slideIn">

        <div class="card shadow-sm">

            <form class="card-body" role="form" id="formUsers">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="name">

                                <b>Nome</b>

                            </label>

                            <input type="text" id="name" class="form-control" name="name" value="<?php echo @(string)$resultSituation->name ?>">

                        </div>

                    </div>

                    <div class="col-md-12 text-end">

                        <button type="button" class="btn btn-success mt-1" onclick="sendRequest('formUsers', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                            <i class="far fa-save me-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="situation_id" value="<?php echo @(int)$resultSituation->situation_id ?>" />
                <input type="hidden" name="FOLDER" value="ACTION" />
                <input type="hidden" name="TABLE" value="SITUATIONS" />
                <input type="hidden" name="ACTION" value="SITUATIONS_SAVE" />

            </form>

        </div>

    </div>

</div>