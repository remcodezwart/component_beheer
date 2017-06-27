<h1 class="center-align">Onderdelen</h1>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>naam</th>
            <th>plaatje</th>
            <th>beschrijving</th>
            <th>specs</th>
            <th>In voorraad</th>
            <th>Moet dit terug?</th>
        <?php if (Session::userIsLoggedIn()) { ?>
            <th>acties</th>
        <?php } ?>
        </tr>
    </thead>  
    <tbody>
        <?php foreach($this->components as $component): ?>
            <tr> 
                <td><?=$component->name?></td>
                <td><img src="<?=$component->hyperlink?>" alt="component plaatje"></td>
                <td><?=$component->description?></td>
                <td><pre><?=$component->specs?></pre></td>
                <td>totaal:
                    <?php foreach($this->comloc as $id):
                        if ($component->id == $id->component_id): ?>
                            locatie: <?=$id->address ?> aantal: <?=$id->amount ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </td>
                <td><?php if ($component->return == 1): ?>
                    Ja.
                    <?php else: ?>
                    Nee.
                    <?php endif; ?>
                </td>
            <?php if (Session::userIsLoggedIn()) { ?>
                <td>
                    <a class="waves-effect waves-light btn yellow" href="<?=Config::get('URL') ?>component/edit?id=<?=$component->id ?>"><i class="material-icons">mode_edit</i></a>
                    <a class="waves-effect waves-light btn red" href="<?=Config::get('URL') ?>component/delete?id=<?=$component->id ?>"><i class="material-icons">delete</i></a>
                </td>
            <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>    
</table>
