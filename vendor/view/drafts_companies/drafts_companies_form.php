<?php

/** Importação de classes */

use \vendor\model\Drafts;
use \vendor\controller\companies\CompaniesValidate;

/** Instânciamento de classes */
$Drafts = new Drafts();
$CompaniesValidate = new CompaniesValidate();

/** Operações */
$CompaniesValidate->setCompanyId(filter_input(INPUT_POST, 'COMPANY_ID', FILTER_SANITIZE_SPECIAL_CHARS));

?>

<div class="container-center mb-2">
    <div class="row align-items-center">
        
        <h5 class="col card-title">

            <strong>

                <i class="fas fa-user me-1"></i>Empresa

            </strong>

            <i class="fas fa-chevron-right regular"></i>Vincular Documentos
        </h5>
        <div class="col text-end">
            <button type="button" class="btn btn-primary btn-sm mb-0" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=<?php echo @(int)$CompaniesValidate->getCompanyId() ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>
        </div>

    </div>
</div>

<div class="col-md-12">

    <div class="card shadow-sm animate slideIn">

        <form class="card-body" role="form" id="DraftsCompaniesForm">

            <div class="row">

                <?php

                /** Listagem de Todos os Registros */
                foreach ($Drafts->all() as $keyResultDrafts => $resultDrafts) { ?>

                    <div class="col-md-12">

                        <div class="form-group">

                            <div class="form-check form-switch">

                                <input class="form-check-input" type="radio" role="switch" id="draft_<?php echo $resultDrafts->draft_id ?>" name="draft_id" value="<?php echo $resultDrafts->draft_id ?>" class="custom-control-input">
                                <label class="form-check-label" id="draft_<?php echo $resultDrafts->draft_id ?>">

                                    <?php echo $resultDrafts->name ?>

                                </label>

                            </div>

                        </div>

                    </div>

                <?php } ?>

                <div class="col-md-12 text-end">

                    <button type="button" class="btn btn-success" onclick="sendRequest('DraftsCompaniesForm', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                        <i class="far fa-save me-2"></i>Salvar

                    </button>

                </div>

            </div>

            <input type="hidden" name="company_id" value="<?php echo @(int)$CompaniesValidate->getCompanyId() ?>" />
            <input type="hidden" name="FOLDER" value="ACTION" />
            <input type="hidden" name="TABLE" value="DRAFTS_COMPANIES" />
            <input type="hidden" name="ACTION" value="DRAFTS_COMPANIES_SAVE" />

        </form>

    </div>

</div>

<script type="text/javascript">
    loadCKEditor();
</script>