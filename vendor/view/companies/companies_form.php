<?php

/** Importação de classes */

use \vendor\model\States;
use \vendor\model\Cities;
use \vendor\model\Situations;
use \vendor\model\Companies;
use \vendor\controller\companies\CompaniesValidate;

/** Instânciamento de classes */
$States = new States();
$Cities = new Cities();
$Situations = new Situations();
$companies = new Companies();
$companiesValidate = new CompaniesValidate();

/** Tratamento dos dados de entrada */
$companiesValidate->setCompanyId(@(int)filter_input(INPUT_POST, 'COMPANY_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Busca de registro */
$resultCompanies = $companies->get($companiesValidate->getCompanyId());

?>

<div class="row">

    <div class="col-md-6">

        <h4 class="card-title">

            <strong>

                <i class="fas fa-building me-1"></i>

                Empresas

            </strong>

            <i class="fas fa-chevron-right regular"></i> Edição

        </h4>


    </div>

    <div class="col-md-6 text-end">

        <a type="button" class="btn btn-primary btn-sm" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-chevron-left me-1"></i>Voltar

        </a>

    </div>

    <div class="col-md-12">

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item " role="presentation">

                <button class="nav-link active" id="values-tab" data-bs-toggle="tab" data-bs-target="#values-tab-pane" type="button" role="tab" aria-controls="values-tab-pane" aria-selected="false">Principal</button>

            </li>

            <li class="nav-item" role="presentation">

                <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#products-tab-pane" type="button" role="tab" aria-controls="products-tab-pane" aria-selected="false">Complementar</button>

            </li>

        </ul>
    </div>

    <form role="form" id="CompaniesForm" class="card shadow-sm animate slideIn ">
        <div class="tab-content" id="myTabContent">

            <!-- Form 1 -->
            <div class="tab-pane fade active show" id="values-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="card-body">
                    <div class="row g-2">

                        <div class="border-bottom mb-2">

                            <i class="fas fa-info me-1"></i>Descrição da Empresa

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="cep">

                                    <b> CNPJ</b>

                                </label>

                                <input type="text" id="cnpj" class="form-control cnpj" name="cnpj" value="<?php echo @(string)$resultCompanies->cnpj ?>">

                            </div>

                        </div>

                        <!--Apelido-->
                        <div class="col-md-10">

                            <label for="nickname">

                                <b>Apelido</b>

                            </label>

                            <input id="nickname" type="text" class="form-control" name="nickname" value="<?php echo @(string)$resultCompanies->nickname ?>">

                        </div>


                        <!--Nome empresarial-->
                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="name_business">

                                    <b> Nome Empresarial</b>

                                </label>

                                <input id="name_business" type="text" class="form-control" name="name_business" value="<?php echo @(string)$resultCompanies->name_business ?>">

                            </div>

                        </div>

                        <!--Nome fantasia-->
                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="name_fantasy">

                                    <b> Nome Fantasia</b>

                                </label>

                                <input id="name_fantasy" type="text" class="form-control" name="name_fantasy" value="<?php echo @(string)$resultCompanies->name_fantasy ?>">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="responsible">

                                    <b>Responsável do Cartório</b>

                                </label>

                                <input type="text" id="responsible" class="form-control" name="responsible" value="<?php echo @(string)$resultCompanies->responsible ?>">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="responsible_office">

                                    <b> Cargo do Responsável.</b>

                                </label>

                                <input type="text" id="responsible_office" class="form-control" name="responsible_office" value="<?php echo @(string)$resultCompanies->responsible_office ?>">

                            </div>

                        </div>

                        <div class="border-bottom mb-2">

                            <i class="fas fa-info me-1"></i>Endereço

                        </div>
                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="cep">

                                    <b> CNS</b>

                                </label>

                                <input type="text" id="cns" class="form-control" name="cns" value="<?php echo @(string)$resultCompanies->cns ?>">

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="cep">

                                    <b> CEP</b>

                                </label>

                                <input type="text" id="cep" class="form-control cep" name="cep" value="<?php echo @(string)$resultCompanies->cep ?>">

                            </div>

                        </div>

                        <!--Estado-->
                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="state_id">

                                    <b> Estado</b>

                                </label>

                                <select name="state_id" id="state_id" class="form-select">

                                    <?php

                                    foreach ($States->all() as $keyResultStates => $resultStates) { ?>

                                        <option value="<?php echo $resultStates->state_id ?>" <?php echo @(int)$resultStates->state_id === @(int)$resultCompanies->state_id ? 'selected' : null ?>>

                                            <?php echo @(string)$resultStates->name ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                        <!--Cidade-->
                        <div class="col-md-5">

                            <div id="city_form">

                                <label for="city_id">

                                    <b>Cidade</b>

                                </label>

                                <div id="city_box">

                                    <select name="city_id" id="city_id" class="form-select"></select>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="complement">

                                    <b> Endereço</b>

                                </label>

                                <input type="text" id="complement" class="form-control" name="complement" value="<?php echo @(string)$resultCompanies->complement ?>">

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="district">

                                    <b> Comarca</b>

                                </label>

                                <input type="text" id="district" class="form-control" name="district" value="<?php echo @(string)$resultCompanies->district ?>">

                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <!-- Form 2-->
            <div class="tab-pane fade" id="products-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class="card-body">
                    <div class="row g-2">

                        <div class="border-bottom mb-2">

                            <i class="fas fa-info me-1"></i>Contrato

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="situation_id">

                                    <b> Status</b>

                                </label>

                                <select name="situation_id" id="situation_id" class="form-select">

                                    <?php
                                    foreach ($Situations->all() as $keyResultSituations => $resultSituations) { ?>

                                        <option value="<?php echo $resultSituations->situation_id ?>" <?php echo $resultSituations->situation_id === $resultCompanies->situation_id ? 'selected' : null ?>>

                                            <?php echo $resultSituations->name ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>


                        <div class="col-md">

                            <div class="form-group">

                                <label for="start_contract">

                                    <b> Inicio do Contrato </b>

                                </label>

                                <input type="date" id="start_contract" class="form-control" name="start_contract" value="<?php echo @(string)$resultCompanies->start_contract ?>">

                            </div>

                        </div>

                        <div class="col-md">

                            <div class="form-group">

                                <span for="value_monthly">

                                    <b> Valor da Mensalidade</b>

                                </span>

                                <input type="text" id="value_monthly" class="form-control money" name="value_monthly" value="<?php echo @(string)$resultCompanies->value_monthly ?>">

                            </div>

                        </div>

                        <div class="col-md">

                            <div class="form-group">

                                <label for="stations">

                                    <b> Qtd. Estações </b>

                                </label>

                                <input type="number" id="stations" class="form-control" name="stations" value="<?php echo @(int)$resultCompanies->stations ?>">

                            </div>

                        </div>

                        <div class="col-md">

                            <div class="form-group">

                                <label for="expiration_day">

                                    <b> Dia do Vencimento </b>

                                </label>

                                <input type="number" id="expiration_day" class="form-control" name="expiration_day" max="31" min="0" value="<?php echo @(int)$resultCompanies->expiration_day ?>">

                            </div>

                        </div>

                        <div class="col-md">

                            <div class="form-group">

                                <label for="first_payment">

                                    <b>Primeiro Vencimento</b>

                                </label>

                                <input type="date" id="first_payment" class="form-control" name="first_payment" value="<?php echo @(string)$resultCompanies->first_payment ?>">

                            </div>

                        </div>

                        <div class="border-bottom mb-2">

                            <i class="fas fa-info me-1"></i>Contatos

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="cep">

                                    <b> Celular</b>

                                </label>

                                <input type="text" id="cellphone" class="form-control phone_with_9" name="cellphone" value="<?php echo @(string)$resultCompanies->cellphone ?>">

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="cep">

                                    <b> Telefone Fixo</b>

                                </label>

                                <input type="text" id="telephone" class="form-control phone_with_ddd" name="telephone" value="<?php echo @(string)$resultCompanies->telephone ?>">

                            </div>

                        </div>


                        <div class="col-md-8">

                            <div class="form-group">

                                <label for="email">

                                    <b> Email</b>

                                </label>

                                <input type="email" id="email" class="form-control" name="email" value="<?php echo @(string)$resultCompanies->email ?>">

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="site">

                                    <b> Site </b>

                                </label>

                                <input id="site" type="text" class="form-control" name="site" value="<?php echo @(string)$resultCompanies->site ?>">

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="text-end me-3 mb-2">
                <button type="button" class="btn btn-success btn-sm" onclick="sendRequest('CompaniesForm', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                    <i class="far fa-save me-2"></i>Salvar

                </button>
            </div>
        </div>
        <input type="hidden" name="company_id" value="<?php echo @(int)$resultCompanies->company_id ?>" />
        <input type="hidden" name="FOLDER" value="ACTION" />
        <input type="hidden" name="TABLE" value="COMPANIES" />
        <input type="hidden" name="ACTION" value="COMPANIES_SAVE" />

    </form>

</div>

<form role="form" id="formCities">

    <input type="hidden" name="CITY_ID" ID="CITY_ID_FORM" value="" />
    <input type="hidden" name="FOLDER" value="ACTION" />
    <input type="hidden" name="TABLE" value="CITIES" />
    <input type="hidden" name="ACTION" value="CITIES_ALL" />

</form>

<script type="text/javascript">
    /** Carrego as mascaras */
    loadMask();

    function CitiesAll(form) {

        $.ajax({

            url: 'router.php',
            type: 'post',
            dataType: 'json',
            data: $(form).serialize(),

            /** Antes de enviar */
            beforeSend: function() {

                /** Construo o bloqueio de página */
                blockPage(true, '', null, '', '', 'random', 'circle', 'md');

            },

            /** Caso tenha sucesso */
            success: function(response) {

                /** Verifico o retorno */
                switch (response.code) {

                    case 0:

                        /** Resultado das pessoas */
                        let resultCities = JSON.parse(response.data);

                        /** Estrutura HTML */
                        let html = '<select name="city_id" id="city_id" class="form-control">';

                        /** Listagem de todos os registros */
                        for (let i = 0; i < resultCities.length; i++) {

                            let htmlSelected = null;

                            /** Verifico se devo selecionar a cidade */
                            if (resultCities[i].city_id == <?php echo @(int)$resultCompanies->city_id ?>) {

                                htmlSelected = 'selected';

                            }

                            /** Preencho as op */
                            html += '<option value="' + resultCities[i].city_id + '" ' + htmlSelected + '>';
                            html += resultCities[i].name;
                            html += '</option>';

                        }

                        html += '</select>';

                        /** Removo o combobox existente */
                        $('#city_id').remove();

                        /** Adiciono o novo combobox */
                        $('#city_box').append(html);

                        /** Habilito o campo */
                        $('#city_id').prop('disabled', false);
                        break;

                    default:

                        /** Abro um popup com os dados **/
                        openPopup(response.title, response.message, response.cod);
                        break;

                }

            },

            /** Caso tenha falha */
            error: function(xhr, ajaxOptions, thrownError) {

                /** Delay de resposta */
                window.setTimeout(() => {

                    let messages = Array();
                    messages.push([null, xhr.status + ' - ' + ajaxOptions + ' - ' + thrownError]);

                    /** Abro um popup com os dados **/
                    openPopup('Atenção', messages);

                }, 1000);

            },

            complete: function() {

                /** Delay de resposta */
                window.setTimeout(() => {

                    /** Remoção do Bloqueio de Página */
                    blockPage(false);

                }, 500);

            }

        });

    }

    /** Monitoro as alterações que ocorrem */
    $('#state_id').change(function() {

        /** Defino o ID Atual*/
        $('#CITY_ID_FORM').val($('#state_id').val());

        /** Busco as cidades */
        CitiesAll('#formCities');

    });

    <?php

    /** Verifico se devo buscar a cidade */
    if (@(int)$resultCompanies->city_id > 0) { ?>

        /** Deixo a função pronta para execução */
        $(document).ready(function(e) {

            /** Defino o ID Atual*/
            $('#CITY_ID_FORM').val($('#state_id').val());

            /** Busco as cidades */
            CitiesAll('#formCities');

        });

    <?php } ?>
</script>