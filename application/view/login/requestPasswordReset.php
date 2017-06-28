<h1>Nieuw wachtwoord aanvragen</h1>

<form method="post" action="<?=Config::get('URL'); ?>login/requestPasswordReset_action">
    <label>
        Voer u gebruikers naam of email en volg de instructies in de email
        <input type="text" name="user_name_or_email" required="true">
    </label>
    <button class="btn waves-effect waves-light blue" type="submit" name="action">Stuur een email om mijn wachtwoord te resetten
      <i class="material-icons right">send</i>
    </button>
</form>