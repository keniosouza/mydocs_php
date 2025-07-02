<?php

/** Importação de classes */
use \vendor\model\CompaniesFiles;
use \vendor\controller\companies_file\CompaniesFilesValidate;

/** Instânciamento de classes */
$CompaniesFiles = new CompaniesFiles();
$CompaniesFilesValidate = new CompaniesFilesValidate();

/** Pego o id do usuário */
$CompaniesFilesValidate->setCompanyFileId(@(int)filter_input(INPUT_POST, 'COMPANY_FILE_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico se existe registro */
if ($CompaniesFilesValidate->getCompanyFileId() > 0) {

    /** Busca de registro */
    $resultCompanyFile = $CompaniesFiles->Get($CompaniesFilesValidate->getCompanyFileId());

}

?>

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-building me-1"></i>Empresas

            </strong>

            /Email/Edição/

            <button type="button" class="btn btn-primary btn-sm mb-0" onclick="request('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=<?php echo utf8_decode(@(int)$resultCompanyFile->company_id)?>')">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="formDrafts">

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

                        <button type="button" class="btn btn-primary" onclick="sendForm('#formDrafts', 'S')">

                            <i class="far fa-paper-plane me-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="company_file_id" value="<?php echo utf8_decode(@(int)$resultCompanyFile->company_file_id)?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="COMPANIES_FILES"/>
                <input type="hidden" name="ACTION" value="COMPANIES_FILES_EMAIL"/>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    loadCKEditor();

</script>