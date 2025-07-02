<?php

/** Importação de classes */
use \vendor\model\Drafts;
use \vendor\controller\users\UsersValidate;

/** Instânciamento de classes */
$Drafts = new Drafts();
$UsersValidate = new UsersValidate();

/** Operações */
$UsersValidate->setUserId(@(int)filter_input(INPUT_POST, 'USER_ID',FILTER_SANITIZE_SPECIAL_CHARS));

?>

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-building me-1"></i>Usuários

            </strong>

            /Minuta/Gerar/

            <button type="button" class="btn btn-primary btn-sm mb-0" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=<?php echo utf8_decode(@(int)$resultDraftUsers->user_id)?>')">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="formDraftsCompanies">

                <div class="row">

                    <?php

                    /** Listagem de Todos os Registros */
                    foreach ($Drafts->all() as $keyResultDrafts => $resultDrafts)
                    { ?>

                        <div class="col-md-12">

                            <div class="form-group">

                                <div class="custom-control custom-radio">

                                    <input type="radio" id="draft_<?php echo utf8_encode($resultDrafts->draft_id)?>" name="draft_id" value="<?php echo utf8_encode($resultDrafts->draft_id)?>" class="custom-control-input">
                                    <label class="custom-control-label" for="draft_<?php echo utf8_encode($resultDrafts->draft_id)?>">

                                        <?php echo utf8_encode($resultDrafts->name)?>

                                    </label>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                    <div class="col-md-12 text-end">

                        <button type="button" class="btn btn-primary" onclick="sendForm('#formDraftsCompanies')">

                            <i class="far fa-paper-plane me-1"></i>Salvar

                        </button>

                    </div>

                </div>

                <input type="hidden" name="user_id" value="<?php echo utf8_decode(@(int)$UsersValidate->getUserId())?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="DRAFTS_USERS"/>
                <input type="hidden" name="ACTION" value="DRAFTS_USERS_SAVE"/>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    loadCKEditor();

</script>