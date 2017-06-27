<h2><?=$this->component->name ?></h2>
<?php if ($this->comloc) {
    foreach ($this->comloc as $com) {?>
        <label>In voorraad bij <?=$com->address?>: <?=$com->amount?></label>
<?php }} ?>

<a class="waves-effect waves-light btn" href="<?=Config::get('URL'); ?>index/loanMe?id=<?=$this->component->id ?>">onderdeel uitlenen</a>

<a class="waves-effect waves-light btn" href="<?=Config::get('URL'); ?>component/switchAmount?id=<?=$this->component->id ?>">verander onderdelen per locatie<i class="material-icons">mode_edit</i></a>
<form method="post" action="<?=Config::get('URL'); ?>component/editSave">
    <p>Verander naam:</p>
    <input name="name" type="text" value="<?=$this->component->name ?>">
    <p>Verander beschrijving:</p>
    <textarea name="description"><?=$this->component->description ?></textarea>
    <p>Verander specs:</p>
    <textarea name="specs"><?=$this->component->specs ?></textarea>
    <p>Verander hyperlink:<input type="text" name="hyperlink" value="<?=$this->component->hyperlink?>"/></p>                 
    <input type="hidden" name="id" value="<?=$this->component->id?>"/>
    <label>stuur mij een automatische email als het aantal onder</label>
    <input value="<?=$this->component->minAmount ?>" type="number" name="minAmount" required="true">
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <button class="btn waves-effect waves-light blue" type="submit" name="action">opslaan
        <i class="material-icons right">send</i>
    </button>
</form>