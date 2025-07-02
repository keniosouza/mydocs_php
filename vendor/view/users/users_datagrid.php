<?php

/** Importação de classes */

use \vendor\model\Users;
use \vendor\model\UsersFiles;

/** Instânciamento de classes */
$users = new Users();
$userFiles = new UsersFiles();

/** Verifico se existem registros */
if (count($users->all()) > 0) { ?>

    <div class="row animate slideIn">

        <div class="col-md-6">

            <h5 class="card-title">

                <strong>

                    <i class="fas fa-user me-1"></i>

                    Usuários

                </strong>

            </h5>

        </div>

        <div class="col-md-6 text-end">
        
            <button type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_FORM&USER_ID=0', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-plus me-1"></i>Novo

            </button>

        </div>

        <div class="col-md-12">

            <div class="form-group mb-2">

                <input type="text" class="form-control shadow-sm" placeholder="Pesquise por: Nome" id="search" name="search">

            </div>

            <div class="table-responsive">

                <table class="table table-hover bg-white shadow-sm border" id="search_table">

                    <thead id="search_table_head">
                        <tr>

                            <th class="text-center">

                                Status

                            </th>

                            <th>

                                Nome

                            </th>

                            <th>

                                Cargo

                            </th>

                            <th class="text-center">

                                Operações

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        /** Consulta os usuário cadastrados*/
                        foreach ($users->all() as $keyResultUsers => $resultUsers) { ?>

                            <tr class="border-top">

                                <td class="text-center">

                                    <?php

                                    /** Defino a classe de badge que irá usar */
                                    $cssBadge = null;

                                    /** Verifico o tipo de status */
                                    switch ($resultUsers->situation_id) {

                                        case 1:
                                            $cssBadge = 'success';
                                            break;

                                        case 2:
                                            $cssBadge = 'danger';
                                            break;

                                        case 3:
                                            $cssBadge = 'primary';
                                            break;

                                        case 4:
                                            $cssBadge = 'info';
                                            break;
                                    }

                                    ?>

                                    <span class="badge bg-<?php echo $cssBadge; ?>">

                                        <?php echo $resultUsers->situation_name; ?>

                                    </span>

                                </td>

                                <td>

                                    <?php echo $resultUsers->nickname; ?>

                                </td>

                                <td>

                                    <?php echo $resultUsers->office; ?>

                                </td>

                                <td class="text-center">

                                    <div class="dropdown-center">

                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                            <i class="fas fa-cog"></i>

                                        </button>

                                        <ul class="dropdown-menu">

                                            <li>

                                                <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_FORM&USER_ID=<?php echo $resultUsers->user_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                    <i class="fas fa-user-edit me-1"></i>

                                                    Editar

                                                </a>

                                                <a class="dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=<?php echo $resultUsers->user_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                    <i class="fas fa-eye"></i>

                                                    Detalhes

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

            Não encontramos nenhum usuário cadastrado.

        </p>

    </div>

<?php } ?>

<script type="text/javascript">
    /** Carrego o LiveSearch */
    loadLiveSearch();
</script>