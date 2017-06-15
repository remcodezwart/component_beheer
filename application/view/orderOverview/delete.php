<?php if ($this->order) {?>
	<h5>Order verwijderen</h5>
	<h6>weet u zeker dat u deze order wil verwijderen?</h6>
	<form method="post" action="<?=Config::get('URL') ?>component/deleteOrder">
		<input type="hidden" name="id" value="<?= $this->order->order_id ?>">
		<input name="csrf_token" type="hidden" value="<?=Csrf::makeToken() ?>">
		<button type="submit">Order verwijderen</button>
	</form>
<?php } else { ?>
	<p class="center-align red">deze order bestaat niet</p>
<?php } ?>