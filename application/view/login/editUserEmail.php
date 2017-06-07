<p>Wijzig uw email adress</p>

<p>huidige email adress: <?=Session::get('user_email') ?></p>

<form action="<?=Config::get('URL'); ?>login/editUserEmail_action" method="post">
    <label>
        Nieuw email address: <input type="text" name="user_email" required="true">
    </label>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <button type="submit">Versturen</button>
</form>