<?php if ($this->location) { ?>
	<h5 class="center-align">locatie editen</h5>
    <form method="post" action="<?=Config::get('URL')?>location/editConfirmed">
        <label>Adres</label>
        <textarea name="adress" required="true"><?=$this->location->address?></textarea>
        <input type="hidden" name="id" value="<?=$this->location->id?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <button class="btn waves-effect waves-light blue" type="submit" name="action">locatie editen
    		<i class="material-icons right">send</i>
  		</button>
    </form>
<?php } else { ?>
    <p class="center-align red">deze locatie bestaat niet</p>
<?php } ?>
