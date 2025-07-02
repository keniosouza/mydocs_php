<?php

/** Importação de classes */
use \vendor\model\DraftsUsers;
use \vendor\controller\drafts_users\DraftsUsersValidate;

/** Instânciamento de classes */
$DraftsUsers = new DraftsUsers();
$DraftsUsersValidate = new DraftsUsersValidate();

/** Tratamento dos dados de entrada */
$DraftsUsersValidate->setDraftUserId(@(int)filter_input(INPUT_POST, 'DRAFT_USER_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico se existe registro */
if ($DraftsUsersValidate->getDraftUserId() > 0) {

    /** Busca de registro */
    $resultDraftUsers = $DraftsUsers->Get($DraftsUsersValidate->getDraftUserId());

    /** Decodifico o texto */
    $resultDraftUsers->text = utf8_decode(base64_decode($resultDraftUsers->text));

}

?>

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-building me-1"></i>Usuários

            </strong>

            /Minuta/Edição/

            <button type="button" class="btn btn-primary btn-sm mb-0" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=<?php echo utf8_decode(@(int)$resultDraftUsers->user_id)?>')">

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

                                <?php echo utf8_encode(@(string)$resultDraftUsers->text)?>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12 text-end">

                        <button type="button" class="btn btn-primary" onclick="sendForm('#formDrafts', 'S')">

                            <i class="far fa-paper-plane me-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="user_id" value="<?php echo utf8_decode(@(int)$resultDraftUsers->user_id)?>"/>
                <input type="hidden" name="draft_user_id" value="<?php echo utf8_decode(@(int)$resultDraftUsers->draft_user_id)?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="DRAFTS_USERS"/>
                <input type="hidden" name="ACTION" value="DRAFTS_USERS_SAVE_TEXT"/>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    loadCKEditor();

</script>