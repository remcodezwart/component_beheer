<div class="container">
    <div class="columns">
        <div class="column col-12">
            <h1>Onderdelen</h1>
            <div class="box">
                <?=$this->renderFeedbackMessages()?>
                <table>
                    <tr>
                        <td>naam</td>
                        <td>plaatje</td>
                        <td>beschrijving</td>
                        <td>specs</td>
                        <td>In voorraad</td>
                    </tr>  
                <?php foreach($this->component as $value) { ?>
                    <tr>
                        <td><?=$value->name?></td>
                        <td><img src="<?=$value->hyperlink?>" alt="component plaatje"></td>
                        <td><p>beschrijving: <?=$value->description?></p></td>
                        <td><pre>specs: <?=$value->specs?></pre></td>
                        <td><p>In voorraad: <?=$value->amount?></td>
                    </tr>    
                <?php } ?>
                </table>
            </div>    
        </div>
        <?php if (Session::userIsLoggedIn()) : ?>
            <div class="column col-12">
                <?php foreach($this->component as $value) { ?>
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
                <?php } ?>
                </div>
            <?php endif; ?>
            <?php if (!$this->component): ?>
                <p>Er zijn nog geen onderdelen.</p>
            <?php endif; ?>
    </div>
</div>