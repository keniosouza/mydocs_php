<?php

    /** Importação de classes */
    use \vendor\model\Permissions;
    use \vendor\controller\Permissions\PermissionsValidate;

    /** Instânciamento de classes */
    $permissions = new Permissions();
    $permissionsValidate = new PermissionsValidate();

    /** Tratamento dos dados de entrada */
    $permissionsValidate->setPermissionId(@(int)$_POST['PERMISSION_ID']);

    /** Busca de registro */
    $resultPermissions = $permissions->get($permissionsValidate->getPermissionId());

    /** Busco o template de permissões */
    $permissionsTemplate = (object)json_decode(file_get_contents('document/templates/permissions.json'));

?>

<div class="row">

    <div class="col-md-6 animate__animated animate__fadeIn">

        <h4 class="card-title">

            <span class="badge badge-primary">

                <i class="fas fa-pencil-alt"></i>

            </span>

            <strong>Formulario</strong> de cadastro

        </h4>

    </div>

    <div class="col-md-6 text-end animate__animated animate__fadeIn">

        <a type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=PERMISSIONS&ACTION=PERMISSIONS_DATAGRID')">

            <i class="fas fa-list-ul me-1"></i>Listagem de Permissões

        </a>

    </div>

    <div class="col-md-12 animate slideIn">

        <div class="card shadow-sm">

            <form class="card-body" role="form" id="formUsers">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="name">

                                Nome

                            </label>

                            <input type="text" id="name" class="form-control" name="name" value="<?php echo @(string)$resultPermissions->name?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="description">

                                Descrição

                            </label>

                            <input type="text" id="description" class="form-control" name="description" value="<?php echo @(string)$resultPermissions->description?>">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="description">

                                Permissões

                            </label>

                            <?php

                            /** Listagem dos itens do carrinho */
                            foreach ($permissionsTemplate as $keyResultCartJson => $resultCartJson)
                            {?>

                                <div class="custom-control custom-checkbox">

                                    <input type="checkbox" class="custom-control-input" id="custom_<?php echo $keyResultCartJson?>">
                                    <label class="custom-control-label" for="custom_<?php echo $keyResultCartJson?>">

                                        <?php echo $resultCartJson->title?>

                                    </label>

                                </div>

                            <?php }?>

                        </div>

                    </div>

                    <div class="col-md-12 text-end">

                        <button type="button" class="btn btn-primary" onclick="sendForm('#formUsers')">

                            <i class="far fa-paper-plane me-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="permission_id" value="<?php echo @(string)$resultPermissions->permission_id?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="PERMISSIONS"/>
                <input type="hidden" name="ACTION" value="PERMISSIONS_SAVE"/>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    /** Carregamento de mascara */
    loadMask();

</script>