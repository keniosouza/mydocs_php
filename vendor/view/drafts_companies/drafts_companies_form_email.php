<?php

/** Importação de classes */

use \vendor\model\DraftsCompanies;
use \vendor\controller\drafts_companies\DraftsCompaniesValidate;

/** Instânciamento de classes */
$DraftsCompanies = new DraftsCompanies();
$DraftsCompaniesValidate = new DraftsCompaniesValidate();

/** Tratamento dos dados de entrada */
$DraftsCompaniesValidate->setDraftCompaniesId(@(int)filter_input(INPUT_POST, 'DRAFT_COMPANIES_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico se existe registro */
if ($DraftsCompaniesValidate->getDraftCompaniesId() > 0) {

    /** Busca de registro */
    $resultDraftCompanies = $DraftsCompanies->Get($DraftsCompaniesValidate->getDraftCompaniesId());
}

?>

<div class="row align-items-start mb-2">

    <h5 class="col card-title">

        <strong>

            <i class="fas fa-building me-1"></i>

            Empresas

        </strong>

        /Documento/Email/

    </h5>

    <div class="col text-end">

        <button type="button" class="btn btn-primary btn-sm mb-0" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=<?php echo @(int)$resultDraftCompanies->company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-chevron-left me-1"></i>Voltar

        </button>

    </div>

</div>

<div class="card shadow-sm animate slideIn">

    <form class="card-body" role="form" id="DraftsCompaniesFormEmail">

        <div class="row">

            <div class="col-md-12">

                <div class="form-group">

                    <label for="text">

                        Texto:

                    </label>

                    <div id="text_toolbar"></div>

                    <div id="text" class="border editor">

                    </div>

                </div>

            </div>

            <div class="col-md-12 text-end">

                <button type="button" class="btn btn-primary" onclick="sendRequest('DraftsCompaniesFormEmail', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                    <i class="far fa-paper-plane me-1"></i>Salvar

                </button>

            </div>

        </div>

        <input type="hidden" name="company_id" value="<?php echo @(int)$resultDraftCompanies->company_id ?>" />
        <input type="hidden" name="draft_companies_id" value="<?php echo @(int)$resultDraftCompanies->draft_companies_id ?>" />
        <input type="hidden" name="FOLDER" value="ACTION" />
        <input type="hidden" name="TABLE" value="DRAFTS_COMPANIES" />
        <input type="hidden" name="ACTION" value="DRAFTS_COMPANIES_EMAIL" />

    </form>

</div>

<script type="text/javascript">
    loadCKEditor();
</script>