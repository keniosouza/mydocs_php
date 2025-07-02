<?php

/** Importação de classes */
use \vendor\model\UsersFiles;
use \vendor\controller\users_files\UsersFilesValidate;

/** Instânciamento de classes */
$UsersFiles = new UsersFiles();
$UsersFilesValidate = new UsersFilesValidate();

/** Tratamento dos dados de entrada */
$UsersFilesValidate->setUserFileId(@(int)filter_input(INPUT_POST, 'USER_FILE_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico se existe registro */
if ($UsersFilesValidate->getUserFileId() > 0) {

    /** Busca de registro */
    $resultUsersFiles = $UsersFiles->Get($UsersFilesValidate->getUserFileId());

}

?>

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-building me-1"></i>Usuários

            </strong>

            /Arquivos/Detalhes/

            <button type="button" class="btn btn-primary btn-sm mb-0" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=<?php echo utf8_decode(@(int)$resultUsersFiles->user_id)?>')">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <div class="card-body">

                <ul class="nav nav-pills nav-fill mb-2" id="pills-tab" role="tablist">

                    <li class="nav-item nav-link-pill" role="presentation">

                        <a class="nav-link active" id="pills-texto-tab" data-toggle="pill" href="#pills-texto" role="tab" aria-controls="pills-texto" aria-selected="true">

                            <i class="far fa-file-alt me-1"></i>Texto

                        </a>

                    </li>

                    <li class="nav-item nav-link-pill mx-1" role="presentation">

                        <a class="nav-link" id="pills-historico-tab" data-toggle="pill" href="#pills-historico" role="tab" aria-controls="pills-historico" aria-selected="false">

                            <i class="fas fa-history me-1"></i>Histórico

                        </a>

                    </li>

                </ul>

                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade active show" id="pills-texto" role="tabpanel" aria-labelledby="pills-texto-tab">

                        <?php
                        if ($resultUsersFiles->extension == 'pdf')
                        { ?>

                            <object data="<?php echo utf8_encode($resultUsersFiles->path)?>" type="application/pdf" class="embed-responsive embed-responsive-16by9 shadow-sm rounded" height="500px">

                                <embed src="<?php echo utf8_encode($resultUsersFiles->path)?>" type="application/pdf" class="embed-responsive-item shadow-sm rounded border"/>

                            </object>

                        <?php } else { ?>

                            <img src="<?php echo utf8_encode($resultUsersFiles->path)?>" class="img-fluid">

                        <?php } ?>

                    </div>

                    <div class="tab-pane fade show" id="pills-historico" role="tabpanel" aria-labelledby="pills-historico-tab">

                        <div class="main-card card shadow-sm">

                            <div class="card-body">

                                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

                                    <?php

                                    /** Pego o histórico existente */
                                    $history = json_decode($resultUsersFiles->history, TRUE);

                                    /** Listo os acessos realizados */
                                    foreach ($history as $keyResultHistory => $resultHistory)
                                    { ?>

                                        <div class="vertical-timeline-item vertical-timeline-element">

                                            <div>

                                                <span class="vertical-timeline-element-icon bounce-in">

                                                    <i class="badge badge-dot badge-dot-xl <?php echo @(string)$resultHistory['class']?>"> </i>

                                                </span>

                                                <div class="vertical-timeline-element-content bounce-in">

                                                    <h4 class="timeline-title">

                                                        <?php echo @(string)$resultHistory['title']?> - <?php echo @(string)$resultHistory['user']?>

                                                    </h4>

                                                    <p>

                                                        <?php echo @(string)$resultHistory['description']?>

                                                        <a href="javascript:void(0);" data-abc="true">

                                                            <?php echo @(string)$resultHistory['date']?>

                                                        </a>

                                                    </p>

                                                    <span class="vertical-timeline-element-date">

                                                        <?php echo @(string)$resultHistory['time']?>

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    <?php }?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>