<?php

/** Importação de classes */

use \vendor\model\Companies;
use \vendor\controller\companies\CompaniesValidate;
use \vendor\model\DraftsCompanies;

/** Instânciamento de classes */
$companies = new Companies();
$companiesValidate = new CompaniesValidate();
$DraftsCompanies = new DraftsCompanies();


/** Parâmetros de Entrada */
$companiesValidate->setCompanyId(@(int)$_POST['COMPANY_ID']);

/** Operações */
$resultCompanies = $companies->get($companiesValidate->getCompanyId());
$DraftsCompaniesResult = $DraftsCompanies->all($resultCompanies->company_id);


?>

<a type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS_COMPANIES&ACTION=DRAFTS_COMPANIES_FORM&COMPANY_ID=<?php echo @(int)$resultCompanies->company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" class="btn btn-primary w-100 my-2">

<i class="fas fa-plus me-1"></i>Novo

</a>

<?php

/** Verifico se existem registros */
if (count($DraftsCompaniesResult) > 0) { ?>

<table class="table table-hover bg-white shadow-sm border" id="search_table">

    <thead id="search_table_head">

        <tr>

            <th class="text-center">

                #

            </th>

            <th>

                Nome

            </th>

            <th class="text-center">

                Operações

            </th>

        </tr>

    </thead>

    <tbody>

        <?php

        /** Consulta os usuário cadastrados*/
        foreach ($DraftsCompaniesResult as $keyResultDraftsCompanies => $resultDraftsCompanies) { ?>

            <tr class="border-top">

                <td class="text-center">

                    <?php echo $resultDraftsCompanies->draft_companies_id; ?>

                </td>

                <td>

                    <?php echo $resultDraftsCompanies->name; ?>

                </td>

                <td class="text-center">

                    <div class="dropdown-center">

                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="fas fa-cog"></i>

                        </button>

                        <ul class="dropdown-menu">

                            <li>

                                <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS_COMPANIES&ACTION=DRAFTS_COMPANIES_FORM_TEXT&DRAFT_COMPANIES_ID=<?php echo $resultDraftsCompanies->draft_companies_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                    <i class="fas fa-user-edit me-1"></i>

                                    Editar

                                </a>

                                <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS_COMPANIES&ACTION=DRAFTS_COMPANIES_DETAILS&DRAFT_COMPANIES_ID=<?php echo $resultDraftsCompanies->draft_companies_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                    <i class="fas fa-eye me-1"></i>

                                    Detalhes

                                </a>

                                <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=ACTION&TABLE=DRAFTS_COMPANIES&ACTION=DRAFTS_COMPANIES_PRINT&DRAFT_COMPANIES_ID=<?php echo $resultDraftsCompanies->draft_companies_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                    <i class="fas fa-print"></i>

                                    PDF

                                </a>

                                <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS_COMPANIES&ACTION=DRAFTS_COMPANIES_FORM_EMAIL&DRAFT_COMPANIES_ID=<?php echo $resultDraftsCompanies->draft_companies_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                    <i class="fas fa-at"></i>

                                    Email

                                </a>

                                <li><hr class="dropdown-divider"></li>

                                <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=ACTION&TABLE=DRAFTS_COMPANIES&ACTION=DRAFTS_COMPANIES_DELETE&DRAFT_COMPANY_ID=<?php echo @(int)$resultDraftsCompanies->draft_companies_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                    <i class="fas fa-fire-alt me-1"></i>

                                    Excluir

                                </a>

                            </li>

                        </ul>

                        <form role="form" id="formDraftsCompaniesPrint<?php echo $keyResultDraftsCompanies ?>">

                            <input type="hidden" name="draft_companies_id" value="<?php echo $resultDraftsCompanies->draft_companies_id ?>" />
                            <input type="hidden" name="FOLDER" value="ACTION" />
                            <input type="hidden" name="TABLE" value="DRAFTS_COMPANIES" />
                            <input type="hidden" name="ACTION" value="DRAFTS_COMPANIES_PRINT" />

                        </form>

                    </div>

                </td>

            </tr>

        <?php } ?>

    </tbody>

</table>

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
