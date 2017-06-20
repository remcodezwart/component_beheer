<?php if ($this->component) { ?>
<h2><?=$this->component->name?></h2>
<p><img alt="component plaatje" src="<?=$this->component->hyperlink?>"></p>
<p><?=$this->component->description?></p>
<pre><?=$this->component->specs?></pre>
<p>In voorraad: <?=$this->component->amount?></p>
<p>Je kan op dit moment alleen lenen van Duurzaamheidsfabriek Dordrecht Da Vinci.</p>
<br>
<form method="post" action="<?=Config::get('URL'); ?>component/loanComponent">
    <label>Ik heb hiervan nodig...</label><input type="number" name="amount" required="true"/><br>
    <input type="hidden" name="id" value="<?=$this->component->id?>"/>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <img class="hide-on-small-only barcode-image" src="http://i.imgur.com/Jeoxccv.png">
    <p>Mijn barcode is...</p>
    <input id="barcode" type="text" name="barcode" required="true"/><br>
	<button class="btn waves-effect waves-light blue" type="submit" name="action">uitlenen
		<i class="material-icons right">send</i>
	</button>
</form>
<?php } else { ?>
<p class="red align-center"></p>
<?php } ?>