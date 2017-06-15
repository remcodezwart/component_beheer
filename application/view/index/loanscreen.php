<h2><?=$this->component->name?></h2>
<p><img alt="component plaatje" src="<?=$this->component->hyperlink?>"</p>
<p><?=$this->component->description?></p>
<p><pre><?=$this->component->specs?></pre></p>
<p>In voorraad: <?=$this->component->amount?></p>
<p>Je kan op dit moment alleen lenen van Duurzaamheidsfabriek Dordrecht Da Vinci.</p>
<br>
<form method="post" action="<?=Config::get('URL'); ?>component/loanComponent">
    <label>Ik heb hiervan nodig...</label><input type="number" name="amount" required="true"/><br>
    <input type="hidden" name="id" value="<?=$this->component->id?>"/>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <p>Mijn barcode is...</p>
    <input type="text" name="barcode" required="true"/><br>
	<button class="btn waves-effect waves-light blue" type="submit" name="action">uitlenen
		<i class="material-icons right">send</i>
	</button>
</form>
