<?php

/** Importação de classes */
use \vendor\model\UsersFiles;
use \vendor\controller\users_files\UsersFilesValidate;

/** Instânciamento de classes */
$UsersFiles = new UsersFiles();
$UsersFilesValidate = new UsersFilesValidate();

/** Pego o id do usuário */
$UsersFilesValidate->setUserFileId(@(int)filter_input(INPUT_POST, 'USER_FILE_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico se existe registro */
if ($UsersFilesValidate->getUserFileId() > 0) {

    /** Busca de registro */
    $resultUserFile = $UsersFiles->Get($UsersFilesValidate->getUserFileId());

}

?>

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-building me-1"></i>Usuários

            </strong>

            /Email/Edição/

            <button type="button" class="btn btn-primary btn-sm mb-0" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=<?php echo utf8_decode(@(int)$resultUserFile->user_id)?>')">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="formDrafts">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="text">

                                Texto:

                            </label>

                            <div id="text_toolbar"></div>

                            <div id="text" class="border editor">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12 text-end">

                        <button type="button" class="btn btn-primary" onclick="sendForm('#formDrafts', 'S')">

                            <i class="far fa-paper-plane me-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="user_file_id" value="<?php echo utf8_decode(@(int)$resultUserFile->user_file_id)?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="USERS_FILES"/>
                <input type="hidden" name="ACTION" value="USERS_FILES_EMAIL"/>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    loadCKEditor();

</script>