<?php

/** Importação de classes */

use \vendor\model\Drafts;

/** Instânciamento de classes */
$Drafts = new Drafts();

?>

<div class="row">

    <div class="col-md-6 mb-2">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-file-word me-1"></i>

                Minutas

            </strong>

        </h5>

    </div>

    <div class="col-md-6 text-end mb-2">

        <button type="button" class="btn btn-primary text-end btn-sm " onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS&ACTION=DRAFTS_FORM', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-plus me-1"></i>Novo

        </button>

    </div>
    
    <?php

    /** Verifico se existem registros */
    if (count($Drafts->all()) > 0) { ?>

        <div class="col-md-12 animate slideIn">

            <div class="form-group mb-2">

                <input type="text" class="form-control shadow-sm" placeholder="Pesquise por: Nome" id="search" name="search">

            </div>

            <table class="table table-hover bg-white shadow-sm border" id="search_table">

                <thead id="search_table_head">

                    <tr>
                        <th class="text-center">

                            Nº

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
                    foreach ($Drafts->all() as $keyResultDrafts => $resultDrafts) { ?>

                        <tr class="border-top">

                            <td class="text-center">

                                <?php echo $resultDrafts->draft_id; ?>

                            </td>

                            <td>

                                <?php echo $resultDrafts->name; ?>

                            </td>

                            <td class="text-center">

                                <div class="dropdown-center">

                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                        <i class="fas fa-cog"></i>

                                    </button>

                                    <ul class="dropdown-menu">

                                        <li>

                                            <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS&ACTION=DRAFTS_FORM&DRAFT_ID=<?php echo @(int)$resultDrafts->draft_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                <i class="fas fa-user-edit me-1"></i>

                                                Editar

                                            </a>

                                            <li><hr class="dropdown-divider"></li>

                                            <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS&ACTION=DRAFTS_DELETE&DRAFT_ID=<?php echo @(int)$resultDrafts->draft_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

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

                    Não foram localizados registros

                </p>

            </div>

        </div>

    <?php } ?>

</div>

<script type="text/javascript">
    /** Carrego as mascaras */
    loadMask();

    /** Carrego o LiveSearch */
    loadLiveSearch();
</script>