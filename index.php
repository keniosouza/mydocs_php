<?php

/** Importação autoload */
include_once 'router.php';

/** Defino o tempo limite de execução */
set_time_limit(300);

/** Importação de classes */
use \vendor\controller\main\Main;

/** Instânciamento de classes */
$Main = new Main();

/** Operações */
$Main->SessionStart();

/** Variaveis padrão */
$Config = $Main->LoadConfig();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="pt-br, en, fr, it">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="PT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="resource-types" content="document" />
    <meta name="revisit-after" content="1" />
    <meta name="classification" content="Internet" />
    <meta name="robots" content="index,follow" />
    <meta name="distribution" content="Global" />
    <meta name="rating" content="General" />
    <meta name="audience" content="all" />
    <meta name="language" content="pt-br" />
    <meta name="doc-class" content="Completed" />
    <meta name="doc-rights" content="Public" />
    <meta name="revisit-after" content="1 days" />

    <title>

        <?php echo $Config->application->main->title ?>

    </title>

    <!-- Importação de arquivos de estilo -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/animate-dropdown.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/block.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Importação de arquivos javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/chart.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ckeditor.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/block.js"></script>
    <script src="js/file.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/router.js"></script>

</head>

<body id="body-pd">

    <?php 
    
        /** Verifico se devo mostrar o menu */
        if (@(int)$_SESSION['USER_ID'] > 0) {

            /** Importação do menu superior */
            include_once 'vendor/view/geral/geral_header.php'; 

            /** Importação do menu lateral */ 
            include_once 'vendor/view/geral/geral_sidebar.php';

        }
        
    ?>

    <!--  Espaço reservado para construção do MODAL  -->
    <div id="wrapper-modal"></div>

    <!--  Espaço reservado para construção da PÁGINA  -->
    <div class="<?php echo @(int)$_SESSION['USER_ID'] > 0 ? 'height-100' : null ?>" id="wrapper"></div>

    <script type="text/javascript">

        <?php

        /** Guardo o redirecionamento */
        $request = null;

        /** Verificação de redirecionamento */
        if (@(int)$_SESSION['USER_ID'] > 0) {

            /** Redirecionamento para o Launcher */
            $request = 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DATAGRID';

        } else {

            /** Redirecionamento para o Login */
            $request = 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_LOGIN';

        }

        ?>

        /** Carrego a página atual */
        sendRequest('<?php echo $request ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true);
        
    </script>

</body>

</html>