<?php if ($this->suplier) { ?>
	<h3 class="center-align">leverancier editen</h3>
    <form method="post" action="<?=Config::get('URL')?>supplier/editConfirmed">
        <label>adres/website</label><input required="true" value="<?=$this->suplier->name?>" type="text" name="name">
        <input type="hidden" name="id" value="<?=$this->suplier->id?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <button class="btn waves-effect waves-light blue" type="submit" name="action">Editen
    		<i class="material-icons right">send</i>
  		</button>
    </form>
<?php } else { ?>
    <p class="center-align red">deze leverancier bestaat niet</p>
<?php } ?>