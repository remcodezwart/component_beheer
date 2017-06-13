<h1>Onderdelen</h1>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>naam</th>
            <th>plaatje</th>
            <th>beschrijving</th>
            <th>specs</th>
            <th>In voorraad</th>
        </tr>
    </thead>  
    <tbody>
        <?php foreach($this->component as $value): ?>
            <tr> 
                <td><?=$value->name?></td>
                <td><img src="<?=$value->hyperlink?>" alt="component plaatje"></td>
                <td><?=$value->description?></td>
                <td><pre><?=$value->specs?></pre></td>
                <td>totaal: <?=$value->amount?>
                    <?php foreach($this->comloc as $component):
                        if($value->id == $component->component_id): ?>
                            locatie: <?=$component->address ?> aantal: <?=$component->amount ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>    
</table>
<?php if (Session::userIsLoggedIn()): ?>
    <?php foreach($this->component as $value): ?>
        <h2><?=$value->name ?></h2>
        <p>In voorraad: <br><?php foreach ($this->comloc as $comloc) {
            if ($value->id == $comloc->component_id) { ?>
            <label><?=$comloc->address?>: <?=$comloc->amount?></label><br>
        <?php }} ?></p>
        <form method="post" action="<?=Config::get('URL'); ?>index/loanMe">
            <input type="hidden" name="id" value="<?=$value->id?>"/>
            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <button type="submit">Ik wil dit lenen.</button>
        </form>
        <form method="post" action="<?=Config::get('URL'); ?>component/switchAmount">
            <input type="hidden" name="id" value="<?=$value->id?>"/>
            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <button type="submit">De aantallen per locatie zijn niet goed.</button>
        </form>
        <form method="post" action="<?=Config::get('URL'); ?>component/editSave">
            <p>Verander beschrijving:</p>
            <textarea name="description"><?=$value->description ?></textarea>
            <p>Verander specs:</p>
            <textarea name="specs"><?=$value->specs ?></textarea>
            <p>Verander hyperlink:<input type="text" name="hyperlink" value="<?=$value->hyperlink?>"/></p>
            <!--p>Verander aantal in de voorraad:<br><?php foreach ($this->locations as $location) { ?>
                <label><?=$location->address?>:<input type="textarea" name="amount" value="<?=$value->amount1?>"/></p>
            <?php } ?>-->
            <input type="hidden" name="id" value="<?=$value->id?>"/>
            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <button type="submit">Sla op</button>
        </form>
        <form method="post" action="<?=Config::get('URL'); ?>component/delete">
            <input type="hidden" name="id" value="<?=$value->id?>"/>
            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <button type="submit">verwijder</button>
        </form>
    <?php endforeach ?>
<?php endif; ?>
<?php if (!$this->component): ?>
    <p>Er zijn nog geen onderdelen.</p>
<?php endif; ?>
