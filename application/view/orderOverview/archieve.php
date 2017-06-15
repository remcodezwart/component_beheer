<?php if ($this->order) {?>
	<h5 class="center-align">Order archieveren</h5>
	<h6 class="center-align">weet u zeker dat u deze order wilt in het archief wilt plaatsen?</h6>
	<form method="post" action="<?=Config::get('URL') ?>component/addToArchieve">
		<input type="hidden" name="id" value="<?= $this->order->order_id ?>">
		<input name="csrf_token" type="hidden" value="<?=Csrf::makeToken() ?>">
		<button class="btn waves-effect waves-light blue" type="submit" name="action">Order in het archief plaatsen
    		<i class="material-icons right">send</i>
  		</button>
	</form>
<?php } else { ?>
	<p class="red center-align">deze order bestaat niet</p>
<?php } ?>