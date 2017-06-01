<div class="container">
	<h3>Order archieveren</h3>
    <div class="box">
		
		<?=$this->renderFeedbackMessages()?>
		<h2>weet u zeker dat u deze order wilt in het archief wilt plaatsen?</h2>
		<?php if ($this->order) {?>
			<form method="post" action="<?=Config::get('URL') ?>component/addToArchieve">
				<input type="hidden" name="id" value="<?= $this->order->order_id ?>">
				<input name="csrf_token" type="hidden" value="<?=Csrf::makeToken() ?>">
				<button type="submit">Order in het archief plaatsen</button>
			</form>
		<?php } else { ?>
			<p>deze order bestaat niet</p>
		<?php } ?>
		
	</div>
</div>