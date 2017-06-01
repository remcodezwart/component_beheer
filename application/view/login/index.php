<div class="container">
    <div class="columns">
        <div class="column col-12">
            <?php $this->renderFeedbackMessages(); ?>

            <div class="login-page-box">
                <div class="table-wrapper">

                    <div class="login-box">
                        <h2>hier inloggen</h2>
                        <form action="<?=Config::get('URL'); ?>login/login" method="post">
                            <input type="text" name="user_name" placeholder="Username or email" required="true">
                            <input type="password" name="user_password" placeholder="Password" required="true">
                            <label for="set_remember_me_cookie" class="remember-me-label">
                                <input type="checkbox" name="set_remember_me_cookie" class="remember-me-checkbox">
                                blijf ingelogd voor 2 weken
                            </label>
                            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
                            <button type="submit" class="login-submit-button">inloggen</button> 
                        </form>
                        <p>
                            <a href="<?=Config::get('URL'); ?>login/requestPasswordReset">Ik ben mijn wachtwoord vergeten</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>