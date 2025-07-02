<?php

/** Importação de classes */

use \vendor\model\DraftsUsers;
use \vendor\model\Users;
use \vendor\model\UsersFiles;
use \vendor\controller\users\UsersValidate;

/** Instânciamento de classes */
$DraftsUsers = new DraftsUsers();
$Users = new Users();
$UsersFiles = new UsersFiles();
$UsersValidate = new UsersValidate();

/** Parâmetros de Entrada */
$UsersValidate->setUserId(@(int)filter_input(INPUT_POST, 'USER_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Operações */
$resultUsers = $Users->get($UsersValidate->getUserId());

?>

<div class="container-center">
    <div class="row align-items-start">
        
        <h5 class="card-title col">

            <strong>

                <i class="far fa-user-circle me-1"></i>

                Usuários

            </strong>

            <i class="fas fa-chevron-right regular"></i> Detalhes
        </h5>

        <div class=" col text-end">
            <a type="button" class="btn btn-primary btn-sm" onclick="sendRequest('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">
                <i class="fas fa-chevron-left me-1"></i>Voltar
            </a>
        </div>
    </div>
</div>

<div class="col-md-12">

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">

            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">

                <i class="fas fa-info me-1"></i>Início

            </button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-tab-pane" type="button" role="tab" aria-controls="documents-tab-pane" aria-selected="false">

                <i class="far fa-file-word me-1"></i>Documentos

            </button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="files-tab" data-bs-toggle="tab" data-bs-target="#files-tab-pane" type="button" role="tab" aria-controls="files-tab-pane" aria-selected="false">

                <i class="far fa-file-word me-1"></i>Arquivos

            </button>

        </li>

    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div class="card shadow-sm animate slideIn">

                <div class="card-body">

                    <div class="tab-content" id="pills-tabContent">

                        
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <h6 class="card-title text-muted">

                                <i class="fas fa-info me-1"></i>Dados Cadastrais

                            </h6>

                            <div class="row g-2">

                                <div class="col-md">

                                    <h6 class="mt-0 mb-0">

                                        <b>Apelido</b>

                                    </h6>

                                    <h6>

                                        <span>

                                            <?php echo $resultUsers->nickname ?>

                                        </span>

                                    </h6>

                                </div>

                                <div class="col-md">

                                    <h6 class="mt-0 mb-0">

                                        <b>Nome Completo</b>

                                    </h6>

                                    <h6>

                                        <span>

                                            <?php echo $resultUsers->name ?>

                                        </span>

                                    </h6>

                                </div>

                                <div class="col-md">

                                    <h6 class="mt-0 mb-0">

                                        <b>Cargo</b>

                                    </h6>

                                    <h6>

                                        <span>

                                            <?php echo $resultUsers->office ?>

                                        </span>

                                    </h6>

                                </div>

                                <div class="col-md">

                                    <h6 class="mt-0 mb-0">

                                        <b>Nascimento</b>

                                    </h6>

                                    <h6>

                                        <span>

                                            <?php echo date('d/m/Y', strtotime(@(string)$resultUsers->date_birth)) ?>

                                        </span>

                                    </h6>

                                </div>

                                <div class="col-md">

                                    <h6 class="mt-0 mb-0">

                                        <b>Email</b>

                                    </h6>

                                    <h6>

                                        <span>

                                            <?php echo $resultUsers->email ?>

                                        </span>

                                    </h6>

                                </div>

                            </div>

                            <h6 class="card-title text-muted">

                                <i class="fas fa-info me-1"></i>Histórico

                            </h6>

                            <div class="row g-2">

                                <?php

                                /** Pego o histórico existente */
                                $history = json_decode($resultUsers->history, TRUE);

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

            </div>

        </div>

        <div class="tab-pane fade" id="documents-tab-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">

            <a type="button" onclick="request('FOLDER=VIEW&TABLE=DRAFTS_USERS&ACTION=DRAFTS_USERS_FORM&USER_ID=<?php echo @(int)$resultUsers->user_id ?>')" class="btn btn-primary w-100 my-2">

                <i class="fas fa-plus me-1"></i>Novo

            </a>

            <table class="table table-bordered table-borderless table-hover bg-white shadow-sm border">

                <thead>
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
                    foreach ($DraftsUsers->all(@(int)$resultUsers->user_id) as $keyResultDraftUser => $resultDraftUser) { ?>

                        <tr class="border-top">

                            <td class="text-center">

                                <?php echo $resultDraftUser->draft_user_id; ?>

                            </td>

                            <td>

                                <?php echo $resultDraftUser->name; ?>

                            </td>

                            <td class="text-center">

                                <div class="btn-group dropleft">

                                    <button class="btn btn-primary dropdown-toggle" type="button" id="buttonDropdown_<?php echo $keyResultDraftUser ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <i class="fas fa-cog"></i>

                                    </button>

                                    <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                        <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=DRAFTS_USERS&ACTION=DRAFTS_USERS_FORM_TEXT&DRAFT_USER_ID=<?php echo @(int)$resultDraftUser->draft_user_id ?>')">

                                            <span class="badge badge-primary me-1">

                                                <i class="fas fa-user-edit"></i>

                                            </span>

                                            Editar

                                        </a>

                                        <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=DRAFTS_USERS&ACTION=DRAFTS_USERS_DETAILS&DRAFT_USER_ID=<?php echo @(int)$resultDraftUser->draft_user_id ?>')">

                                            <span class="badge badge-primary me-1">

                                                <i class="fas fa-eye"></i>

                                            </span>

                                            Detalhes

                                        </a>

                                        <a type="button" class="dropdown-item" onclick="sendForm('#formDraftsUsersPrint_<?php echo $keyResultDraftUser ?>')">

                                            <span class="badge badge-primary me-1">

                                                <i class="fas fa-print"></i>

                                            </span>

                                            PDF

                                        </a>

                                        <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=DRAFTS_USERS&ACTION=DRAFTS_USERS_FORM_EMAIL&DRAFT_USER_ID=<?php echo $resultDraftUser->draft_user_id ?>')">

                                            <span class="badge badge-primary me-1">

                                                <i class="fas fa-at"></i>

                                            </span>

                                            Email

                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a type="button" class="dropdown-item" onclick="modalConfirm('Atenção', 'O registro: <strong><?php echo $resultDraftUser->name; ?></strong>, será removido. Deseja Continuar?', 'formDraftsUsers_<?php echo $keyResultDraftUser ?>')">

                                            <span class="badge badge-danger me-1">

                                                <i class="fas fa-fire-alt"></i>

                                            </span>

                                            Excluir

                                        </a>

                                        <form role="form" id="formDraftsUsers_<?php echo $keyResultDraftUser ?>">

                                            <input type="hidden" name="draft_user_id" value="<?php echo @(int)$resultDraftUser->draft_user_id ?>" />
                                            <input type="hidden" name="FOLDER" value="ACTION" />
                                            <input type="hidden" name="TABLE" value="DRAFTS_USERS" />
                                            <input type="hidden" name="ACTION" value="DRAFTS_USERS_DELETE" />

                                        </form>

                                        <form role="form" id="formDraftsUsersPrint_<?php echo $keyResultDraftUser ?>">

                                            <input type="hidden" name="draft_user_id" value="<?php echo $resultDraftUser->draft_user_id ?>" />
                                            <input type="hidden" name="FOLDER" value="ACTION" />
                                            <input type="hidden" name="TABLE" value="DRAFTS_USERS" />
                                            <input type="hidden" name="ACTION" value="DRAFTS_USERS_PRINT" />

                                        </form>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>

        <div class="tab-pane fade" id="files-tab-pane" role="tabpanel" aria-labelledby="files-tab" tabindex="0">

            <a type="button" onclick="request('FOLDER=VIEW&TABLE=USERS_FILES&ACTION=USERS_FILES_FORM&USER_ID=<?php echo @(int)$resultUsers->user_id ?>')" class="btn btn-primary w-100 my-2">

                <i class="fas fa-plus me-1"></i>Novo

            </a>

            <table class="table table-bordered table-borderless table-hover bg-white shadow-sm border">

                <thead>
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
                    foreach ($UsersFiles->All(@(int)$resultUsers->user_id) as $keyResultUsersFiles => $resultUsersFiles) { ?>

                        <tr class="border-top">

                            <td class="text-center">

                                <?php echo $resultUsersFiles->user_file_id; ?>

                            </td>

                            <td>

                                <?php echo $resultUsersFiles->name; ?>

                            </td>

                            <td class="text-center">

                                <div class="btn-group dropleft">

                                    <button class="btn btn-primary dropdown-toggle" type="button" id="buttonDropdown_<?php echo $keyResultUsersFiles ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <i class="fas fa-cog"></i>

                                    </button>

                                    <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                        <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=USERS_FILES&ACTION=USERS_FILES_DETAIL&USER_FILE_ID=<?php echo @(int)$resultUsersFiles->user_file_id ?>')">

                                            <span class="badge badge-primary me-1">

                                                <i class="fas fa-eye"></i>

                                            </span>

                                            Detalhes

                                        </a>

                                        <a type="button" class="dropdown-item" onclick="<?php echo $resultUsersFiles->extension === 'pdf' ? 'modalDocument' : 'modalImage' ?>('<?php echo ($resultUsersFiles->name) ?>', '<?php echo $resultUsersFiles->path ?>')">

                                            <span class="badge badge-primary me-1">

                                                <i class="fas fa-search"></i>

                                            </span>

                                            Visualizar

                                        </a>

                                        <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=USERS_FILES&ACTION=USERS_FILES_FORM_EMAIL&USER_FILE_ID=<?php echo $resultUsersFiles->user_file_id ?>')">

                                            <span class="badge badge-primary me-1">

                                                <i class="fas fa-at"></i>

                                            </span>

                                            Email

                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a type="button" class="dropdown-item" onclick="modalConfirm('Atenção', 'O registro: <strong><?php echo $resultUsersFiles->name; ?></strong>, será removido. Deseja Continuar?', 'formUsersFilesDelete_<?php echo $keyResultUsersFiles ?>')">

                                            <span class="badge badge-danger me-1">

                                                <i class="fas fa-fire-alt"></i>

                                            </span>

                                            Excluir

                                        </a>

                                        <form role="form" id="formUsersFilesDelete_<?php echo $keyResultUsersFiles ?>">

                                            <input type="hidden" name="user_file_id" value="<?php echo @(int)$resultUsersFiles->user_file_id ?>" />
                                            <input type="hidden" name="FOLDER" value="ACTION" />
                                            <input type="hidden" name="TABLE" value="USERS_FILES" />
                                            <input type="hidden" name="ACTION" value="USERS_FILES_DELETE" />

                                        </form>

                                        <form role="form" id="formDraftsUsersPrint_<?php echo $keyResultUsersFiles ?>">

                                            <input type="hidden" name="draft_user_id" value="<?php echo $resultUsersFiles->user_file_id ?>" />
                                            <input type="hidden" name="FOLDER" value="ACTION" />
                                            <input type="hidden" name="TABLE" value="DRAFTS_USERS" />
                                            <input type="hidden" name="ACTION" value="DRAFTS_USERS_PRINT" />

                                        </form>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>