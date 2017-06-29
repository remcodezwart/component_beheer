<h3 class="center-align">leveranciers</h3>

<?=$this->generateNav(Config::get('URL')."supplier/index", Request::get('page'))?>

<table class="striped responsive-table">
	<thead>
		<tr>
			<th>leverancier</th>
			<th>acties</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->suppliers as $supplier) { ?>
			<tr>
				<td><?=$supplier->name?></td>
				<td>
					<a class="waves-effect waves-light btn yellow" href="<?=Config::get('URL') ?>supplier/edit?id=<?=$supplier->id ?>"><i class="material-icons">mode_edit</i></a>
				    <a class="waves-effect waves-light btn red" href="<?=Config::get('URL') ?>supplier/delete?id=<?=$supplier->id ?>"><i class="material-icons">delete</i></a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<h5 class="center-align">nieuwe locatie toevoegen</h5>
<form method="post" action="<?=Config::get('URL') ?>supplier/add">
    <label>adres/website</label>
    <textarea name="name"></textarea>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">

    <button class="btn waves-effect waves-light blue" type="submit" name="action">Toevoegen
    	<i class="material-icons right">send</i>
  	</button>
</form>