<h5>Verander aantallen</h5>
<?php foreach ($this->comloc as $comloc) {?>
	<h5><?=$comloc->address?></h5>
	<p>Het huidige aantal is <?=$comloc->amount?></p>
	<form method="post" action="<?=Config::get('URL'); ?>component/confirmSwitchAmount">
		<input type="number" name="amount" value=<?=$comloc->amount?> />
		<input type="hidden" name="component" value=<?=$comloc->component_id?> />
		<input type="hidden" name="location" value=<?=$comloc->location_id?> />
		<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
		<button class="btn waves-effect waves-light blue" type="submit" name="action">opslaan
			<i class="material-icons right">send</i>
		</button>
	</form>
<?php };?>
