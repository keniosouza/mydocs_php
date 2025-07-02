<?php

/** Importação de classes */

use \vendor\model\Companies;
use \vendor\controller\companies\CompaniesValidate;
use \vendor\model\CompaniesFiles;

/** Instânciamento de classes */
$companies = new Companies();
$companiesValidate = new CompaniesValidate();

$CompaniesFiles = new CompaniesFiles();

/** Parâmetros de Entrada */
$companiesValidate->setCompanyId(@(int)$_POST['COMPANY_ID']);

/** Operações */
$resultCompanies = $companies->get($companiesValidate->getCompanyId());
$CompaniesFilesResult = $CompaniesFiles->All(@(int)$resultCompanies->company_id);

?>

<a type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES_FILES&ACTION=COMPANIES_FILES_FORM&COMPANY_ID=<?php echo @(int)$resultCompanies->company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" class="btn btn-primary w-100 my-2">

<i class="fas fa-plus me-1"></i>Novo

</a>

<?php

/** Verifico se existem registros */
if (count($CompaniesFilesResult) > 0) { ?>

<div class="row">

    <?php

    /** Consulta os usuário cadastrados*/
    foreach ($CompaniesFilesResult as $keyResultCompany => $resultCompaniesFiles) {
    ?>

        <div class="col-md-3 mb-3 d-flex">

            <div class="card text-black w-100">

                <div class="card-body">

                    <h6 class="card-title">

                        <?php echo ("#" . $resultCompaniesFiles->company_file_id . " | " . $resultCompaniesFiles->name); ?>

                    </h6>

                </div>

                <div class="card-footer bg-transparent border-0">

                    <div class="btn-group btn-block text-break" role="group" aria-label="Basic example">

                        <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes" onclick="<?php echo $resultCompaniesFiles->extension === 'pdf' ? 'modalDocument' : 'modalImage' ?>('<?php echo $resultCompaniesFiles->name ?>', '<?php echo $resultCompaniesFiles->path ?>')">

                            <i class="fas fa-search"></i>

                        </a>

                        <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Visualizar" onclick="request('FOLDER=VIEW&TABLE=COMPANIES_FILES&ACTION=COMPANIES_FILES_DETAIL&COMPANY_FILE_ID=<?php echo @(int)$resultCompaniesFiles->company_file_id ?>')">

                            <i class="fas fa-eye"></i>

                        </a>

                        <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="E-mail" onclick="request('FOLDER=VIEW&TABLE=COMPANIES_FILES&ACTION=COMPANIES_FILES_FORM_EMAIL&COMPANY_FILE_ID=<?php echo $resultCompaniesFiles->company_file_id ?>')">

                            <i class="fas fa-at"></i>

                        </a>

                        <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Excluir" onclick="modalConfirm('Atenção', 'O registro: <strong><?php echo $resultCompaniesFiles->name; ?></strong>, será removido. Deseja Continuar?', 'formCompaniesFilesDelete_<?php echo $keyResultCompany ?>')">

                            <span class="badge badge-danger me-1">

                                <i class="fas fa-trash"></i>

                            </span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <form role="form" id="formCompaniesFilesDelete_<?php echo $keyResultCompany ?>">

            <input type="hidden" name="company_file_id" value="<?php echo @(int)$resultCompaniesFiles->company_file_id ?>" />
            <input type="hidden" name="FOLDER" value="ACTION" />
            <input type="hidden" name="TABLE" value="COMPANIES_FILES" />
            <input type="hidden" name="ACTION" value="COMPANIES_FILES_DELETE" />

        </form>

    <?php } ?>

</div>

<?php } else { ?>

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

<?php } ?>

