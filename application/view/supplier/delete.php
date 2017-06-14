<?php if ($this->suplier) { ?>
	<h5>leverancier verwijderen</h5>
    <h6 class="flow-text">weet u zeker dat u de leverancier <?=$this->suplier->name?> wilt verwijderen?</h6>
    <form method="post" action="<?=Config::get('URL')?>supplier/deleteConfirmed">
        <input type="hidden" name="id" value="<?=$this->suplier->id?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <button class="btn waves-effect waves-light blue" type="submit" name="action">Editen
    		<i class="material-icons right">send</i>
  		</button>
    </form>
<?php } else { ?>
    <p class="center-align red">deze leverancier bestaat niet</p>
<?php } ?>