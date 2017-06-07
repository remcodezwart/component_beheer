<h3>leverancier verwijderen</h3>
    
<?php if ($this->suplier) { ?>
    <h3>weet u zeker dat u de leverancier <?=$this->suplier->name?> wilt verwijderen?</h3>
    <form method="post" action="<?=Config::get('URL')?>supplier/deleteConfirmed">
        <input type="hidden" name="id" value="<?=$this->suplier->id?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <button tpye="submit">verwijderen</button>
    </form>
<?php } else { ?>
    <p>deze leverancier bestaat niet</p>
<?php } ?>
