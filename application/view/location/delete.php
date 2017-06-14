<?php if ($this->location) { ?>
	<h3 class="center-align">locatie verwijderen</h3>
    <h6 class="center-align">weet u zeker dat u de locatie <?=$this->location->address?> wil verwijderen?</h6> 
    <form method="post" action="<?=Config::get('URL') ?>location/deleteConfirmed">
        <input type="hidden" name="id" value="<?=$this->location->id?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
	    <button class="btn waves-effect waves-light blue" type="submit" name="action">locatie verwijderen
    		<i class="material-icons right">send</i>
  		</button>
    </form>
<?php } else { ?>
    <p class="red center-align">deze locatie bestaat niet</p>
<?php } ?>