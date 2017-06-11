<p>Verander u gebruikersnaam</p>
<p>huidige: <?=Session::get('user_name') ?></p>

<form action="<?=Config::get('URL'); ?>login/editUserName_action" method="post">
    <label>
        Nieuwe: <input type="text" name="user_name" required="true">
    </label>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
     <button class="btn waves-effect waves-light blue" type="submit" name="action">wijzig
    	<i class="material-icons right">send</i>
  	</button>
</form>