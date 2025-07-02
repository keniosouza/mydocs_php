<?php

/** Importação de classes */
use vendor\model\Highlighters;
use vendor\controller\highlighters\HighlightersValidate;

/** Instânciamento de classes */
$Highlighters = new Highlighters();
$HighlightersValidate = new HighlightersValidate();

/** Parâmetros de entrada */
$HighlightersValidate->setHighlighterId(@(int)filter_input(INPUT_POST, 'highlighter_id', FILTER_SANITIZE_SPECIAL_CHARS));
$HighlightersValidate->setName(@(string)filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
$HighlightersValidate->setGroup(@(string)filter_input(INPUT_POST, 'group', FILTER_SANITIZE_SPECIAL_CHARS));

/** Defino os campos da marcação */
$HighlightersValidate->setTable(@(string)filter_input(INPUT_POST, 'table', FILTER_SANITIZE_SPECIAL_CHARS));
$HighlightersValidate->setColumn(@(string)filter_input(INPUT_POST, 'column', FILTER_SANITIZE_SPECIAL_CHARS));
$HighlightersValidate->setPrimaryKey(@(string)filter_input(INPUT_POST, 'primary_key', FILTER_SANITIZE_SPECIAL_CHARS));

/** Defino as preferencias da marcação */
$HighlightersValidate->setMask(@(string)filter_input(INPUT_POST, 'mask', FILTER_SANITIZE_SPECIAL_CHARS));
$HighlightersValidate->setUppercase(@(bool)filter_input(INPUT_POST, 'uppercase', FILTER_SANITIZE_SPECIAL_CHARS));
$HighlightersValidate->setLowerCase(@(bool)filter_input(INPUT_POST, 'lowercase', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if(!empty($HighlightersValidate->getErrors())){ 

    /** Preparo o formulario para retorno **/
    new InvalidArgumentException($HighlightersValidate->getErrors());
    
} else {

    /** Busco o registro informado */
    $resultHighlighters = $Highlighters->Get($HighlightersValidate->getHighlighterId());

    /** Defino o histórico do registro */
    $historyData[0]['title'] = 'Cadastro';
    $historyData[0]['description'] = 'Texto Vinculado a Empresa';
    $historyData[0]['date'] = date('d-m-Y');
    $historyData[0]['time'] = date('H:i:s');
    $historyData[0]['class'] = 'badge-primary';

    /** Converto para JSON */
    $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

    /** Campos da marcação */
    $highlighterJSON['table'] = $HighlightersValidate->getTable();
    $highlighterJSON['column'] = $HighlightersValidate->getColumn();
    $highlighterJSON['primary_key'] = $HighlightersValidate->getPrimaryKey();

    /** Preferências da Marcação */
    $PreferencesJSON['mask']['format'] = $HighlightersValidate->getMask();
    $PreferencesJSON['text']['lowercase'] = $HighlightersValidate->getLowercase();
    $PreferencesJSON['text']['uppercase'] = $HighlightersValidate->getUppercase();

    /** Converto para JSON */
    $HighlightersValidate->setText(json_encode($highlighterJSON, JSON_PRETTY_PRINT));
    $HighlightersValidate->setPreferences(json_encode($PreferencesJSON));

    /** Verifico se o usuário foi localizado */
    if ($Highlighters->Save($HighlightersValidate->getHighlighterId(), $HighlightersValidate->getName(), $HighlightersValidate->getText(), $HighlightersValidate->getGroup(), json_encode($HighlightersValidate->getHistory(), JSON_PRETTY_PRINT), $HighlightersValidate->getPreferences())) {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Marcação cadastrada com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_DATAGRID'

        ];

    } else {

        new InvalidArgumentException($HighlightersValidate->getErrors());

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
