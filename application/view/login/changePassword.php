<h2>Nieuw wachtwoord</h2>
   
<form method="post" action="<?=Config::get('URL'); ?>login/setNewPassword" name="new_password_form">
    <input type='hidden' name='user_name' value='<?=$this->user_name; ?>' />
    <input type='hidden' name='user_password_reset_hash' value='<?=$this->user_password_reset_hash; ?>' />
    <label for="reset_input_password_new">Nieuw wachtwoord (minimaal 6 karakters)</label>
    <input id="reset_input_password_new" class="reset_input" type="password"
               name="user_password_new" pattern=".{6,}" required="true" autocomplete="off">
    <label for="reset_input_password_repeat">Herhaal uw nieuwe wachtwoord</label>
    <input id="reset_input_password_repeat" class="reset_input" type="password"
               name="user_password_repeat" pattern=".{6,}" required="true" autocomplete="off">
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <button type="submit">Nieuw wachtwoord</button>       
</form>

<a href="<?=Config::get('URL'); ?>login/index">Terug naar de login pagina</a>