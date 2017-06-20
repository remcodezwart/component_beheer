<div class="input-field">
    <input class="search" name="search" id="search" type="search" required="true">
    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
    <i class="material-icons">close</i>
</div>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>naam</th>
            <th>plaatje</th>
            <th>beschrijving</th>
            <th>specs</th>
        </tr>
    </thead>  
    <tbody id="results">
    	<?php if (Session::get('searchResults')) { ?>
	        <?php foreach (Session::get('searchResults') as $result) { ?>
		        <tr> 
		        	<td><?=$result->name?></td>
	                <td><img src="<?=$result->hyperlink?>" alt="component plaatje"></td>
	                <td><?=$result->description?></td>
	                <td><pre><?=$result->specs?></pre></td>  
		    	</tr>
	        <?php } ?>
    	<?php } else { ?>
			<tr>
				<td colspan="4" class="center-align red">geen resultaten gevonden </td>
	    	</tr>
    	<?php } ?>
    </tbody>    
</table>