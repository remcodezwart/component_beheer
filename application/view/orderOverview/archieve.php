<h5>Order archieveren</h5>
	
<h6>weet u zeker dat u deze order wilt in het archief wilt plaatsen?</h6>
<?php if ($this->order) {?>
	<form method="post" action="<?=Config::get('URL') ?>component/addToArchieve">
		<input type="hidden" name="id" value="<?= $this->order->order_id ?>">
		<input name="csrf_token" type="hidden" value="<?=Csrf::makeToken() ?>">
		<button class="btn waves-effect waves-light blue" type="submit" name="action">Order in het archief plaatsen
    		<i class="material-icons right">send</i>
  		</button>
	</form>
<?php } else { ?>
	<p>deze order bestaat niet</p>
<?php } ?>