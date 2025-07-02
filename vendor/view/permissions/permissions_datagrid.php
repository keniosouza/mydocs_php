<?php

    /** Importação de classes */
    use \vendor\model\Permissions;

    /** Instânciamento de classes */
    $permissions = new Permissions();

?>

<div class="row">

    <div class="col-md-6 animate__animated animate__fadeIn">

        <h4 class="card-title">

            <strong>Permissões</strong>/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=GERAL&ACTION=DATAGRIDSERVICE')">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>

        </h4>

    </div>

    <div class="col-md-6 text-end animate__animated animate__fadeIn">

        <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=PERMISSIONS&ACTION=PERMISSIONS_FORM')">

            <i class="fas fa-pencil-alt me-1"></i>Nova Permissão

        </button>

    </div>

</div>

<?php

/** Verifico se existem registros */
if (count($permissions->all()) > 0)
{ ?>

    <div class="row animate slideIn">

        <?php

        foreach ($permissions->all() as $keyResultPermission => $resultPermissions)
        { ?>

            <form role="form" id="formPermissions_<?php echo utf8_encode($keyResultPermission)?>" class="col-md-3 mb-3 d-flex">

                <div class="card shadow-sm w-100">

                    <div class="card-body">

                        <span class="badge badge-primary">

                            #<?php echo utf8_encode($resultPermissions->permission_id)?>

                        </span>


                        <h5 class="card-title mt-1">

                            <?php echo utf8_encode($resultPermissions->name)?>

                        </h5>

                        <p class="text-muted mt-1 mb-0">

                            <i class="far fa-clock me-1"></i><?php echo date('d-m-Y', strtotime(@(string)$resultPermissions->date_register))?>

                        </p>

                    </div>

                    <nav class="navbar navbar-expand-lg navbar-light bg-light card-footer bg-transparent">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item">

                                    <a type="button" class="nav-link" onclick="request('FOLDER=VIEW&TABLE=PERMISSIONS&ACTION=PERMISSIONS_FORM&PERMISSION_ID=<?php echo @(int)$resultPermissions->permission_id?>')">

                                        <i class="fas fa-pencil-alt"></i>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a type="button" class="nav-link" onclick="modalConfirm('Atenção', 'Você esta prestes a excluir este registro. Deseja Continuar?', 'formPermissions_<?php echo @(int)$keyResultPermission?>')">

                                        <i class="fas fa-fire-alt"></i>

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </nav>

                </div>

                <input type="hidden" name="permission_id" value="<?php echo utf8_encode(@(int)$resultPermissions->permission_id)?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="PERMISSIONS"/>
                <input type="hidden" name="ACTION" value="PERMISSIONS_DELETE"/>

            </form>

        <?php }?>

    </div>

    <?php

}else{ ?>

    <div class="card shadow-sm mb-3 animate slideIn">

        <div class="card-body text-center">

            <h1 class="card-title text-center">

                <span class="badge badge-primary">

                    CC-1

                </span>

            </h1>

            <h4 class="card-subtitle text-center text-muted">

                Ops! Não foram localizados <strong>categorias de conteúdo</strong>! Clique para poder <strong>cadastrar</strong>.

            </h4>

            <div class="text-center my-3">

                <img src="image/observatory.svg" alt="Flux - Página Não Encontrada" class="img-fluid" width="100">

            </div>

            <a type="button" class="stretched-link text-muted text-decoration-none mt-3" onclick="request('FOLDER=VIEW&TABLE=CONTENTCATEGORIES&ACTION=CONTENT_CATEGORIES_FORM')"></a>

        </div>

    </div>

<?php }?>
