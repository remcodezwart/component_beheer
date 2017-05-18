<div class="container">
    <h3>leveranciers</h3>
    <div class="box">

        <?=$this->renderFeedbackMessages(); ?>
        
        <?php foreach ($this->suppliers as $supplier) { ?>
            <p class="border">leverancier: <?=$supplier->name?> 
            <a href="<?=config::get('URL')?>supplier/edit?id=<?=$supplier->id?>">editen</a> 
            <a href="<?=config::get('URL')?>supplier/delete?id=<?=$supplier->id?>">verwijderen</a></p>
        <?php } ?>

        <form method="post" action="<?=Config::get('URL') ?>supplier/add">
            <label>adres/website</label><input required="true" type="text" name="name">
            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <button tpye="submit">Toevoegen</button>
        </form>
    </div>
</div>
