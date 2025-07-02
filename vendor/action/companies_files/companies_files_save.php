<?php

/** Importação de classes */
use \vendor\controller\main\Main;
use \vendor\model\Companies;
use \vendor\controller\file\File;
use \vendor\controller\file\FileValidate;
use \vendor\model\CompaniesFiles;
use \vendor\controller\companies_file\CompaniesFilesValidate;

/** Instânciamento de classes */
$Main = new Main();
$Companies = new Companies();
$File = new File();
$FileValidate = new FileValidate();
$CompaniesFiles = new CompaniesFiles();
$CompaniesFilesValidate = new CompaniesFilesValidate();

/** Controle de mensagens */
$message = null;
$result = array();

try
{

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada Arquivo */
    $FileValidate->setName(@(string)$_POST['name']);
    $FileValidate->setBase64(@(string)$_POST['base64']);
    $FileValidate->setExtension(@(string)$_POST['extension']);
    $FileValidate->setPath(@(string)'document');

    /** Parâmetros de entrada Contents */
    $CompaniesFilesValidate->setCompanyFileId(@(int)$_POST['company_file_id']);
    $CompaniesFilesValidate->setCompanyId(@(string)$_POST['company_id']);
    $CompaniesFilesValidate->setName(@(string)$_POST['name']);
    $CompaniesFilesValidate->setPath(@(string)'document');
    $CompaniesFilesValidate->setExtension(@(string)$_POST['extension']);

    /** Verifico a existência de erros */
    if (!empty($FileValidate->getErrors()))
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 0,
            'title' => 'Atenção',
            'message' => $FileValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco o registro */
        $resultCompanies = $Companies->get($CompaniesFilesValidate->getCompanyId());

        /** Verifico se o registro foi localizado */
        if (@(int)$resultCompanies->company_id > 0)
        {

            /** Gero o arquivo */
            $File->Generate($FileValidate->getPath(), $FileValidate->getFullName(), $FileValidate->getBase64());

            /** Verifico se o caminho existe */
            if (is_file($FileValidate->getFullPath()))
            {

                /** Defino o histórico do registro */
                $historyData[0]['title'] = 'Cadastro';
                $historyData[0]['description'] = 'Texto Vinculado ao Usuário';
                $historyData[0]['date'] = date('d-m-Y');
                $historyData[0]['time'] = date('H:i:s');
                $historyData[0]['class'] = 'badge-primary';
                $historyData[0]['user'] = $_SESSION['USER_NAME'];

                $CompaniesFilesValidate->setHistory($historyData);

                /** Salvo o registro do arquivo */
                if ($CompaniesFiles->Save($CompaniesFilesValidate->getCompanyFileId(), $CompaniesFilesValidate->getCompanyId(), $CompaniesFilesValidate->getName(), $FileValidate->getFullPath(), $FileValidate->getExtension(), json_encode($CompaniesFilesValidate->getHistory(), JSON_PRETTY_PRINT)))
                {

                    /** Adição de elementos na array */
                    array_push($message, array('sucesso', 'Arquivo vinculado com sucesso'));

                    /** Result **/
                    $result = [

                        'cod' => 0,
                        'title' => 'Sucesso',
                        'message' => $message,
                        'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=' . $CompaniesFilesValidate->getCompanyId()

                    ];

                }
                else
                {

                    /** Adição de elementos na array */
                    array_push($message, array('erro', 'Não foi possivel vincular o arquivo'));

                    /** Result **/
                    $result = [

                        'cod' => 1,
                        'title' => 'Erro',
                        'message' => $message,

                    ];

                }

            }
            else
            {

                /** Adição de elementos na array */
                array_push($message, array('erro', 'Não foi possivel localizar o arquivo'));

                /** Result **/
                $result = [

                    'cod' => 1,
                    'title' => 'Erro',
                    'message' => $message,

                ];

            }

        }
        else
        {

            /** Adição de elementos na array */
            array_push($message, array('sucesso', 'Parte inserida com sucesso'));

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Erro',
                'message' => $message,

            ];

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

} catch (Exception $exception) {

    /** Controle de mensagens */
    $message = '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile() . '</br>';
    $message .= '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage();

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 500,
        'message' => $message,
        'title' => 'Erro Interno',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}