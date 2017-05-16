<div class="container">
    <h1>Request a password reset</h1>
    <div class="box">

        <?=$this->renderFeedbackMessages(); ?>

        <form method="post" action="<?=Config::get('URL'); ?>login/requestPasswordReset_action">
            <label>
                Voer u gebruikers naam of email en volg de instructies in de email
                <input type="text" name="user_name_or_email" required="true">
            </label>
            <button type="submit">Stuur een email om mijn wachtwoord te resetten</button>
        </form>

    </div>
</div>
