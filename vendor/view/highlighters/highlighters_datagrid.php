<?php

/** Importação de classes */

use \vendor\model\Highlighters;

/** Instânciamento de classes */
$Highlighters = new Highlighters();

?>

<div class="row animate slideIn mb-1">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-highlighter me-1"></i>

                Marcações

            </strong>

        </h5>

    </div>

    <div class="col-md-6 text-end">

        <button type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_FORM', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-plus me-1"></i>Novo

        </button>

    </div>

</div>

<?php

/** Verifico se existem registros */
if (count($Highlighters->All()) > 0) { ?>

    <div class="row animate slideIn">

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
                        foreach ($Highlighters->All() as $keyResultHighlighter => $resultHighlighter) { ?>

                            <tr class="border-top">

                                <td class="text-center">

                                    <?php echo $resultHighlighter->highlighter_id; ?>

                                </td>

                                <td>

                                    <?php echo $resultHighlighter->name; ?>

                                </td>

                                <td class="text-center">

                                    <form role="form" id="formHighlighters<?php echo $keyResultHighlighter ?>" class="btn-group dropleft">

                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="buttonDropdown_<?php echo $keyResultHighlighter ?>" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            <i class="fas fa-cog"></i>

                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            <a type="button" class="dropdown-item" onclick="sendRequest('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_FORM&HIGHLIGHTER_ID=<?php echo @(int)$resultHighlighter->highlighter_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                <i class="fas fa-user-edit"></i>
                                                Editar
                                            </a>

                                            <li><hr class="dropdown-divider"></li>

                                            <a type="button" class="dropdown-item" onclick="sendRequest('FOLDER=ACTION&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_DELETE&HIGHLIGHTER_ID=<?php echo @(int)$resultHighlighter->highlighter_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">
                                                <i class="fas fa-fire-alt"></i>
                                                Excluir
                                            </a>

                                        </div>

                                        <input type="hidden" name="highlighter_id" value="<?php echo @(int)$resultHighlighter->highlighter_id ?>" />
                                        <input type="hidden" name="FOLDER" value="ACTION" />
                                        <input type="hidden" name="TABLE" value="HIGHLIGHTERS" />
                                        <input type="hidden" name="ACTION" value="HIGHLIGHTERS_DELETE" />

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

            Não encontramos nenhuma minuta cadastrada.
        </p>

    </div>


<?php } ?>

<script type="text/javascript">
    /** Carrego as mascaras */
    loadMask();

    /** Carrego o LiveSearch */
    loadLiveSearch();
</script>