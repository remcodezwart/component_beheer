<div class="container">
	<h2><?=$value->name?></h2>
    <p><?=$value->hyperlink?></p>
    <p><?=$value->description?> <?=$value->specs?></p>
    <p>In voorraad: <?=$value->amount?></p>
    <br>
    <label>Ik heb hiervan nodig...</label><input type="number" name="amount" required="true"/>
 </div>