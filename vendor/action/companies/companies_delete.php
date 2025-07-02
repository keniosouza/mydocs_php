<?php

/** Importação de classes */
use vendor\model\Companies;
use vendor\controller\companies\CompaniesValidate;

/** Instânciamento de classes */
$companies = new Companies();
$companiesValidate = new CompaniesValidate();

try
{

    /** Parâmetros de entrada */
    $companiesValidate->setCompanyId(@(int)$_POST['company_id']);

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($companiesValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $companiesValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco o registro */
        $resultCompanies = $companies->get($companiesValidate->getCompanyId());

        /** Verifico se o registro foi localizdo */
        if ($resultCompanies->company_id > 0)
        {

            /** Verifico se o usuário foi localizado */
            if ($companies->delete($resultCompanies->company_id))
            {

                /** Adição de elementos na array */
                array_push($message, array('sucesso', 'País removido com sucesso'));

                /** Result **/
                $result = [

                    'cod' => 0,
                    'title' => 'Sucesso',
                    'message' => $message,
                    'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DATAGRID'

                ];

            }
            else
            {

                /** Adição de elementos na array */
                array_push($message, array('erro', 'Não foi possivel remover o registro'));

                /** Result **/
                $result = [

                    'cod' => 1,
                    'title' => 'Atenção',
                    'message' => $message,

                ];

            }

        }
        else
        {

            /** Adição de elementos na array */
            array_push($message, array('erro', 'Não foi possivel localizar o registro'));

            /** Result **/
            $result = [

                'cod' => 1,
                'title' => 'Atenção',
                'message' => $message,

            ];

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
catch (Exception $exception)
{

    /** Controle de mensagens */
    $message = array();

    /** Adição de elementos na array */
    array_push($message, array('erro', '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile()));
    array_push($message, array('erro', '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage()));

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 1,
        'message' => $message,
        'title' => 'Erro Interno',
        'type' => 'exception',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}