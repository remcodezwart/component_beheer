<h3>Locaties</h3>

<table class="striped responsive-table">
	<thead>
		<tr>
			<th>locatie</th>
			<th>editen</th>
			<th>verwijderen</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->locations as $location) { ?>
		<tr>
			<td><?=$location->address?></td>
			<td><a class="waves-effect waves-light btn yellow" href="<?=Config::get('URL') ?>location/edit?id=<?=$location->id ?>"><i class="material-icons">mode_edit</i></a></td>
			<td><a class="waves-effect waves-light btn red" href="<?=Config::get('URL') ?>location/delete?id=<?=$location->id ?>"><i class="material-icons">delete</i></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<form method="post" action="<?=Config::get('URL') ?>location/add">
    <label>Adres</label>
    <textarea name="adress" required="true"></textarea>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <button tpye="submit">Toevoegen</button>
</form>