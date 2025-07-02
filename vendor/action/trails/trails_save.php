<?php

/** Importação de classes */
use vendor\model\Trails;
use vendor\controller\trails\TrailsValidate;

/** Instânciamento de classes */
$Trails = new Trails();
$TrailsValidate = new TrailsValidate();

/** Parâmetros de entrada */
$TrailsValidate->setTrailId(@(int)filter_input(INPUT_POST, 'trail_id', FILTER_SANITIZE_SPECIAL_CHARS));
$TrailsValidate->setUserId(@$_SESSION['USER_ID']);
$TrailsValidate->setText(json_encode($text, JSON_PRETTY_PRINT));
$TrailsValidate->setDateRegister(date('Y-m-d h:s:i'));

/** Salvo os dados */
$Trails->Save($TrailsValidate->getTrailId(), $TrailsValidate->getUserId(), $TrailsValidate->getText(), $TrailsValidate->getDateRegister());
