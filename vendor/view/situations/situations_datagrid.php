<?php

/** Importação de classes */

use \vendor\model\Situations;

/** Instânciamento de classes */
$Situations = new Situations();

?>

<div class="row animate slideIn mb-1">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-thermometer-half me-1"></i>

                Status

            </strong>

        </h5>

    </div>

    <div class="col-md-6 text-end">

        <button type="button" class="btn btn-primary btn-sm" onclick="sendRequest('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_FORM', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-plus me-1"></i>Novo

        </button>

    </div>

</div>

<?php

/** Verifico se existem registros */
if (count($Situations->all()) > 0) { ?>


    <div class="row animate slideIn mb-1">
        <div class="col-md-12">

            <!--Barra de Pesquisa-->
            <div class="form-group mb-2">

                <input type="text" class="form-control shadow-sm" placeholder="Pesquise por: Nome" id="search" name="search">

            </div>

            <div class="table-responsive">

                <table class="table table-hover bg-white shadow-sm border" id="search_table">

                    <thead id="search_table_head">
                        <tr>
                            <th class="text-center">

                                Nº

                            </th>


                            <th class="text-left" width="80%">

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
                        foreach ($Situations->all() as $keyResultSituations => $resultSituations) { ?>

                            <tr class="border-top">

                                <td class="text-center">

                                    <?php echo $resultSituations->situation_id; ?>

                                </td>

                                <td>

                                    <?php echo $resultSituations->name; ?>

                                </td>

                                <td class="text-center">


                                    <form role="form" id="formSituations<?php echo $keyResultSituations ?>" class="btn-group dropdown">
                                    
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="buttonDropdown_<?php echo $keyResultSituations ?>" data-bs-toggle="dropdown" aria-expanded="false">

                                            <i class="fas fa-cog"></i>

                                        </button>

                                        <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                           <a class="dropdown-item" onclick="sendRequest('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_FORM&SITUATION_ID=<?php echo @(int)$resultSituations->situation_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                    <i class="fas fa-user-edit"></i>

                                                    Editar

                                                </a>

                                            <li><hr class="dropdown-divider"></li>

                                            <a class="dropdown-item" onclick="sendRequest('FOLDER=ACTION&TABLE=SITUATIONS&ACTION=SITUATIONS_DELETE&SITUATION_ID=<?php echo @(int)$resultSituations->situation_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                    <i class="fas fa-fire-alt"></i>

                                                    Excluir
                                                </a>

                                        </div>
                                      

                                        <input type="hidden" name="situation_id" value="<?php echo @(int)$resultSituations->situation_id ?>" />
                                        <input type="hidden" name="FOLDER" value="ACTION" />
                                        <input type="hidden" name="TABLE" value="SITUATIONS" />
                                        <input type="hidden" name="ACTION" value="SITUATIONS_DELETE" />

                                    </form>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

<?php

} else { ?>

    <div class="alert alert-warning border-warning shadow-sm mt-3" role="alert">

        <h4 class="alert-heading">

            <strong>

                Ooops!

            </strong>

        </h4>

        <p>

            Nao encontramos nenhuma situação cadastrada.

        </p>

    </div>


<?php } ?>

<script type="text/javascript">
    /** Carrego o LiveSearch */
    loadLiveSearch();
</script>