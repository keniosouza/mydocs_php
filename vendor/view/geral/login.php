<div class="col-md-6 mx-auto mt-3">

    <div class="card shadow-sm animate slideIn">

        <form class="card-body" role="form" id="formUsersLogin">

            <h3 class="card-title">

                <img src="image/softwiki.png" width="27" alt="MyCMS - Souza Consultoria Tecnológica" loading="lazy"> | <img src="image/sct.png" width="30" alt="MyCMS - Souza Consultoria Tecnológica" loading="lazy">

                <strong>My</strong>Docs

            </h3>

            <h6 class="card-subtitle text-muted">

                Tela de Login | Acesso a Aplicação

            </h6>

            <div class="mt-3">

                <div class="form-group">

                    <label for="email">

                        Email

                    </label>

                    <input id="email" type="email" class="form-control" name="email">

                </div>

                <div class="form-group">

                    <label for="password">

                        Senha

                    </label>

                    <input type="password" id="password" class="form-control" name="password">

                </div>

                <div class="form-group text-end">

                    <button type="button" class="btn btn-primary mb-0" onclick="sendForm('#formUsersLogin')">

                        <i class="far fa-paper-plane me-1"></i>Acessar

                    </button>

                </div>

            </div>

            <input type="hidden" name="FOLDER" value="ACTION"/>
            <input type="hidden" name="TABLE" value="USERS"/>
            <input type="hidden" name="ACTION" value="USERS_LOGIN"/>

        </form>

    </div>

</div>