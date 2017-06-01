<div class="container">
	<h3>Orders</h3>
    <div class="box">
		
		<?=$this->renderFeedbackMessages()?>
		<?php foreach($this->orders as $order) { ?>
			<p class="border">besteld op: <?=$order->date ?> | aantal: <?=$order->orderAmount ?> | levenranchier: <?=$order->supplierName ?> | onderdeel: <?=$order->name ?>
			<a href="<?=config::get('URL')?>component/orderedit?id=<?=$order->order_id?>">editen</a> 
            <a href="<?=config::get('URL')?>component/orderdelete?id=<?=$order->order_id?>">verwijderen</a></p>
			</p>
		<?php } ?>
	</div>
	<div class="box">
		<form method="post" action="<?=Config::get('URL') ?>component/addOrder">

			<label>Onderdeel</label>
			<select required="true" name="component">
				<option>Selecteer een onderdeel</option>
			<?php foreach ($this->components as $component) { ?>
				<option value="<?=$component->id ?>"><?=$component->name ?></option>
			<?php } ?>
			</select><br>
			
			<label>Besteld bij</label>
			<select required="true" name="store">
				<option>Selecteer een leverancier</option>
			<?php foreach ($this->stores as $store) { ?>
				<option value="<?=$store->id ?>"><?=$store->name ?></option>
			<?php } ?>
			</select><br>

			<label for="amount">Aantal
				<input required="true" id="amount" name="amount" type="text" placeholder="aantal">
			</label><br>

			<label for="shipping-date">Datum besteld
				<input required="true" placeholder="dd-mm-yyyy" type="text" name="shipping-date" id="shipping-date">
			</label>
			<input name="csrf_token" type="hidden" value="<?=Csrf::makeToken() ?>"><br>
			<button type="submit">Nieuwe order</button>
		</form>
	</div>
</div>