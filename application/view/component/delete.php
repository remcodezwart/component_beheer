<?php if ($this->component) { ?>
	<h5>weet u zeker dat u dit onderdeel <?=$this->component->name ?> wil verwijderen</h5>
	<form method="post" action="<?=Config::get('URL') ?>component/deleteAction">
		<input type="hidden" value="<?=$this->component->id ?>" name="id">
		<input type="hidden" value="<?=Csrf::makeToken() ?>" name="csrf_token">
		<button class="btn waves-effect waves-light blue" type="submit" name="action">verwijderen
	        <i class="material-icons right">send</i>
	    </button>
	</form>
<?php } else { ?>
	<p class="red center-align">dit onderdeel bestaat niet</p>
<?php } ?>