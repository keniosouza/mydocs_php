<?php

/** Importação de classes */

use \vendor\model\Users;
use \vendor\controller\users\UsersValidate;
use \vendor\model\Permissions;
use \vendor\model\Situations;

/** Instânciamento de classes */
$users = new Users();
$usersValidate = new UsersValidate();
$Permissions = new Permissions();
$Situations = new Situations();

/** Tratamento dos dados de entrada */
$usersValidate->setUserId(@(int)filter_input(INPUT_POST, 'USER_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Busca de registro */
$resultUsers = $users->get($usersValidate->getUserId());

?>

<div class="container-center">
    <div class="row align-items-start">

        <h5 class="card-title col">
            <strong>
                <i class="fas fa-user me-1"></i>
                Usuários
            </strong>
            <i class="fas fa-chevron-right regular"></i> Edição
        </h5>

        <div class="text-end col">
            <a type="button" class="btn btn-primary btn-sm text-end" onclick="sendRequest('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">
                <i class="fas fa-chevron-left me-1"></i>Voltar
            </a>
        </div>
    </div>
</div>

<div class="col-md-12">

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">

            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">

                Dados Gerais

            </button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="company-tab" data-bs-toggle="tab" data-bs-target="#company-tab-pane" type="button" role="tab" aria-controls="company-tab-pane" aria-selected="false">

                Empresarial

            </button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="access-tab" data-bs-toggle="tab" data-bs-target="#access-tab-pane" type="button" role="tab" aria-controls="access-tab-pane" aria-selected="false">

                Acesso

            </button>

        </li>

    </ul>
</div>

<form id="UsersForm" role="form" class="card shadow-sm animate slideIn ">
    <div class="tab-content" id="myTabContent">
        <!--Dados Gerais-->
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div class="card-body">

                <div class="row g-2">

                    <!--Permissoes-->
                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="permission_id">

                                <b>Permissões</b>

                            </label>

                            <select class="form-select" id="permission_id" name="permission_id">

                                <?php

                                /** Listo todas as permissões */
                                foreach ($Permissions->all() as $keyResultPermissions => $resultPermissions) { ?>

                                    <option value="<?php echo $resultPermissions->permission_id ?>">

                                        <?php echo $resultPermissions->name ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="situation_id">

                                <b>Situação</b>

                            </label>

                            <select class="form-select" id="situation_id" name="situation_id">

                                <?php

                                /** Listo todas as permissões */
                                foreach ($Situations->all() as $keyResultSituations => $resultSituations) { ?>

                                    <option value="<?php echo $resultSituations->situation_id ?>">

                                        <?php echo $resultSituations->name ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-2">

                        <div class="form-group">

                            <label for="date_birth">

                                <b>Data de Nascimento</b>

                            </label>

                            <input id="date_birth" type="date" class="form-control" name="date_birth" value="<?php echo date('m-d-Y', strtotime(@$resultUsers->date_birth)) ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name">

                                <b>Nome Completo</b>

                            </label>

                            <input id="name" type="text" class="form-control" name="name" value="<?php echo @$resultUsers->name ?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="nickname">

                                <b>Nome de Usuário</b>

                            </label>

                            <input id="nickname" type="text" class="form-control" name="nickname" value="<?php echo @$resultUsers->nickname ?>">

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--Empresarial-->
        <div class="tab-pane fade" id="company-tab-pane" role="tabpanel" aria-labelledby="company-tab" tabindex="0">

            <div class="card-body">

                <div class="row g-2">

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="office">

                                <b>Data de Admissão</b>

                            </label>

                            <input type="date" id="date_admission" class="form-control" name="date_admission" value="<?php echo date('m-d-y', strtotime(@$resultUsers->date_admission)) ?>">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="ctps">

                                <b>CTPS</b>

                            </label>

                            <input type="text" id="ctps" class="form-control" name="ctps" value="<?php echo @$resultUsers->ctps ?>">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="ctps_serie">

                                <b>CTPS Serie</b>

                            </label>

                            <input type="text" id="ctps_serie" class="form-control" name="ctps_serie" value="<?php echo @$resultUsers->ctps_serie ?>">

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <label for="pis">

                                <b>PIS</b>

                            </label>

                            <input type="text" id="pis" class="form-control" name="pis" value="<?php echo @$resultUsers->pis ?>">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="date_admission">

                                <b>Cargo</b>

                            </label>

                            <input type="text" id="office" class="form-control" name="office" value="<?php echo @$resultUsers->office ?>">


                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--Acesso-->
        <div class="tab-pane fade" id="access-tab-pane" role="tabpanel" aria-labelledby="access-tab" tabindex="0">

            <div class="card-body">

                <div class="row g-2">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="email">

                                <b>Email</b>

                            </label>

                            <input type="email" id="email" class="form-control" name="email" value="<?php echo @$resultUsers->email ?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="password">

                                <b>Senha</b>

                            </label>

                            <input type="password" id="password" class="form-control" name="password">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group text-end  me-3 mb-2">
            <button type="button" class="btn btn-success " onclick="sendRequest('UsersForm', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">
                <i class="far fa-save me-2"></i>Salvar
            </button>
        </div>

    </div>
    <input type="hidden" name="user_id" value="<?php echo @$resultUsers->user_id ?>" />
    <input type="hidden" name="FOLDER" value="ACTION" />
    <input type="hidden" name="TABLE" value="USERS" />
    <input type="hidden" name="ACTION" value="USERS_SAVE" />

</form>



</div>

<script type="text/javascript">
    /** Carregamento de mascara */
    loadMask();
</script>