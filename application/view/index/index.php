<div class="container">
    <h1>Onderdelen</h1>
    <div class="box">

        <?=$this->renderFeedbackMessages()?>
        
        <?php foreach($this->component as $value): ?>
            <h2>naam: <?=$value->name?></h2>
            <img src="<?=$value->hyperlink?>" alt="component plaatje">
            <p>beschrijving: <?=$value->description?></p>
            <pre>specs: <?=$value->specs?></pre>
            <p>In voorraad: <br><?php foreach ($this->locations as $location) { ?>
                <label><?=$location->address?>: <?=$value->amount1?></label><br>
            <?php } ?></p>
            <?php if (Session::userIsLoggedIn()) : ?>
                <form method="post" action="<?=Config::get('URL'); ?>index/loanMe">
                    <input type="hidden" name="id" value="<?=$value->id?>"/>
                    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
                    <input type="submit" class="button" value="Ik wil dit lenen."/>
                </form>
                <form method="post" action="<?=Config::get('URL'); ?>component/editSave">
                    <p>Verander beschrijving:</p>
                    <textarea name="description"><?=$value->description ?></textarea>
                    <p>Verander specs:</p>
                    <textarea name="specs"><?=$value->specs ?></textarea>
                    <p>Verander hyperlink:<input type="text" name="hyperlink" value="<?=$value->hyperlink?>"/></p>
                    <p>Verander aantal in de voorraad:<br><?php foreach ($this->locations as $location) { ?>
                        <label><?=$location->address?>:<input type="textarea" name="amount" value="<?=$value->amount1?>"/></p>
                    <?php } ?>
                    <input type="hidden" name="id" value="<?=$value->id?>"/>
                    <button type="submit">Sla op</button>
                </form>
                <form method="post" action="<?=Config::get('URL'); ?>component/delete">
                    <input type="hidden" name="id" value="<?=$value->id?>"/>
                    <button type="submit">verwijder</button>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if (!$this->component): ?>
            <p>Er zijn nog geen onderdelen.</p>
        <?php endif; ?>
    </div>
</div>