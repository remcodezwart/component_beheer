<h3>locatie verwijderen</h3>

<?php if ($this->location) { ?>
    <h3>weet u zeker dat u de locatie <?=$this->location->address?> wil verwijderen?</h3> 
    <form method="post" action="<?=Config::get('URL') ?>location/deleteConfirmed">
        <input type="hidden" name="id" value="<?=$this->location->id?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
	    <button tpye="submit">Verwijderen</button>
    </form>
<?php } else { ?>
    <p>deze locatie bestaat niet</p>
<?php } ?>