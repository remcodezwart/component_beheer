<div class="container">
    <h3>locatie editen</h3>
    <div class="box">

        <?=$this->renderFeedbackMessages(); ?>
        
        <?php if ($this->location) { ?>
        <form method="post" action="<?=Config::get('URL')?>location/editConfirmed">
            <label>Adres</label>
            <textarea name="adress" required="true"><?=$this->location->address?></textarea>
            <input type="hidden" name="id" value="<?=$this->location->id?>">
            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <button tpye="submit">Editen</button>
        </form>
        <?php } else { ?>
        <p>deze locatie bestaat niet</p>
        <?php } ?>
    </div>
</div>
