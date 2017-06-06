<?php var_dump($value); ?> 
<div class="container">
	<h2><?=$value->name?></h2>
    <p><img alt="component plaatje" src="<?=$value->hyperlink?>"</p>
    <p><?=$value->description?></p>
    <p><pre><?=$value->specs?></pre></p>
    <p>In voorraad: <?=$value->amount?></p>
    <p>Je kan op dit moment alleen lenen van Duurzaamheidsfabriek Dordrecht Da Vinci.</p>
    <br>
	<form method="post" action="<?=Config::get('URL'); ?>component/loanComponent">
    	<label>Ik heb hiervan nodig...</label><input type="number" name="amount" required="true"/><br>
    	<input type="hidden" name="name" value="<?=$value->name?>"/>
    	<input type="hidden" name="amount0" value=<?=$value->amount?> />
    	<input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    	<p>Mijn barcode is...</p>
    	<input type="text" name="barcode" required="true"/><br>
    	<input type="submit" class="button" value="Dit is zo goed."/>
    </form>
 </div>