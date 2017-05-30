<div class="container">
	<h2><?=$value->name?></h2>
    <p><?=$value->hyperlink?></p>
    <p><?=$value->description?> <?=$value->specs?></p>
    <p>In voorraad: <?=$value->amount?></p>
    <p>Je kan op dit moment alleen lenen van Duurzaamheidsfabriek Dordrecht Da Vinci.</p>
    <br>
	<form method="post" action="<?=Config::get('URL'); ?>component/loanComponent">
    	<label>Ik heb hiervan nodig...</label><input type="number" name="amount" required="true"/><br>
    	<input type="hidden" name="name" value="<?=$value->name?>"/>
    	<input type="hidden" name="amount0" value=<?=$value->amount?> />
    	<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    	<input type="submit" class="button" value="Dit is zo goed."/>
    </form>
 </div>