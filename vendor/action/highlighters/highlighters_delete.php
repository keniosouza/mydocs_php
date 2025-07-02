<?php

/** Importação de classes */

use vendor\model\Highlighters;
use vendor\controller\highlighters\HighlightersValidate;

/** Controle de mensagens */
$message = array();

/** Instânciamento de classes */
$Highlighters = new Highlighters();
$HighlightersValidate = new HighlightersValidate();

/** Parâmetros de entrada */
$HighlightersValidate->setHighlighterId(@(int)filter_input(INPUT_POST, 'HIGHLIGHTER_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */

if (!empty($HighlightersValidate->getErrors())) {

    new InvalidArgumentException($HighlightersValidate->getErrors());

} else {

    /** Verifico se o usuário foi localizado */
    if ($Highlighters->Delete($HighlightersValidate->getHighlighterId())) {

        /** Adição de elementos na array */
        array_push($message, array('sucesso', ));

        /** Result **/
        $result = [

            'code' => 200,
            'title' =>'Sucesso',
            'data' =>'Produto removido com sucesso',
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
