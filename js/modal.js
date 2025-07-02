var modalId = null;

class Modal {

    /** Método construtor */
    constructor(create, title, data, size, color_modal, color_border, type, procedure, time, document) {

        /** Parâmetros da classe */
        this._create = create;
        this._title = title;
        this._data = data;
        this._size = size;
        this._color_modal = color_modal;
        this._color_border = color_border;
        this._type = type;
        this._procedure = procedure;
        this._time = time;
        this._document = document;

        /** Verificação de operção */
        if (this._create) {

            /** Criação do modal */
            this.create();

        }
        else {

            /** Remoção do modal */
            this.destroy();

        }

    }

    /** Defino a cor do Modal */
    setColorModal(color_modal) {

        /** Verificação de informação */
        switch (color_modal) {

            /** Defino um valor aleatório */
            case 'random':

                /** Temas disponiveis */
                let a = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];

                /** Embaralha os temas */
                let color_rand = shuffle(a);

                /** Pega o primeiro item embaralhado */
                color_modal = 'bg-' + color_rand[0];

                break;

            /** Defino um valor proprio */
            case color_modal !== null:

                /** Defino o valor do Modal */
                color_modal = 'bg-' + color_modal;

                break;

            /** Defino um valor padrão */
            default:

                /** Defino como vázio */
                color_modal = 'bg-light';

                break;

        }

        /** Retorno da informação */
        return color_modal;

    }

    setColorBorder(color_border) {

        /** Verificação de informação */
        switch (color_border) {

            /** Defino um valor aleatório */
            case 'random':

                /** Temas disponiveis */
                let a = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];

                /** Embaralha os temas */
                let color_rand = shuffle(a);

                /** Pega o primeiro item embaralhado */
                color_border = 'border-' + color_rand[0];

                break;

            /** Defino um valor proprio */
            case color_border !== null:

                /** Defino o valor do Modal */
                color_border = 'border-' + color_border;

                break;

            /** Defino um valor padrão */
            default:

                /** Defino como vázio */
                color_border = 'border-light';

                break;

        }

        /** Retorno da informação */
        return color_border;

    }

    setType(type) {

        /** Verifico se esta preenchido */
        if (type !== null) {

            /** Defino o valor do Modal */
            type = 'image/default/' + type + '.png';

        }
        else {

            /** Defino como vázio */
            type = null;

        }

        return type;

    }

    /** Defino o tamanho do modal */
    setSize(size) {

        /** Verifico se esta preenchido */
        if (size !== null) {

            /** Defino o valor do Modal */
            size = 'modal-' + size;

        }
        else {

            /** Defino como vázio */
            size = null;

        }

        /** Retorno da informação */
        return size;

    }

    /** Criação do Modal */
    create() {

        /** Montagem do ID */
        modalId = 'modal_' + Math.floor(Math.random() * 100) + 1;

        /** Montagem da estrutura HTML */
        this._html = `<div class="modal fade" id="${modalId}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">`;
        this._html += `  <div class="modal-dialog modal-dialog-scrollable ${this.setSize(this._size)}">`;
        this._html += `    <div class="modal-content ${this.setColorModal(this._color_modal)} ${this.setColorBorder(this._color_border)}">`;
        this._html += `      <div class="modal-header">`;
        this._html += `        ${this._title != '' ? '<h4 class="modal-title text-center"><b>' + this._title + '</b></h4>' : ''} <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>`;
        this._html += `      </div>`;
        this._html += `      <div class="modal-body text-break">`;

        /** Verifico se é exibição de documento */
        if(this._document)
        {

            /** Monto a imagem do Modal */
            this._html += `                     <div class="card">`;
            this._html += `                         <div class="card-body">`;
            this._html += '                             <iframe src="'+this._data+'" title="Iframe Example" class="w-100" height=500px></iframe>';
            this._html += `                         </div>`;
            this._html += `                     </div>`;

        }
        else
        {

            /** Verifico se existe o TIPO */
            if (this.setType(this._type) !== null) {

                /** Monto a imagem do Modal */
                this._html += `                <div class="text-center mb-2">`;
                this._html += `                    <img class="img-fluid" src="${this.setType(this._type)}" width="60px" />`;
                this._html += `                </div>`;

            }

            /** Verifico se devo realizar o Serialize */
            if (this._data.includes('modal="true"')) {

                /** Monto formulário */
                this._html += `                    <div class="mb-3">${this._data}</div>`;

            }
            else {

                /** Monto uma mensagem simples */
                this._html += `                    <p class="mt-2 text-break text-center">${this._data}</p>`;

            }

        }

        this._html += `      </div>`;

        /** Verifico se tem Tarefa a ser executada */
        if (this._procedure) {

            /** Botões de operações */
            this._html += `                <div class="modal-footer flex-column border-top-0">`;
            this._html += `                    <button type="button" class="btn btn-lg btn-outline-danger w-100 mx-0" data-bs-dismiss="modal">Fechar</button>`;
            this._html += `                    <button type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" data-bs-dismiss="modal" onclick="${this._procedure}" id="btnModalPage">Continuar</button>`;
            this._html += `                </div>`;

        }

        this._html += `    </div>`;
        this._html += `  </div>`;
        this._html += `</div>`;

        /** Limpo div desejada **/
        $('#wrapper-modal').empty();

        /** Preenchimento da div desejada **/
        $('#wrapper-modal').html(this._html);

        /** Exibição do Modal */
        $('#' + modalId).modal('show');

        /** Verifica se o tempo de execução foi definido */
        if (parseInt(this._time) > 0) {

            /** Defino um tempo de execução */
            window.setTimeout(function () {

                /** Remoção do MODAL */
                modalConstruct(false);

            }, this._time);

        }

    }

    /** Remoção do Modal */
    destroy() {

        /** Remoção do Modal */
        $('#' + modalId).modal('hide');
        // $('div').remove('.modal-backdrop');

    }

}

/** Consturção do Modal Desejado */
function modalConstruct(create, title, data, size, color_modal, color_border, type, procedure, time, document) {

    /** Instânciamento do Modal */
    new Modal(create, title, data, size, color_modal, color_border, type, procedure, time, document);

}