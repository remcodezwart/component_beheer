<h1 class="center-align">Uitgeleende onderdelen</h1>

    <?=$this->generateNav(Config::get('URL')."loan/index", Request::get('page'))?>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>Naam onderdeel</th>
            <th>locatie</th>
            <th>Aantal</th>
            <th>Datum en tijd dat het onderdeel geleend is</th>
            <th>Acties</th>
        </tr>
    </thead>  
    <tbody>
        <?php foreach($this->loans as $loand): ?>
            <tr> 
                <td><?=$loand->name ?></td>
                <td><?=$loand->address ?></td>
                <td><?=$loand->amount ?></td>
                <td><?=$loand->date ?></td>
                <td><a class="waves-effect waves-light btn yellow" href="<?=Config::get('URL') ?>loan/edit?id=<?=$loand->id?>"><i class="material-icons">mode_edit</i></a><a class="waves-effect waves-light btn blue" href="<?=Config::get('URL') ?>loan/delete?id=<?=$loand->id ?>"><i class="material-icons">archive</i></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>    
</table>
