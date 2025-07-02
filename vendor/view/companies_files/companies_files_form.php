<?php

/** Importação de classes */

use \vendor\model\CompaniesFiles;
use \vendor\controller\companies_file\CompaniesFilesValidate;

/** Instânciamento de classes */
$CompaniesFiles = new CompaniesFiles();
$CompaniesFilesValidate = new CompaniesFilesValidate();

/** Pego o id do usuário */
$CompaniesFilesValidate->setCompanyId(@(int)filter_input(INPUT_POST, 'COMPANY_ID', FILTER_SANITIZE_SPECIAL_CHARS))

?>

<div class="row">

    <div class="col-md-10">

        <h5>

            <strong>

                <i class="far fa-user-circle me-1"></i>

                Empresas

            </strong>

            /Arquivos/Formulário
            <button type="button" class="btn btn-primary btn-sm" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=<?php echo @(int)$CompaniesValidate->getCompanyId() ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">


                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="usersFilesForm">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="name">

                                Nome

                            </label>

                            <input type="text" class="form-control" name="name" id="name">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="file">

                                Arquivo

                            </label>

                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="file" name="file" onchange="prepareUploadFile('#file')" accept=".jpg, .png, .jpeg, .pdf">
                                <label class="custom-file-label" for="customFile">

                                    Choose file

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-success" onclick="sendForm('#usersFilesForm')">

                    <i class="far fa-save me-2"></i>Salvar

                </button>

                <input type="hidden" name="company_file_id" value="<?php echo $CompaniesFilesValidate->getCompanyFileId() ?>" />
                <input type="hidden" name="company_id" value="<?php echo $CompaniesFilesValidate->getCompanyId() ?>" />
                <input type="hidden" name="base64" value="" id="base64" />
                <input type="hidden" name="extension" value="" id="extension" />
                <input type="hidden" name="FOLDER" value="ACTION" />
                <input type="hidden" name="TABLE" value="COMPANIES_FILES" />
                <input type="hidden" name="ACTION" value="COMPANIES_FILES_SAVE" />

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {

        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    });
</script>