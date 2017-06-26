<img class="barcode-image" src="http://i.imgur.com/Jeoxccv.png">

<form action="<?=Config::get('URL');?>component/index"  method="post">
  <input id="search" name="search" type="text" placeholder="Scan Barcode">
  <button type="submit">Zoeken</button>
</form>

<h3>Nieuw component</h3>
<form method="post" action="<?=Config::get('URL');?>component/create">
    <label>Naam component: </label><input class="reset" type="text" name="name" required /><br>
    <label>Beschrijving: </label><textarea class="reset" name="description" required /></textarea><br>
    <label>Specs: </label><textarea class="reset" name="specs" required /></textarea><br>
    <label>Hyperlink: </label><input class="reset" type="text" name="hyperlink" required /><br>
    <label>Voorraad: </label><input class="reset" type="text" name="amount" required /><br>
    <!--label>Voorraad per locatie: </label><br><//?php foreach ($this->locations as $location) { ?>

      <label><?=$location->address?>: </label><input type="number" class="reset" name="<?=$location->id?>" />

    <//?php } ?>-->
    <label>Moet dit teruggebracht worden?</label><input type="radio" name="return" value="1" value="1" id="q_1_1"><label for="q_1_1"> Ja</label><br>
    <input type="radio" name="return" value="0" value="1" id="q_1_2"><label for="q_1_2"> Nee<br>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>"><br>
    <button class="btn waves-effect waves-light blue" type="submit" name="action">Nieuwe order
      <i class="material-icons right">send</i>
    </button>

</form>