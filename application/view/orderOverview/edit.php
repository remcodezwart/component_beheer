<div class="container">
	<h3>Order editen</h3>
    <div class="box">
		
		<?=$this->renderFeedbackMessages()?>
		<?php if ($this->order) { ?>
			<form method="post" action="<?=Config::get('URL') ?>component/editOrder">

			<label>Onderdeel</label>
			<select name="component">
			<?php foreach ($this->components as $component) { ?>
				<option <?php if ($component->id === $this->order->id) { ?> selected="true" <?php } ?> 	value="<?=$component->id ?>"><?=$component->name ?></option>
			<?php } ?>
			</select><br>
			
			<label>Besteld bij</label>
			<select name="store">
			<?php foreach ($this->stores as $store) { ?>
				<option <?php if ($store->id === $this->order->supplierId) { ?> selected="true" <?php } ?>                  value="<?=$store->id ?>"><?=$store->name ?></option>
			<?php } ?>
			</select><br>

			<label for="amount">Aantal
				<input required="true" value="<?=$this->order->orderAmount ?>" id="amount" name="amount" type="text" placeholder="aantal">
			</label><br>

			<label for="shipping-date">Datum besteld
				<input required="true" value="<?=$this->order->date ?>" placeholder="dd-mm-yyyy" type="text" name="shipping-date" id="shipping-date">
			</label>
			<input type="hidden" name="id" value="<?=$this->order->order_id ?>"> 
			<input name="csrf_token" type="hidden" value="<?=Csrf::makeToken() ?>"><br>
			<button type="submit">edit order</button>
		</form>
		<?php } else { ?>
			<p>deze order bestaat niet</p>
		<?php } ?>
	</div>
</div>