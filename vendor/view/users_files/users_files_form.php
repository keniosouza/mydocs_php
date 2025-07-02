<?php

/** Importação de classes */
use \vendor\model\UsersFiles;
use \vendor\controller\users_files\UsersFilesValidate;

/** Instânciamento de classes */
$UsersFiles = new UsersFiles();
$UsersFilesValidate = new UsersFilesValidate();

/** Pego o id do usuário */
$UsersFilesValidate->setUserId(@(int)filter_input(INPUT_POST, 'USER_ID', FILTER_SANITIZE_SPECIAL_CHARS))

?>

<div class="row">

    <div class="col-md-10">

        <h5>

            <strong>

                <i class="far fa-user-circle me-1"></i>

                Usuários

            </strong>

            /Arquivos/Formulário

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=<?php echo utf8_encode(@(string)$UsersFilesValidate->getUserId())?>')">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="usersFilesForm">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="name">

                                Nome

                            </label>

                            <input type="text" class="form-control" name="name" id="name">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="file">

                                Arquivo

                            </label>

                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="file" name="file" onchange="prepareUploadFile('#file')" accept=".jpg, .png, .jpeg, .pdf">
                                <label class="custom-file-label" for="customFile">

                                    Choose file

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-primary" onclick="sendForm('#usersFilesForm')">

                    <i class="far fa-paper-plane me-1"></i>Salvar

                </button>

                <input type="hidden" name="user_id" value="<?php echo utf8_encode($UsersFilesValidate->getUserId())?>"/>
                <input type="hidden" name="base64" value="" id="base64"/>
                <input type="hidden" name="extension" value="" id="extension"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="USERS_FILES"/>
                <input type="hidden" name="ACTION" value="USERS_FILES_SAVE"/>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {

        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    });

</script>