<?php if ($this->loan) { ?>
	<h5 class="center-align">lening editen</h5>
    <form method="post" action="<?=Config::get('URL') ?>loan/editConfirmed">
        <label>Aantal</label>
        <input type="number" name="amount" value="<?=$this->loan->amount ?>">
        <label>locatie</label>
        <select class="browser-default" required="true" name="location">
        <?php foreach ($this->locations as $location) { ?>
            <option <?php if ($location->id == $this->loan->location_id) { echo "selected=\"true\""; } ?> 
            value="<?=$location->id ?>"><?=$location->address ?></option>
        <?php } ?>
        </select>
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <input type="hidden" value="<?=Request::get('id') ?>" name="id">
        <img class="hide-on-small-only barcode-image" src="http://i.imgur.com/Jeoxccv.png">
        <p>Barcode aanpassen</p>
        <input value="<?=$this->loan->barcode ?>" id="barcode" type="text" name="barcode" required="true"/><br>
        <button class="btn waves-effect waves-light blue" type="submit" name="action">Lening editen
            <i class="material-icons right">send</i>
        </button>
    </form>
<?php } else { ?>
    <p class="center-align red">deze lening bestaat niet</p>
<?php } ?>
