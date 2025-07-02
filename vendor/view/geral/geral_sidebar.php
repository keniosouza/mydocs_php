<div class="l-navbar shadow-sm border-end" id="nav-bar">

    <!-- Menu Lateral -->
    <nav class="nav-side">

        <div>

            <a href="#" class="nav_logo">
                
                <i class="fab fa-dochub nav_logo-icon"></i>
                <span class="nav_logo-name">
                    MyDocs
                </span>

            </a>

            <div class="nav_list dropdown">

                <!-- Usuarios -->
                <a class="nav_link active" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Usuários">

                    <i class='fas fa-users me-1 nav_icon'></i>
                    <span class="nav_name">Usuários</span>

                </a>

                <!--Empresas-->
                <a class="nav_link" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Empresas">

                    <i class='fas fa-building me-1 nav_icon'></i>
                    <span class="nav_name">Empresas</span>

                </a>

                <!--Minutas-->
                <a class="nav_link" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=DRAFTS&ACTION=DRAFTS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Minutas">

                    <i class='fas fa-file-word me-1 nav_icon'></i>
                    <span class="nav_name">Minutas</span>

                </a>

                <!--Produtos-->
                <a class="nav_link" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=PRODUCTS&ACTION=PRODUCTS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Produtos">

                    <i class='fas fa-box me-1 nav_icon'></i>
                    <span class="nav_name">Produtos</span>

                </a>

                <!--Marcações-->
                <a class="nav_link" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Marcações">

                    <i class='fas fa-highlighter me-1 nav_icon'></i>
                    <span class="nav_name">Marcações</span>

                </a>

                <!--Situações-->
                <a class="nav_link" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Status">

                    <i class='fas fa-thermometer-half me-1 nav_icon'></i>
                    <span class="nav_name">Status</span>

                </a>

                <!-- Configuraçoes -> Empresa -->
                <a class="nav_link dropdown-item" type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Configurações">
                    <i class='fas fa-cog me-1 nav_icon'></i>
                    <span class="nav_name">Configurações</span>
                </a>

            </div>

        </div>

        <!-- Sair -->
        <a class="nav_link" type="button" onclick="sendRequest('FOLDER=ACTION&TABLE=USERS&ACTION=USERS_LOGOUT', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" data-bs-toggle="tooltip" data-bs-title="Sair">

            <i class="fas fa-sign-out-alt"></i>
            <span class="nav_name">Sair</span>

        </a>

    </nav>
    
</div>

<script type="text/javascript">

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

</script>