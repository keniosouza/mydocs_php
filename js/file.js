/** Grupo de variáveis que guardar os dados dos campos do arquivo */
const files = new Object();
files.base64 = [];
files.name = [];

/** Controle de requisição */
let requests = 0;

/** Preparo o arquivo para envio */
function prepareUploadFile(origin) {

    /** Limpo os dados anteriores */
    files.base64 = [];

    /** Preparo o envio de múltiplos arquivos */
    for (let i = 0; i < $(origin)[0].files.length; i++) {

        /** Instâncimento de objeto para ler o conteúdo do arquivo */
        let fileReader = new FileReader();

        /** Defino o nome do arquivo */
        files.name.push(btoa(Math.random() * 10000) + '.' + $(origin)[0].files[i].name.split('.').pop().toLowerCase());

        /** Leio o conteúdo do arquivo **/
        fileReader.readAsDataURL($(origin)[0].files[i]);

        /** Trasnformar o arquivo em base64 */
        fileReader.onload = (e) => {

            /** Guardo o conteúdo da imagem */
            files.base64.push(e.target.result.split(',')[1]);

            /** Obtenho o elemento para listar as imagems */
            let element = document.getElementById('filesList');

            /** Crio o botão de remoção de imagem */
            const button = document.createElement('button');
            /** Adição de classes */
            button.classList.add('btn');
            button.classList.add('btn-danger');
            button.classList.add('w-100');
            button.classList.add('mt-2');
            /** Adição de atributo - ID */
            button.setAttribute('id', 'btn_' + i);
            button.setAttribute('onclick', `removeFile('${i}')`);
            button.setAttribute('type', `button`);
            /** Legenda do botão */
            button.innerHTML = 'Remover';

            /** Crio a div que guardará a imagem */
            const div = document.createElement('form');
            /** Adição de classes */
            div.classList.add('col-md-3');
            div.classList.add('mb-3');
            /** Adição de atributo - ID */
            div.setAttribute('id', 'FileForm' + i);

            /** Crio a tag de imagem */
            const img = document.createElement('img');
            /** Atribuo o caminho da imagem */
            img.src = "data:image/png;base64," + e.target.result.split(',')[1];
            /** Adição de classes */
            img.classList.add('img-fluid');
            img.classList.add('rounded');
            img.classList.add('shadow-sm');

            /** Crio a tag de imagem */
            const inputPosition = document.createElement('input');
            /** Adição de classes */
            inputPosition.classList.add('form-control');
            inputPosition.classList.add('mt-3');
            inputPosition.type = 'number';
            inputPosition.name = 'position';
            inputPosition.placeholder = 'Posição';
            inputPosition.value = i;

            /** Crio a tag de imagem */
            const inputDescription = document.createElement('input');
            /** Adição de classes */
            inputDescription.classList.add('form-control');
            inputDescription.classList.add('mt-3');
            inputDescription.type = 'text';
            inputDescription.name = 'description';
            inputDescription.placeholder = 'Descrição';
            inputDescription.value = document.getElementById('description_file').value;

            /** Preencho a div com a imagem */
            div.appendChild(img);
            div.appendChild(inputDescription);
            div.appendChild(inputPosition);
            div.appendChild(button);

            /** Preencho o elemento selecionado com a div criada */
            element.appendChild(div);

        };

    }

}

/** Função para remoção de imagem */
function removeFile(id){

    /** Busco o elemento pelo id */
    let div = document.getElementById('FileForm' + id);

    /** Remoção do elemento */
    div.remove();

    /** Removo o item da array de envio */
    files.base64.splice(id, 1);

}

/** Preparo a requisição para envio */
function prepareForm(form) {

    /** Bloqueia a tela */
    blockPage(true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true);

    /** Envio as requisições de acordo com o tamanho da array **/
    for (let i = 0; i < files.base64.length; i++) {

        /** Incremento */
        requests++;

        /** Guardo os valores dos campos do formulário */
        let data = serializeForm(form);

        /** Adiciono o nome do arquivo */
        data += '&name=' + files.name[i];

        /** Adiciono os dados particulares da imagem */
        data += '&' + serializeForm('FileForm' + i);

        /** Adiciono o conteúdo do arquivo */
        data += '&base64=' + files.base64[i];

        /*** Envio do arquivo */
        sendFile(data, i)

    }

}

/** Envio da requisição */
function sendFile(form, indice) {

    /** Url para envio */
    fetch('router.php', setHeader(form))

        /** Fetch do objeto */
        .then(response => response.json())

        /** Dados definitivos */
        .then((response) => {

            /** Crio a div que guardará a imagem */
            let alert = document.createElement('div');

            /** Defino o ID */
            alert.setAttribute('id', 'AlertFileForm' + indice);

            /** Verifico o código da resposta */
            switch (parseInt(response.code)) {

                /** Erro */
                case 0:

                    /** Adição de classes */
                    alert.classList.add('text-center');
                    alert.classList.add('mt-3');

                    /** Adição de texto */
                    alert.innerHTML = response.data;

                    /** Preencho o alvo desejado */
                    document.getElementById('FileForm' + indice).appendChild(alert);
                    break;

                /** Essa resposta provisória indica que tudo ocorreu bem até agora e que o cliente deve continuar com a requisição ou ignorar se já concluiu o que gostaria. */
                case 200:

                    /** Removo o botão de excluir imagem */
                    document.getElementById('btn_' + indice).remove();

                    /** Adição de classes */
                    alert.classList.add('text-center');
                    alert.classList.add('mt-3');

                    /** Adição de texto */
                    alert.innerHTML = response.data;

                    /** Preencho o alvo desejado */
                    document.getElementById('FileForm' + indice).appendChild(alert);
                    break;

                default :

                    /** Trato a resposta separadamente para cada aplicação */
                    checkResponse(response);
                    break;

            }

        })

        /** Erros da requisição */
        .catch(error => {

            /** Delay de execução */
            window.setTimeout(() => {

                /** Remoção de Modal Anterior */
                modalConstruct(false);

                /** Notificação de erro */
                //modalConstruct(true, 'Atenção', error.json, 'lg', null, null, 'error', null, null);

            }, 1000);

        })

        .finally(() => {
            
            /** Decremento */
            requests--;

            /** Verifico se devo remover o bloqueio de tela */
            if(requests === 0)
            {

                /** Remoção do bloqueio */
                blockPage(false);

            }

          });

}