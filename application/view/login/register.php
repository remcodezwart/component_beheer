<div class="login-box">
    <h2>Maak een nieuw acount aan</h2>

    <form method="post" action="<?=Config::get('URL'); ?>login/register_action">
        <!-- the user name input field uses a HTML5 pattern check -->
        <input type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Gebruikersnaam (letters/nummers, 2 tot 64 karakters)" required="true">
        <input type="text" name="user_email" placeholder="Vul u email-adress in" required="true">
        <input type="password" name="user_password_new" pattern=".{6,}" placeholder="Wachtwoord (6 of  meer karakters)" required="true" autocomplete="off">
        <input type="password" name="user_password_repeat" pattern=".{6,}" required="true" placeholder="Herhaal uw wachtwoord" autocomplete="off">

        <img id="captcha" src="<?=Config::get('URL'); ?>login/showCaptcha">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <input type="text" name="captcha" placeholder="Voer hier de karakters die u ziet in" required="true">
    
        <a href="#" style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center"
           onclick="document.getElementById('captcha').src = '<?=Config::get('URL'); ?>login/showCaptcha?' + Math.random(); return false">Nieuwe captca</a>
        <button type="submit">Registreren</button>
    </form>
</div>