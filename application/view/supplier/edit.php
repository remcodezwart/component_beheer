<h3>leverancier editen</h3>

<?php if ($this->suplier) { ?>
    <form method="post" action="<?=Config::get('URL')?>supplier/editConfirmed">
        <label>adres/website</label><input required="true" value="<?=$this->suplier->name?>" type="text" name="name">
        <input type="hidden" name="id" value="<?=$this->suplier->id?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
        <button tpye="submit">editen</button>
    </form>
<?php } else { ?>
    <p>deze leverancier bestaat niet</p>
<?php } ?>