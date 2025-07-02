<?php

/** Importação de classes */
use \vendor\model\Companies;

/** Instânciamento de classes */
$Companies = new Companies();

?>

<div class="row mb-2">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-building me-1"></i>

                Empresas

            </strong>

        </h5>

    </div>

    <!--Botao Novo-->
    <div class="col-md-6 text-end">

        <button class="btn btn-primary btn-sm mb-1" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_FORM&COMPANY_ID=0', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-plus me-1"></i>Novo

        </button>

    </div>

</div>

<?php

/** Verifico se existem registros */
if (count($Companies->all()) > 0) { ?>

    <div class="col-md-12 animate slideIn">

        <!--Barra de Pesquisa-->
        <div class="col-md-12">

            <div class="form-group mb-2">

                <input type="text" class="form-control shadow-sm" placeholder="Pesquisar" id="search" name="search">

            </div>

            <table class="table table-hover bg-white shadow-sm border align-middle" id="search_table">

                <thead id="search_table_head">

                    <tr>

                        <th class="text-center">

                            #

                        </th>

                        <th class="text-center">

                            Status

                        </th>

                        <th class="text-center" width="15%">

                            CNPJ

                        </th>

                        <th>

                            Apelido

                        </th>

                        <th class="text-left">

                            Nome Fantasia

                        </th>

                        <th>

                            Responsável

                        </th>

                        <th class="text-center">

                            Operações

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    /** Consulta os usuário cadastrados*/
                    foreach ($Companies->all() as $keyResultCompanies => $resultCompanies) { ?>

                        <tr class="border-top">

                            <td class="text-center">

                                <?php echo $resultCompanies->company_id; ?>

                            </td>

                            <td class="text-center">

                                <?php

                                /** Defino a classe de badge que irá usar */
                                $cssBadge = null;

                                /** Verifico o tipo de status */
                                switch ($resultCompanies->situation_id) {

                                    case 1:
                                        $cssBadge = 'success';
                                        break;

                                    case 2:
                                        $cssBadge = 'danger';
                                        break;

                                    case 3:
                                        $cssBadge = 'primary';
                                        break;
                                }

                                ?>

                                <span class="badge bg-<?php echo ($cssBadge); ?>">

                                    <?php echo $resultCompanies->name; ?>

                                </span>

                            </td>

                            <td class="cnpj">

                                <?php echo str_replace(' ', '', $resultCompanies->cnpj); ?>

                            </td>

                            <td>

                                <?php echo $resultCompanies->nickname; ?>

                            </td>

                            <td>

                                <?php echo $resultCompanies->name_fantasy; ?>

                            </td>

                            <td class="text-center">

                                <?php

                                if (!empty($resultCompanies->responsible) && !empty($resultCompanies->responsible_office)) {

                                    echo $resultCompanies->responsible . " - " . $resultCompanies->responsible_office;
                                } else {

                                    echo $resultCompanies->responsible;
                                } ?>

                            </td>

                            <td class="text-center">

                                <div class="dropdown">

                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                        <i class="fas fa-cog"></i>

                                    </button>

                                    <ul class="dropdown-menu">

                                        <li>
                                            
                                            <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_FORM&COMPANY_ID=<?php echo $resultCompanies->company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                <i class="fas fa-user-edit me-1"></i>

                                                Editar

                                            </a>
                                        
                                        </li>

                                        <li>
                                            
                                            <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=<?php echo $resultCompanies->company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                <i class="fas fa-eye me-1"></i>

                                                Detalhes

                                            </a>
                                        
                                        </li>

                                        <li><hr class="dropdown-divider"></li>

                                        <li>
                                            
                                            <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DELETE&COMPANY_ID=<?php echo @(int)$resultDrafts->draft_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                <i class="fas fa-fire-alt me-1"></i>

                                                Excluir

                                            </a>
                                        
                                        </li>                                      

                                    </ul>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    <?php

} else { ?>

        <div class="col-md-12">

            <div class="alert alert-warning border-warning shadow-sm" role="alert">

                <h4 class="alert-heading">

                    <strong>

                        Ooops!

                    </strong>

                </h4>

                <p>

                    Não encontramos nenhuma empresa cadastrada.

                </p>

            </div>

        </div>

    <?php } ?>

    <script type="text/javascript">

        /** Carrego as mascaras */
        loadMask();

        /** Carrego o LiveSearch */
        loadLiveSearch();
        
    </script>