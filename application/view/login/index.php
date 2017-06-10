<div class="row">
    <h2>hier inloggen</h2>
    <form action="<?=Config::get('URL'); ?>login/login" method="post" class="col s12">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="user_name" id="userName/Email" required="true" class="validate">
                <label for="userName/Email">gebruikersnaam of email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="password" name="user_password" id="Password" required="true" class="validate">
                <label for="password">Wachtwoord</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="remember" type="checkbox" name="set_remember_me_cookie" class="remember-me-checkbox">
                <label for="remember">blijf ingelogd voor 2 weken</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <button class="blue darken-4 btn waves-effect waves-light" type="submit" name="action">inloggen
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="input-field col s12">
            <p class="center-align">
                <a href="<?=Config::get('URL'); ?>login/requestPasswordReset" class="red darken-4 waves-effect waves-light btn"><i class="material-icons left">report_problem</i>wachtwoord vergeten</a>
            </p>
        </div>
    </div>
</div>
