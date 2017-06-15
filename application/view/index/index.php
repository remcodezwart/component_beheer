<h1 class="center-align">Onderdelen</h1>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>naam</th>
            <th>plaatje</th>
            <th>beschrijving</th>
            <th>specs</th>
            <th>In voorraad</th>
        <?php if (Session::userIsLoggedIn()) { ?>
            <th>editen</th>
            <th>verwijderen</th>
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
                <td>totaal: <?=$component->amount?>
                    <?php foreach($this->comloc as $id):
                        if ($component->id == $id->component_id): ?>
                            locatie: <?=$id->address ?> aantal: <?=$id->amount ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </td>
            <?php if (Session::userIsLoggedIn()) { ?>
                <td><a class="waves-effect waves-light btn yellow" href="<?=Config::get('URL') ?>component/edit?id=<?=$component->id ?>"><i class="material-icons">mode_edit</i></a></td>
                <td><a class="waves-effect waves-light btn red" href="<?=Config::get('URL') ?>component/delete?id=<?=$component->id ?>"><i class="material-icons">delete</i></a></td>
            <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>    
</table>
