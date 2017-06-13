<h3>gebeurtenissen</h3>
<table class="striped responsive-table" cellspacing="0">
	<thead>
		<tr>
			<th>Naam</th>
			<th>component</th>
			<th>aantal +/-</th>
			<th>reden</th>
			<th>datum yyyy-mm-dd</th>
			<th>locatie</th>
		</tr>
	</thead>
	<tbody>	
		<?php foreach($this->mutations as $mutation) { ?>
			<tr>
				<td><?=$mutation->user_name ?> </td>
				<td><?=$mutation->name ?></td>
				<td><?=$mutation->amount ?></td>
				<td><?=$mutation->reason ?></td>
				<td><?=$mutation->date ?></td>
				<td><?=$mutation->address ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<p>
	mochten het aantal niet overeenkomen met de daadwerkelijke vooraad kunt u hieronder een correctie aanbrengen
</p>
<div class="row">
	<h6>Correctie</h6>
	<form method="post" action="<?=Config::get('URL') ?>component/addMutation">
		<div class="row">
			<div class="input-field col s12">
				<select class="browser-default">
					<option value="" disabled selected>Kies een reden</option>
					<option value="diefstal">Diefstal</option>
					<option value="correctie">correctie</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<select class="browser-default">
					<option value="" disabled selected>Kies een onderdeel</option>
					<?php foreach($this->components as $component) { ?>
						<option value="<?=$component->id?>"><?=$component->name ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="amount" type="number" class="validate">
				<label for="amount">Aantal</label>
			</div>
		</div>
		<input type="hidden" name="csrf_token" value="<?=Csrf::makeToken() ?>">

		<button class="btn waves-effect waves-light blue" type="submit" name="action">correctie aanbrengen
    		<i class="material-icons right">send</i>
  		</button>
	</form>
</div>