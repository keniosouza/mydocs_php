<?php

/** Importação de classes */
use \vendor\model\Products;

/** Instânciamento de classes */
$Products = new Products();

?>

<div class="row animate slideIn mb-1">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-box me-1"></i>

                Produtos

            </strong>

        </h5>

    </div>

    <div class="col-md-6 text-end">
    
        <button type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=PRODUCTS&ACTION=PRODUCTS_FORM', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-plus me-1"></i>Novo

        </button>

    </div>

</div>

<?php

/** Verifico se existem registros */
if (count($Products->all()) > 0)
{ ?>

    <div class="row animate slideIn">

        <div class="col-md-12">

            <div class="form-group mb-2">

                <input type="text" class="form-control shadow-sm" placeholder="Pesquise por: Nome" id="search" name="search">

            </div>

            <div class="table-responsive">

                <table class="table table-hover bg-white shadow-sm border" id="search_table">

                    <thead id="search_table_head">
                    <tr>
                        <th class="text-center">

                            Nº

                        </th>

                        <th>

                            Nome

                        </th>

                        <th class="text-center">

                            Operações

                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    /** Consulta os usuário cadastrados*/
                    foreach ($Products->all() as $keyResultProducts => $resultProducts)
                    {?>

                        <tr class="border-top">

                            <td class="text-center">

                                <?php echo $resultProducts->product_id; ?>

                            </td>

                            <td>

                                <?php echo $resultProducts->name; ?>

                            </td>

                            <td class="text-center">

                                <form role="form" id="formProduct<?php echo $keyResultProducts?>" class="btn-group dropleft">

                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"  id="buttonDropdown_<?php echo $keyResultProducts->product_id?>" data-bs-toggle="dropdown"  aria-expanded="false">

                                        <i class="fas fa-cog"></i>

                                    </button>

                                    <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">
                                                                                  
                                        <a type="button" class="dropdown-item" onclick="sendRequest('FOLDER=VIEW&TABLE=PRODUCTS&ACTION=PRODUCTS_FORM&PRODUCT_ID=<?php echo @(int)$resultProducts->product_id?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                <i class="fas fa-user-edit me-1"></i>                              
                                            Editar
                                        </a>

                                        <li><hr class="dropdown-divider"></li>

                                        <a type="button" class="dropdown-item" onclick="sendRequest('FOLDER=ACTION&TABLE=PRODUCTS&ACTION=PRODUCTS_DELETE&PRODUCT_ID=<?php echo @(int)$resultProducts->product_id?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                                                <i class="fas fa-fire-alt"></i>                                         
                                            Excluir
                                        </a>

                                    </div>
                                    
                                    <input type="hidden" name="PRODUCT_ID" value="<?php echo @(int)$resultProducts->product_id?>"/>
                                    <input type="hidden" name="FOLDER" value="ACTION"/>
                                    <input type="hidden" name="TABLE" value="PRODUCTS"/>
                                    <input type="hidden" name="ACTION" value="PRODUCTS_DELETE"/>

                                </form>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <?php

}else{ ?>

        <div class="alert alert-warning border-warning shadow-sm mt-3" role="alert">

        <h4 class="alert-heading">

            <strong>

                Ooops!

            </strong>

        </h4>

        <p>

            Não localizamos nenhum produto cadastrado.

        </p>

        </div>

<?php }?>

<script type="text/javascript">

    /** Carrego o LiveSearch */
    loadLiveSearch();

</script>