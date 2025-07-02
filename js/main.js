let ckeditor = null;

function loadCKEditor() {

    /** Listo todos os editores de texto */
    $('.editor').each(function () {

        /** Pego o nome do campo */
        let id = $(this).attr('id');

        DecoupledDocumentEditor

            .create(document.querySelector('#' + id), {

                licenseKey: '',

            })

            .then(editor => {

                ckeditor = editor;
                window.editor = editor;
                // Set a custom container for the toolbar.
                document.querySelector('#' + id + '_toolbar').appendChild(editor.ui.view.toolbar.element);
                document.querySelector('.ck-toolbar').classList.add('ck-reset_all');

            })

    })

}

function loadLiveSearch() {

    /** Monitoro o campo de busca */
    $('#search').on('keyup', function () {

        /** Trato os valores de entrada */
        var value = $(this).val();
        var patt = new RegExp(value, "i");

        $('#search_table').find('tr').each(function () {

            if (!($(this).find('td').text().search(patt) >= 0)) {

                $(this).not('#search_table_head').hide();

            }

            if (($(this).find('td').text().search(patt) >= 0)) {

                $(this).show();

            }

        });

    });

}

function loadMask() {

    $(document).ready(function () {
        $('.date').mask('00/00/0000');
        $('.time').mask('00:00:00');
        $('.date_time').mask('00/00/0000 00:00:00');
        $('.cep').mask('00000-000');
        $('.phone').mask('0000-0000');
        $('.phone_with_ddd').mask('(00) 0000-0000');
        $('.phone_with_9').mask('(00) 0.0000-0000');
        $('.phone_us').mask('(000) 000-0000');
        $('.mixed').mask('AAA 000-S0S');
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});        
        $('.money').mask('000.000.000.000,00',{reverse: true});
        $('.money2').mask("#.##0,00", {reverse: true});
        $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
            translation: {
                'Z': {
                    pattern: /[0-9]/, optional: true
                }
            }
        });
        $('.ip_address').mask('099.099.099.099');
        $('.percent').mask('##0,00%', {reverse: true});
        $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
        $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
        $('.fallback').mask("00r00r0000", {
            translation: {
                'r': {
                    pattern: /[\/]/,
                    fallback: '/'
                },
                placeholder: "__/__/____"
            }
        });
        $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});

    });

}