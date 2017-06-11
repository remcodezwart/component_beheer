<h3>leveranciers</h3>

<table class="striped responsive-table">
	<thead>
		<tr>
			<th>leverancier</th>
			<th>editen</th>
			<th>verwijderen</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->suppliers as $supplier) { ?>
			<tr>
				<td><?=$supplier->name?></td>
				<td><a class="waves-effect waves-light btn yellow" href="<?=Config::get('URL') ?>location/edit?id=<?=$supplier->id ?>"><i class="material-icons">mode_edit</i></a></td>
				<td><a class="waves-effect waves-light btn red" href="<?=Config::get('URL') ?>location/delete?id=<?=$supplier->id ?>"><i class="material-icons">delete</i></a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<form method="post" action="<?=Config::get('URL') ?>supplier/add">
    <label>adres/website</label><input required="true" type="text" name="name">
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <button tpye="submit">Toevoegen</button>
</form>