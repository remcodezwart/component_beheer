<p>Verander u gebruikersnaam</p>
<p>huidige gebruikersnaam: <?=Session::get('user_name') ?></p>

<form action="<?=Config::get('URL'); ?>login/editUserName_action" method="post">
    <label>
        Nieuwe gebruikersnaam: <input type="text" name="user_name" required="true">
    </label>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <button type="submit">Versturen</button>
</form>