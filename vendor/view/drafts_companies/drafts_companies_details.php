<?php
/** Ativo a exibição de erros */
error_reporting(E_ALL);
ini_set('display_errors', 'On');

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

        /Minuta/Detalhes/

    </h5>

    <div class="col text-end">

        <button type="button" class="btn btn-primary btn-sm mb-0" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=<?php echo @(int)$resultDraftCompanies->company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-chevron-left me-1"></i>Voltar

        </button>

    </div>

</div>

<div class="col-md-12">

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">

            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">

                Texto

            </button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">

                Histórico

            </button>

        </li>

    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div class="card">

                <div class="card-body">

                    <?php echo @(string)$resultDraftCompanies->text ?>

                </div>

            </div>

        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

            <div class="row g-2">

                <?php

                /** Pego o histórico existente */
                $history = json_decode($resultDraftCompanies->history, TRUE);

                /** Listo os acessos realizados */
                foreach ($history as $keyResultHistory => $resultHistory) { ?>

                    <div class="col-md-3 d-flex animate slideIn">

                        <div class="card w-100 shadow-sm border-badge-success">

                            <div class="card-body">

                                <div class="card-text">

                                    <b>Título</b>: <?php echo @(string)$resultHistory['title'] ?> <br>
                                    <b>Usuário</b>: <?php echo @(string)$resultHistory['user'] ?> <br>
                                    <b>Descrição</b>: <?php echo @(string)$resultHistory['description'] ?> <br>
                                    <b>Data</b>: <?php echo @(string)$resultHistory['date'] ?> <br>
                                    <b>Horário</b>: <?php echo @(string)$resultHistory['time'] ?> <br>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>