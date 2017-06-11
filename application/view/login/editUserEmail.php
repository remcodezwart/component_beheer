<p>Wijzig uw email adress</p>

<p>huidige: <?=Session::get('user_email') ?></p>

<form action="<?=Config::get('URL'); ?>login/editUserEmail_action" method="post">
    <label>
        Nieuw: <input type="text" name="user_email" required="true">
    </label>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
     <button class="btn waves-effect waves-light blue" type="submit" name="action">wijzig
    	<i class="material-icons right">send</i>
  	</button>
</form>