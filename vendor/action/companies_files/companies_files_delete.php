<?php

/** Importação de classes */
use vendor\model\CompaniesFiles;
use vendor\controller\companies_file\CompaniesFilesValidate;

/** Instânciamento de classes */
$CompaniesFiles = new CompaniesFiles();
$CompaniesFilesValidate = new CompaniesFilesValidate();

try
{

    /** Parâmetros de entrada */
    $CompaniesFilesValidate->setCompanyFileId(@(int)filter_input(INPUT_POST, 'company_file_id', FILTER_SANITIZE_SPECIAL_CHARS));

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($CompaniesFilesValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $CompaniesFilesValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco o registro desejado */
        $resultCompanies = $CompaniesFiles->Get($CompaniesFilesValidate->getCompanyFileId());

        /** Verifico se o registro existe */
        if (@(int)$resultCompanies->company_file_id)
        {

            /** Verifico se o usuário foi localizado */
            if ($CompaniesFiles->Delete($CompaniesFilesValidate->getCompanyFileId()))
            {

                /** Adição de elementos na array */
                array_push($message, array('sucesso', 'País removido com sucesso'));

                /** Result **/
                $result = [

                    'cod' => 0,
                    'title' => 'Sucesso',
                    'message' => $message,
                    'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=' . $resultCompanies->company_id

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