<div class="row">

<div class="col-md-3 mx-auto mt-3">

    <div class="card shadow-sm animate slideIn">

        <form class="card-body" role="form" id="UsersLoginForm">

            <h3 class="card-title text-center">

                <img src="image/logo.png" width="180" alt="Mydocs - Orius Tecnologia" loading="lazy">

                <strong>My</strong>Docs

            </h3>

            <hr/>

            <h6 class="card-subtitle text-muted text-center">

                Acesso a Aplicação

            </h6>

            <div class="row mt-3 g-2">

                <div class="col-md-12">

                    <div class="form-group">

                        <label for="email">

                            Email

                        </label>

                        <input id="email" type="email" class="form-control" name="email">

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">

                        <label for="password">

                            Senha

                        </label>

                        <input type="password" id="password" class="form-control" name="password">

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group text-end">

                        <button type="button" class="btn btn-outline-primary" onclick="sendRequest('UsersLoginForm', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                            <i class="far fa-paper-plane me-1"></i>Acessar

                        </button>

                    </div>

                </div>

            </div>

            <input type="hidden" name="FOLDER" value="ACTION" />
            <input type="hidden" name="TABLE" value="USERS" />
            <input type="hidden" name="ACTION" value="USERS_LOGIN" />

        </form>

    </div>

</div>

</div>