<h3>Orders</h3>

<h2>Openstaanden orders</h2>
<table class="striped responsive-table">
	<thead>
		<tr>
			<th>besteld op</th>
			<th>aantal</th>
			<th>levenranchier</th>
			<th>onderdeel</th>
			<th>acties</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($this->orders as $order) { ?>
			<tr>
				<td><?=$order->date ?></td>
				<td><?=$order->orderAmount ?></td>
				<td><?=$order->supplierName ?></td>
				<td><?=$order->name ?></td>
				<td><a class="waves-effect waves-light btn yellow" href="<?=config::get('URL')?>component/orderedit?id=<?=$order->order_id?>"><i class="material-icons">mode_edit</i></a>
				    <a class="waves-effect waves-light btn red" href="<?=config::get('URL')?>component/orderdelete?id=<?=$order->order_id?>"><i class="material-icons">delete</i></a>
				    <?php if ($order->history === '0') {?><a class="waves-effect waves-light btn blue" href="<?=config::get('URL')?>component/archieve?id=<?=$order->order_id?>"><i class="material-icons">done</i></a><?php } else { ?>ja<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<form method="post" action="<?=Config::get('URL') ?>component/addOrder">
	<label>Onderdeel</label>
	<select class="browser-default" required="true" name="component">
		<option>Selecteer een onderdeel</option>
	<?php foreach ($this->components as $component) { ?>
		<option value="<?=$component->id ?>"><?=$component->name ?></option>
	<?php } ?>
	</select><br>
	
	<label>Besteld bij</label>
	<select class="browser-default" required="true" name="store">
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
	<button class="btn waves-effect waves-light blue" type="submit" name="action">Nieuwe order
    	<i class="material-icons right">send</i>
  	</button>
</form>