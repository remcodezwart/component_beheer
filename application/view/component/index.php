<h3>Nieuw component</h3>
<form method="post" action="<?=Config::get('URL');?>component/create">
    <label>Naam component: </label><input class="reset" type="text" name="name" required /><br>
    <label>Beschrijving: </label><textarea class="reset" name="description" required></textarea><br>
    <label>Specs: </label><textarea class="reset" name="specs" required></textarea><br>
    <label>Hyperlink: </label><input class="reset" type="text" name="hyperlink" required /><br>
    <label>stuur mij een automatische email als het aantal onder</label><input type="number" name="minAmount" required="true">
    <label>Voorraad: </label>
    <!--br>
    <//?php foreach ($this->locations as $location) { ?>

      <label><?=$location->address?>: </label--><input type="number" class="reset" name="amount" required />

    <!--<?php// } ?>-->
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>"><br>
    <button class="btn waves-effect waves-light blue" type="submit" name="action">Nieuwe order
      <i class="material-icons right">send</i>
    </button>

</form>