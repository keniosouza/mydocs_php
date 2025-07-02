/** Pega a url atual **/
let url = null;

/** Carrego o arquivo de configurações */
$.getJSON("config.json", function (data) {

    /** Carrega as configurações da aplicação */
    url = data['application']['main']['url'];

});

/** Função para definir o cabeçalho da requisição */
function setHeader(data) {

    /** Defino o cabeçalho padrão de requisição */
    let header = {

        /** Formato de envio */
        method: 'post',

        /** Modo de envio */
        mode: 'cors',

        /** Defino o cabeçalho da requisição */
        headers: {

            /** Converto a string para parâmetros de url */
            "Content-Type": "application/x-www-form-urlencoded",

            /** Envio a contagem de caracteres */
            "Content-Length": data.length,

            /** Defino o a prioridade */
            "X-Custom-Header": "ProcessThisImmediately"

        },

        /** Definição do cache */
        cache: 'no-store',

        /** Dados para envio */
        body: data,

    };

    /** Retorno da informação */
    return header;

}

/** Listagem de todos os campos */
function serializeForm(form) {

    /** Obtenho todos os dados do formulario */
    let tempForm = document.getElementById(form);

    /** Obtenho apenas os campos do formulário */
    let tempData = new FormData(tempForm);

    /** Transform os campos do formulário em parâmetros de URL */
    tempData = new URLSearchParams(tempData).toString();

    /** Verifica se o editor está ativo */
    if($('.editor').length > 0){

        /** Obtenho os dados do editor */
        tempData = tempData + '&' + $('.editor').attr('id') + '=' + encodeURIComponent(ckeditor.getData());

    }

    /** Retorno da informação */
    return tempData;

}

/** Função para remover o html existente e preenchimento de um novo */
function putHtml(target, data) {

    // /** Busco a DIV desejada */
    // var html = document.getElementById(target);
    //
    // /** Realizo a limpeza da DIV desejada */
    // html.innerText = null;

    // /** Crio a DIV que guardará o novo html */
    // var html = document.createElement('div');
    //
    // /** Defino o novo html */
    // html.innerHTML = data;
    //
    // /** Insiro o novo html em um id desejado */
    // document.getElementById(target).appendChild(html);

    /** Preenchimento da div desejada **/
    $('#' + target).html(data);

}

