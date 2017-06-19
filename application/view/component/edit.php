<h2><?=$this->component->name ?></h2>
<?php if ($this->comloc) { ?>
    <label>In voorraad: <?=$this->comloc->address?>: <?=$this->comloc->amount?></label>
<?php } ?>

<a class="waves-effect waves-light btn" href="<?=Config::get('URL'); ?>index/loanMe?id=<?=$this->component->id ?>">onderdeel uitlenen</a>

<a class="waves-effect waves-light btn" href="<?=Config::get('URL'); ?>component/switchAmount?id=<?=$this->component->id ?>">verander onderdelen per locatie<i class="material-icons">mode_edit</i></a>
<form method="post" action="<?=Config::get('URL'); ?>component/editSave">
    <p>Verander beschrijving:</p>
    <textarea name="description"><?=$this->component->description ?></textarea>
    <p>Verander specs:</p>
    <textarea name="specs"><?=$this->component->specs ?></textarea>
    <p>Verander hyperlink:<input type="text" name="hyperlink" value="<?=$this->component->hyperlink?>"/></p>                 
    <input type="hidden" name="id" value="<?=$this->component->id?>"/>
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
    <button class="btn waves-effect waves-light blue" type="submit" name="action">opslaan
        <i class="material-icons right">send</i>
    </button>
</form>