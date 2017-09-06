<?php if ($this->loan) { ?>
	<h5 class="center-align">lening verwijderen/innen</h5>
    <h4 class="center-align">weet u zeker dat u deze lening wil verwijderen/innen?</h4>
    <h6 class="center-align">De onderdelen worden weer terug geplaats waar ze vandaan kwamen</h6>
    <form method="post" action="<?=Config::get('URL') ?>loan/deleteConfirmed">
		<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
		<input type="hidden" value="<?=Request::get('id') ?>" name="id">
		<button class="btn waves-effect waves-light blue" type="submit" name="action">Lening Innen/verwijderen
    		<i class="material-icons right">send</i>
  		</button>
    </form>
<?php } else { ?>
    <p class="center-align red">deze lening bestaat niet</p>
<?php } ?>