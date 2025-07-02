<?php

/** Importação de classes */

use vendor\model\States;
use vendor\model\Configurations;

/** Instânciamento de Classes */
$States = new States();
$Configurations = new Configurations();

/** Busco o registro */
$resultConfiguration = $Configurations->Get(@(int)$_POST['CONFIGURATION_ID']);

/** Decodifico as preferencias */
$resultConfiguration->preferences = (object)json_decode($resultConfiguration->preferences);

?>

<div class="container-center">

    <div class="row align-items-start">

        <h5 class="card-title col">

            <strong>

                <i class="fas fa-cog me-1"></i>Configurações

            </strong>

            <i class="fas fa-chevron-right regular"></i> Edição
        </h5>

        <div class="col text-end ms-4">
            <button type="button" class=" btn btn-primary btn-sm mb-2 " onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>
        </div>
    </div>

</div>

<form role="form" id="formConfigurations" class="card shadow-sm animate slideIn ">

    <div class="card-body">

        <ul class="nav nav-pills nav-fill mb-3" id="myTab" role="tablist">

            <li class="nav-item nav-link-pill me-1" role="inicio">

                <button class="nav-link active" id="inicio-tab" data-bs-toggle="tab" data-bs-target="#pills-inicio" type="button" role="tab" aria-controls="inicio-tab-pane" aria-selected="false">Inicio</button>

            </li>

            <li class="nav-item nav-link-pill mx-1" role="configuracoes">

                <button class="nav-link " id="contatos-tab" data-bs-toggle="tab" data-bs-target="#pills-configuracoes" type="button" role="tab" aria-controls="pills-configuracoes-tab" aria-selected="false">Contatos</button>

            </li>

            <li class="nav-item nav-link-pill mx-1" role="email">


                <button class="nav-link " id="responsavel-tab" data-bs-toggle="tab" data-bs-target="#pills-responsavel" type="button" role="tab" aria-controls="pills-configuracoes-tab" aria-selected="false">Responsável</button>

            </li>

            <li class="nav-item nav-link-pill mx-1" role="address">

                <button class="nav-link " id="address-tab" data-bs-toggle="tab" data-bs-target="#pills-address" type="button" role="tab" aria-controls="pills-configuracoes-tab" aria-selected="false">Endereço</button>

            </li>

            <li class="nav-item nav-link-pill mx-1" role="email">

                <button class="nav-link " id="email-tab" data-bs-toggle="tab" data-bs-target="#pills-email" type="button" role="tab" aria-controls="pills-email-tab" aria-selected="false">E-mail</button>

            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">

            <!--Inicio-->
            <div class="tab-pane fade active show" id="pills-inicio" role="tabpanel" aria-labelledby="pills-inicio-tab">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="nickname">

                                <b>Apelido</b>

                            </label>

                            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo @(string)$resultConfiguration->nickname ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name_business">

                                <b> Nome Empresarial</b>

                            </label>

                            <input type="text" class="form-control" id="name_business" name="name_business" value="<?php echo @(string)$resultConfiguration->name_business ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name_fantasy">

                                <b>Nome Fantasia</b>

                            </label>

                            <input type="text" class="form-control" id="name_fantasy" name="name_fantasy" value="<?php echo @(string)$resultConfiguration->name_fantasy ?>">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="cnpj">

                                <b> CNPJ</b>

                            </label>

                            <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?php echo @(string)$resultConfiguration->cnpj ?>">

                        </div>

                    </div>

                </div>

            </div>

            <!--Contatos-->
            <div class="tab-pane fade" id="pills-configuracoes" role="tabpanel" aria-labelledby="pills-configuracoes-tab">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="site">

                                <b>Site</b>

                            </label>

                            <input type="text" class="form-control" id="site" name="site" value="<?php echo @(string)$resultConfiguration->site ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="telephone">

                                <b>Telefone</b>

                            </label>

                            <input type="text" class="form-control phone_with_ddd" id="telephone" name="telephone" value="<?php echo @(string)$resultConfiguration->telephone ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="cellphone">

                                <b>Celular</b>

                            </label>

                            <input type="text" class="form-control phone_with_9" id="cellphone" name="cellphone" value="<?php echo @(string)$resultConfiguration->cellphone ?>">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="email">

                                <b>Email</b>

                            </label>

                            <input type="text" class="form-control" id="email" name="email" value="<?php echo @(string)$resultConfiguration->email ?>">

                        </div>

                    </div>

                </div>

            </div>

            <!--Responsavel-->
            <div class="tab-pane fade" id="pills-responsavel" role="tabpanel" aria-labelledby="pills-email-tab">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="responsible">

                                <b>Responsável</b>

                            </label>

                            <input type="text" class="form-control" id="responsible" name="responsible" value="<?php echo @(string)$resultConfiguration->responsible ?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="responsible_office">

                                <b>Responsável Cargo</b>

                            </label>

                            <input type="text" class="form-control" id="responsible_office" name="responsible_office" value="<?php echo @(string)$resultConfiguration->responsible_office ?>">

                        </div>

                    </div>

                </div>

            </div>

            <!--Endereço-->
            <div class="tab-pane fade" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="cep">

                                <b>CEP</b>

                            </label>

                            <input type="text" class="form-control cep" id="cep" name="cep" value="<?php echo @(string)$resultConfiguration->cep ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="state_id">

                                <b>Estado</b>

                            </label>

                            <select name="state_id" id="state_id" class="form-control">

                                <?php
                                foreach ($States->all() as $keyResultStates => $resultStates) { ?>

                                    <option value="<?php echo $resultStates->state_id ?>" <?php echo @(int)$resultStates->state_id === @(int)$resultConfiguration->state_id ? 'selected' : null ?>>

                                        <?php echo @(string)$resultStates->name ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group" id="city_form">

                            <label for="city_id">

                                <b>Cidade</b>

                            </label>

                            <div id="city_box">

                                <select name="city_id" id="city_id" class="form-select" aria-label="Default"></select>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="complement">

                                <b>Complemento</b>

                            </label>

                            <input type="text" class="form-control" id="complement" name="complement" value="<?php echo @(string)$resultConfiguration->complement ?>">

                        </div>

                    </div>

                </div>

            </div>

            <!--Email-->
            <div class="tab-pane fade" id="pills-email" role="tabpanel" aria-labelledby="pills-email-tab">

                <div class="row">

                    <div class="col-md-4">
                       
                
                        <div class="form-group">

                            <label for="host">
 
                                <b>Host</b>

                            </label>

                            <input type="text" class="form-control" id="host" name="host" value="<?php echo @(string)$resultConfiguration->preferences->email->host ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="username">

                                <b>Usuário</b>

                            </label>

                            <input type="text" class="form-control" id="username" name="username" value="<?php echo @(string)$resultConfiguration->preferences->email->username ?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">


                            <label for="port">

                                <b>Porta</b>

                            </label>

                            <div class="form-group" id="city_box">

                            <input type="text" class="form-control" id="port" name="port" value="<?php echo @(string)$resultConfiguration->preferences->email->port ?>">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="password">

                                <b>Senha</b>

                            </label>

                            <input type="text" class="form-control" id="password" name="password" value="<?php echo @(string)$resultConfiguration->preferences->email->password ?>">

                        </div>

                    </div>

                </div>

            </div>
            

        </div>

        <div class="form-group text-end">

            <button type="button" class="btn btn-success mt-2" onclick="sendRequest('formConfigurations', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="far fa-save me-2"></i>Salvar

            </button>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="CONFIGURATIONS">
    <input type="hidden" name="ACTION" value="CONFIGURATIONS_SAVE">
    <input type="hidden" name="configuration_id" value="<?php echo @(int)$resultConfiguration->configuration_id ?>">
</form>

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
                        let html = '<select name="city_id" id="city_id" class="form-select">';

                        /** Listagem de todos os registros */
                        for (let i = 0; i < resultCities.length; i++) {

                            let htmlSelected = null;

                            /** Verifico se devo selecionar a cidade */
                            if (resultCities[i].city_id == <?php echo @(int)$resultConfiguration->city_id ?>) {

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
    if (@(int)$resultConfiguration->city_id > 0) { ?>

        /** Deixo a função pronta para execução */
        $(document).ready(function(e) {

            /** Defino o ID Atual*/
            $('#CITY_ID_FORM').val($('#state_id').val());

            /** Busco as cidades */
            CitiesAll('#formCities');

        });

    <?php } ?>
</script>