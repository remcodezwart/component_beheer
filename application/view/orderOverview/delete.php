<div class="container">
	<h3>Order verwijderen</h3>
    <div class="box">
		
		<?=$this->renderFeedbackMessages()?>
		<h2>weet u zeker dat u deze order wil verwijderen?</h2>
		<?php if ($this->order) {?>
			<form method="post" action="<?=Config::get('URL') ?>component/deleteOrder">
				<input type="hidden" name="id" value="<?= $this->order->order_id ?>">
				<input name="csrf_token" type="hidden" value="<?=Csrf::makeToken() ?>">
				<button type="submit">Order verwijderen</button>
			</form>
		<?php } else { ?>
			<p>deze order bestaat niet</p>
		<?php } ?>
		
	</div>
</div>