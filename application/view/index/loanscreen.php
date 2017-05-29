<div class="container">
	<h2><?=$value->name?></h2>
    <p><?=$value->hyperlink?></p>
    <p><?=$value->description?> <?=$value->specs?></p>
    <p>In voorraad: <?=$value->amount1?></p>
    <br>
	<form method="post" action="<?=Config::get('URL'); ?>component/loanComponent">
    	<label>Ik heb hiervan nodig...</label><input type="number" name="amount1" required="true"/><br>
    	<input type="hidden" name="name" value="<?=$value->name?>"/>
    	<input type="hidden" name="amount0" value=<?=$value->amount1?> />
    	<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    	<input type="submit" class="button" value="Dit is zo goed."/>
    </form>
 </div>