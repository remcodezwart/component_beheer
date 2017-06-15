<h1>Verander aantallen</h1>
<!--?=var_dump($this)?-->
<?php foreach ($this->comloc as $comloc) {?>
	<h5><?=$comloc->address?></h5>
	<p>Het huidige aantal is <?=$comloc->amount?></p>
	<form method="post" action="<?=Config::get('URL'); ?>component/confirmSwitchAmount">
		<input type="number" name="amount" value=<?=$comloc->amount?> />
		<input type="hidden" name="id" value=<?=$comloc->id?> />
		<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
		<button type="submit">Dit is goed zo.</button>
	</form>
<?php };?>