/** Função para executar mudanças de páginas */
function sendRequest(data, target_data, create, info, sec, target, message, color, type, size, message_spinner) {

    /** Legendas
     * 0 -> erro Capturado
     * 100 -> Redirecionamento de Página
     * 600 -> Registro deletado
     * 202 -> Login
     * 201 -> Html em Modal
     * 403 -> Forbidden -> Usuário não autenticado/sem permissão
     * 733  -> Pdf -> Visualização do PDF em popup
     */

    /** Bloqueia a tela */
    blockPage(create, info, sec, target, message, color, type, size, message_spinner);

    /** Verifico se devo realizar o Serialize */
    if (data !== '' && !data.match(/=/)) {

        /** guardo o serialize */
        data = serializeForm(data)
        
    }

    /** Url para envio */
    fetch('router.php', setHeader(data))

        /** Fetch do objeto */
        .then(response => response.json())

        /** Dados definitivos */
        .then((response) => {

            /** Delay de execução */
            window.setTimeout(() => {

                /** remoção do bloqueio de tela */
                blockPage(false);

            }, 500);

            /** Verifico o código da resposta */
            switch (parseInt(response.code)) {

                /** Erro */
                case 0:

                    /** Verifica se o target foi informado para adicionar a informação retornada */
                    if (target) {

                        /** Preencho o dados informados */
                        putHtml(target, response.data);

                    } else {

                        /** Remoção de Modal Anterior */
                        //modalConstruct(false);

                        /** Carrego o conteúdo **/
                        modalConstruct(true, response.title, response.data, response.size, response.color_modal, response.color_border, response.type, response.procedure, response.time);

                    }
                    break;

                /** Essa resposta provisória indica que tudo ocorreu bem até agora e que o cliente deve continuar com a requisição ou ignorar se já concluiu o que gostaria. */
                case 100:

                    /** Verifica se o target foi informado para adicionar a informação retornada */
                    if (target) {

                        /** Preencho o dados informados */
                        putHtml(target, response.data);
                        
                    }else{

                        /** Carrego o conteúdo **/
                        //modalConstruct(false);

                        /** Preenchimento do html */
                        putHtml('wrapper', response.data);

                    }
                    
                    break;

                /** Estas requisição foi bem sucedida. O significado do sucesso varia de acordo com o método HTTP: */
                case 200:

                    /** Verifica se o target foi informado para adicionar a informação retornada */
                    if (target && !response.redirect) {

                        /** Preencho o dados informados */
                        putHtml(target, response.data);

                    }
                    else if (response.target && response.redirect) {

                        /** Carrego o conteúdo **/
                        modalConstruct(false);

                        /** Preencho o dados informados */
                        sendRequest(response.redirect, '', true, '', '', response.target, response.data, 'blue', 'circle', 'sm', true)

                        /** Preencho o dados informados */
                        putHtml(target, response.data);

                    }
                    else {

                        /** Verifico se devo realizar o redirecionamento de página */
                        if (response.redirect) {

                            /** Carrego o conteúdo **/
                            modalConstruct(false);

                            /** Redirecionamento da página */
                            sendRequest(response.redirect);

                        }
                        /** Verifico se existe mensagem para ser exibida */
                        else if (response.data) {

                            /** Carrego o conteúdo **/
                            //modalConstruct(false);

                            /** Carrego o conteúdo **/
                            modalConstruct(true, response.title, response.data, response.size, response.color_modal, response.color_border, response.type, response.procedure, response.time);

                        }
                        else {

                            /** Carrego o conteúdo **/
                            //modalConstruct(false);

                            /** Notificação de erro */
                            modalConstruct(true, 'Atenção', 'Mensagem padrão: Requisição concluída com sucesso!', 'sm', null, null, 'info', null, null);

                        }

                    }
                    break;

                /** Code 201 created/popup/form */
                case 201:

                    /** Remoção de Modal Anterior */
                    modalConstruct(false);

                    /** Carrego o conteúdo **/
                    modalConstruct(true, response.title, response.data, response.size, response.color_modal, response.color_border, response.type, response.procedure, response.time);
                    break;

                /** Redirecionamento de URL */
                case 202:

                    /** Verifico se é uma nova sessão */
                    if (response.new_session)
                    {

                        /** Remoção de Modal Anterior */
                        //modalConstruct(false);

                    }
                    else
                    {

                        /** Redirecionamento da página */
                        location.href = url + response.url;

                    }
                    break;

                /** Usuário Inativo */
                case 403:

                    /** Verifico se é uma nova sessão */
                    if (response.block)
                    {

                        /** Carrego o Login de Inatividade */
                        sendRequest('APPLICATION=main&FOLDER=view&TABLE=g_usuario&ACTION=g_usuario_login_block');

                    }
                    else
                    {

                        /** Reinicio a requisição */
                        verifyTimeSession(response.session_time);

                    }
                    break;

                /** Exibição de PDF em */
                case 733:

                    /** Remoção de Modal Anterior */
                    //modalConstruct(false);

                    /** Carrego o conteúdo **/
                    modalConstruct(true, response.title, response.data, response.size, response.color_modal, response.color_border, response.type, response.procedure, response.time, response.document);
                    break;

                default :

                    /** Trato a resposta separadamente para cada aplicação */
                    checkResponse(response);
                    break;

            }

            /** Carrega as mascaras necessários de fomrulários */
            loadMask();

        })

        /** Erros da requisição */
        .catch(error => {

            /** Delay de execução */
            window.setTimeout(() => {

                /** remoção do bloqueio de tela */
                blockPage(false);

                /** Remoção de Modal Anterior */
                //modalConstruct(false);

                /** Notificação de erro */
                modalConstruct(true, 'Atenção', error.json, 'lg', null, null, 'error', null, null);

            }, 1000);

        })

        /** Encerramento da requisição */
        .finally(() => {

            /** Delay de execução */
            window.setTimeout(() => {

                /** Habilito os botões novamente */
                $('.btn-block').attr('disabled', false);

            }, 1000);

        })

}