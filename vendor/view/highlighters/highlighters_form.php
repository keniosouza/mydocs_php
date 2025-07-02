<?php

/** Importação de classes */

use \vendor\model\Highlighters;
use \vendor\controller\highlighters\HighlightersValidate;

/** Instânciamento de classes */
$Highlighters = new Highlighters();
$HighlightersValidate = new HighlightersValidate();

/** Tratamento dos dados de entrada */
$HighlightersValidate->setHighlighterId(@(int)filter_input(INPUT_POST, 'HIGHLIGHTER_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Busca de registro */
$resultHighlighters = $Highlighters->Get($HighlightersValidate->getHighlighterId());

/** Decodifico o corpo do texto */
$resultHighlighters->text = (object)json_decode($resultHighlighters->text);
$resultHighlighters->preferences = (object)json_decode($resultHighlighters->preferences);

?>

<div class="row">

    <div class="container-center mb-1">
        <div class="row align-items-center">

            <h5 class="col card-title">

                <strong>

                    <i class="fas fa-highlighter me-1"></i>

                    Marcações

                </strong>

                <i class="fas fa-chevron-right regular"></i> Edição
            </h5>
            <div class="col text-end">
                <a type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                    <i class="fas fa-chevron-left me-1"></i>Voltar

                </a>
            </div>

        </div>
    </div>

    <div class="col-md-12 animate slideIn">

        <div class="card shadow-sm">

            <form class="card-body" role="form" id="formUsers">

                <div class="row g-2">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="name">

                                <b>Nome</b>

                            </label>

                            <input type="text" id="name" class="form-control" name="name" value="<?php echo @(string)$resultHighlighters->name ?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="group">

                                <b>Grupo</b>

                            </label>

                            <select class="form-select" aria-label="Default select example" id="group" name="group">

                                <option value="company" <?php echo @(string)$resultHighlighters->group === 'company' ? 'selected' : null ?>>

                                    <b>Empresa</b>

                                </option>

                                <option value="user" <?php echo @(string)$resultHighlighters->group === 'user' ? 'selected' : null ?>>

                                    <b>Usuário</b>

                                </option>

                                <option value="configuration" <?php echo @(string)$resultHighlighters->group === 'configuration' ? 'selected' : null ?>>

                                    <b>Configuração</b>

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="table">

                                <b>Tabela</b>

                            </label>

                            <input type="text" id="table" class="form-control" name="table" value="<?php echo @(string)$resultHighlighters->text->table ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="column">

                                <b>Coluna</b>

                            </label>

                            <input type="text" id="column" class="form-control" name="column" value="<?php echo @(string)$resultHighlighters->text->column ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="primary_key">

                                <b>Chave Primária</b>

                            </label>

                            <input type="text" id="primary_key" class="form-control" name="primary_key" value="<?php echo @(string)$resultHighlighters->text->primary_key ?>">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="mask">

                                <b>Máscara</b>

                            </label>

                            <input type="text" id="mask" class="form-control" name="mask" value="<?php echo @(string)$resultHighlighters->preferences->mask->format ?>">

                        </div>

                        <div class="form-gorup">

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="lowercase" name="lowercase" <?php echo !empty(@(string)$resultHighlighters->preferences->text->lowercase) ? 'checed' : null ?>>
                                <label class="form-check-label" for="lowercase">Minúsculo</label>
                            </div>

                        </div>

                        <div class="form-gorup">

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="uppercase" name="uppercase" <?php echo !empty(@(string)$resultHighlighters->preferences->text->uppercase) ? 'checked' : null ?>>
                                <label class="form-check-label" for="uppercase">Maiúsculo</label>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-12 text-end">

                        <button type="button" class="btn btn-success" onclick="sendRequest('formUsers', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                            <i class="far fa-save me-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="highlighter_id" value="<?php echo @(int)$resultHighlighters->highlighter_id ?>" />
                <input type="hidden" name="FOLDER" value="ACTION" />
                <input type="hidden" name="TABLE" value="HIGHLIGHTERS" />
                <input type="hidden" name="ACTION" value="HIGHLIGHTERS_SAVE" />

            </form>

        </div>

    </div>

</div>