<?php

/** Importação de classes */

use \vendor\model\Highlighters;
use \vendor\model\Drafts;
use \vendor\controller\drafts\DraftsValidate;

/** Instânciamento de classes */
$Highlighters = new Highlighters();
$Drafts = new Drafts();
$DraftsValidate = new DraftsValidate();

/** Tratamento dos dados de entrada */
$DraftsValidate->setDraftId(@(int)filter_input(INPUT_POST, 'DRAFT_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico se existe registro */
if ($DraftsValidate->getDraftId() > 0) {

    /** Busca de registro */
    $resultDraft = $Drafts->get($DraftsValidate->getDraftId());
}

?>

<div class="container-center">
    <div class="row align-items-start mb-2">

        <h5 class="col card-title">

            <strong>

                <i class="fas fa-file-word me-1"></i>

                Minutas

            </strong>
        

        <i class="fas fa-chevron-right regular"></i> Edição
        </h5>
        <div class="col text-end">
            <button type="button" class="btn btn-primary btn-sm" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS&ACTION=DRAFTS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>
        </div>

    </div>
</div>

<div class="col-md-12">

    <div class="card shadow-sm animate slideIn">

        <form class="card-body" role="form" id="DraftsForm">

            <div class="row g-2">

                <div class="col-md-12">

                    <div class="form-group">

                        <label for="name">

                            <b>Nome</b>

                        </label>

                        <input id="name" type="text" class="form-control" name="name" value="<?php echo @(string)$resultDraft->name ?>">

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">

                        <label for="text">

                            <b>Texto</b>

                        </label>

                        <main>

                            <div id="text_toolbar"></div>

                            <div class="row-editor">

                                <div class="editor-container">

                                    <div class="editor" id="text">

                                        <?php echo @(string)$resultDraft->text ?>

                                    </div>

                                </div>

                            </div>

                        </main>

                    </div>

                </div>

                <div class="col-md-12 mt-3">

                    <div class="form-group">

                        <a class="btn btn-primary w-100" data-bs-toggle="collapse" href="#HighlightersDatagrid" role="button" aria-expanded="false" aria-controls="Marcações">

                            <i class="fas fa-highlighter me-1"></i>Marcações

                        </a>

                        <div class="collapse" id="HighlightersDatagrid">

                            <div class="form-group my-2">

                                <input type="text" class="form-control shadow-sm" placeholder="Pesquise por: Nome" id="search" name="search">

                            </div>

                            <table class="table table-bordered table-borderless table-hover bg-white shadow-sm border mt-3" id="search_table">

                                <thead id="search_table_head">

                                    <tr>

                                        <th>

                                            Nome

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    /** Consulta os usuário cadastrados*/
                                    foreach ($Highlighters->All() as $keyResultHighlighter => $resultHighlighter) { ?>

                                        <tr class="border-top">

                                            <td id="text_<?php echo $keyResultHighlighter ?>">

                                                <?php echo $resultHighlighter->name; ?>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="col-md-12 text-end mt-3">

                    <button type="button" class="btn btn-success" onclick="sendRequest('DraftsForm', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                        <i class="far fa-save me-2"></i>Salvar

                    </button>

                </div>

            </div>

            <input type="hidden" name="draft_id" value="<?php echo @(int)$resultDraft->draft_id ?>" />
            <input type="hidden" name="FOLDER" value="ACTION" />
            <input type="hidden" name="TABLE" value="DRAFTS" />
            <input type="hidden" name="ACTION" value="DRAFTS_SAVE" />

        </form>

    </div>

</div>

<script type="text/javascript">
    /** Carrego o editor de texto */
    loadCKEditor();

    /** Carrego o LiveSearch */
    loadLiveSearch();
</script>