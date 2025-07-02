<?php

/** Importação de classes */
use vendor\model\Cities;
use vendor\controller\cities\CitiesValidate;

/** Instânciamento de classes */
$Cities = new Cities();
$CitiesValidate = new CitiesValidate();

/** Parâmetros de entrada */
$CitiesValidate->setStateId(@(int)filter_input(INPUT_POST, 'CITY_ID', FILTER_SANITIZE_STRING));

$message = array();

/** Verifico a existência de erros */
if (count($CitiesValidate->getErrors()) > 0) {

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 1,
        'title' => 'Atenção',
        'message' => $CitiesValidate->getErrors(),

    ];
    
} else {

    /** Guardo o resultado */
    $resultCities = $Cities->all($CitiesValidate->getStateId());

    /** Listo todos os registros */
    foreach ($resultCities as $key => $result) {

        /** Codifico o nome da pessoa */
        $resultCities[$key]->name = $result->name;
    }

    /** Verifico se o usuário foi localizado */
    if (count($resultCities) > 0) {

        /** Adição de elementos na array */
        array_push($message, array('sucesso', 'Produto removido com sucesso'));

        /** Result **/
        $result = [

            'code' => 0,
            'title' => 'Sucesso',
            'data' => json_encode($resultCities),

        ];
    } else {

        /** Adição de elementos na array */
        array_push($message, array('erro', 'Não foi possivel localizar os registros'));

        /** Result **/
        $result = [

            'code' => 1,
            'title' => 'Atenção',
            'message' => $message,

        ];
    }
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
