<h4 class="center-align">gebeurtenissen</h4>

<?=$this->generateNav(Config::get('URL')."supplier/mutationsIndex", Request::get('page'))?>

<form action="" method="get" class="center-align">
	<div class="input-field inline">
	
	<input id="startdate" type="text" name="startdate" placeholder="dd-mm-jjjj">
	<label for="startdate">tussen</label>
	</div>
	<div class="input-field inline">
	<label id="enddate" for="enddate">en</label>
	<input type="text" name="enddate" placeholder="dd-mm-jjjj">
	</div>
	<div class="input-field inline">
	<button class="btn waves-effect waves-light" type="submit">verzenden</button>
	</div>
	
</form>

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
<p class="flow-text">
	mochten het aantal niet overeenkomen met de daadwerkelijke vooraad kunt u hieronder een correctie aanbrengen
</p>
<div class="row">
	<h5 class="center-align">Correctie</h5>
	<form method="post" action="<?=Config::get('URL') ?>component/correction">
		<div class="row">
			<div class="input-field col s12">
				<select name="reason" class="browser-default">
					<option value="" disabled selected>Kies een reden</option>
					<option value="Diefstal">Diefstal</option>
					<option value="Correctie">Correctie</option>
					<option value="Kapot">Kapot</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<select name="component" class="browser-default">
					<option value="" disabled selected>Kies een onderdeel</option>
					<?php foreach($this->components as $component) { ?>
						<option value="<?=$component->id?>"><?=$component->name ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<select name="location" class="browser-default">
					<option value="" disabled selected>Kies een locatie</option>
					<?php foreach($this->locations as $location) { ?>
						<option value="<?=$location->id?>"><?=$location->address ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input required="true" name="amount" id="amount" type="number" class="validate">
				<label for="amount">Aantal</label>
			</div>
		</div>

		<input type="hidden" name="csrf_token" value="<?=Csrf::makeToken() ?>">
		<button class="btn waves-effect waves-light blue" type="submit" name="action">correctie aanbrengen
    		<i class="material-icons right">send</i>
  		</button>
	</form>
</div>