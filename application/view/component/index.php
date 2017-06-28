<h3>Nieuw component</h3>
<form method="post" action="<?=Config::get('URL');?>component/create">
    <label>Naam component: </label><input class="reset" type="text" name="name" required /><br>
    <label>Beschrijving: </label><textarea class="reset" name="description" required /></textarea><br>
    <label>Specs: </label><textarea class="reset" name="specs" required /></textarea><br>
    <label>Hyperlink: </label><input class="reset" type="text" name="hyperlink" required /><br>

    <label>stuur mij een automatische email als het aantal onder</label><input type="number" name="minAmount" required="true">

    <label>Voorraad op deze locatie: </label>
    
    <select name="location" class="browser-default">
    <?php foreach ($this->locations as $location) { ?>
        <option value="<?=$location->id ?>"><?=$location->address?></option>
    <?php } ?>
    </select>
    <label>Voorraad: </label><input class="reset" type="number" name="amount" required /><br>
    
    <label>Moet dit teruggebracht worden?</label>
    <input type="radio" name="return" value="1" id="true"><label for="true">Ja</label>
    <input type="radio" checked="true" name="return" value="0" id="false"><label for="false">Nee</label>

    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>"><br>
    <button class="btn waves-effect waves-light blue" type="submit" name="action">Nieuwe order
      <i class="material-icons right">send</i>
    </button>

</form>