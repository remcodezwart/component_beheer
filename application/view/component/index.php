        <div class="col-md-12">
                <div class="col-md-3">
                    <img " class="img-responsive" src="http://i.imgur.com/Jeoxccv.png">
                </div>
                <div class="col-md-9">
                    <div id="wrap">
                        <form action="<?=Config::get('URL');?>component/index"  method="post">
                          <input id="search" name="search" type="text" placeholder="Scan Barcode"><input id="search_submit" value="Search" type="submit">
                        </form>
                    </div>
                </div>
        </div>      
       <div class="col-md-12">
         <?php if (!isset($_POST['search'])) {}

            else{
    foreach($this->component as $key => $value) {     ?>
                  
                    
   
              <div class="col-md-12">
                <div class="col-md-4">
                    <img src="<?=$value->photo; ?>" >
                </div>
                <div class="col-md-8">
                    <h2><?=$value->description; ?></h2>


                    <p><span class="pull-left">Product-id: <?=$value->productId;?> </span>

                    <span>Vooraad:<input type="textarea" name="quantity" form="formleerling<?=$value->productId;?>" id="quantity" step="1"> 
                    
                    <span>Beschrijving:<input type="textarea" name="description" form="formleerling<?=$value->productId;?>" id="description">
              
                    <span>Prijs: <?=$value->price;?></span>

                    <span>Leverancier: <?=$value->name;?>

                    <span>Uitgeleend: 
                        <?php if ($value->userid == 0) {?>
                              Nee
                        <?php }else{ echo $value->user_name; }?></span></p>
                </div>
                <div class="h-divider">
                              <form class="form-inline" action="<?=Config::get('URL');?>component/createMutation/?productId=<?=$value->productId ;?>" method="post" id="formleerling<?=$value->productId;?>">
                                    <div class="form-group">
                                    
                                      <div class="input-group">
                              
                                        <input  id="student" name="student" type="text" class="form-control"  placeholder="Leerlingnummer" type="submit">
                                      </div>
                                    </div>
                              </form>
                </div>
              </div>
                             <a href="<?=Config::get('URL') . 'component/edit/' . $value->productId; ?>">Edit </a>
                              <a href="<?=Config::get('URL') . 'component/delete/' . $value->productId; ?>">Delete</a>

                                    <div class="pull-right">
                                    <form  action="<?=Config::get('URL');?>component/index?productId=<?=$value->productId;?>" method="post">
                                        <button type="submit" class="btn btn-info">Innemen</button>  
                                         <?php if ($value->userid == 0 || $value->userid == null) {?>
                                          <button type='submit' form='formleerling<?=$value->productId?>' value='submit' class='btn btn-primary'>Uitlenen</button>";
                                      <?php };?>
                                    </form>
                                    </div>
<?php } 

}
 ?>
  <h3>Nieuw component</h3>
  <form method="post" action="<?=Config::get('URL');?>component/create">
      <label>Naam component: </label><input class="reset" type="text" name="name" required /><br>
      <label>Beschrijving: </label><textarea class="reset" name="description" required></textarea><br>
      <label>Specs: </label><textarea class="reset" name="specs" required></textarea><br>
      <label>Hyperlink: </label><input class="reset" type="text" name="hyperlink" required /><br>
      <label>Voorraad: </label><br>
      <?php foreach ($this->locations as $location) { ?>

        <label><?=$location->address?>: </label><input type="number" class="reset" name="amount" required />

      <?php } ?>
      <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>"><br>
    <input class="button" type="submit" value='Maak dit component aan' autocomplete="off" />
  </form>