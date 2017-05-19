<div class="container">
    <h3>Locaties</h3>
    <div class="box">

        <?=$this->renderFeedbackMessages(); ?>

        <?php foreach ($this->locations as $location) { ?>

        <p class="border"><?=$location->address?>
            <a href="<?=Config::get('URL') ?>location/edit?id=<?=$location->id ?>">editen</a>
            <a href="<?=Config::get('URL') ?>location/delete?id=<?=$location->id ?>"> verwijderen</a>
        </p>
 
        <?php } ?>

        <form method="post" action="<?=Config::get('URL') ?>location/add">
            <label>Adres</label>
            <textarea name="adress" required="true"></textarea>
            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <button tpye="submit">Toevoegen</button>
        </form>
    </div>
</div>
