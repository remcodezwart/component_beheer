<body>

        <div class="col-md-12">
                <div class="col-md-3">
                    <img style="margin-top: 40px; margin-right: 50px;" class="img-responsive" src="http://i.imgur.com/Jeoxccv.png">
                </div>
                <div class="col-md-9">
                    <div id="wrap">
                              <form action="<?php echo Config::get('URL');?>component/index"  method="post">
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
                    <img class="" src="<?= htmlentities($value->photo); ?>" style="width:75%; height:auto; margin:auto!important; ">
                </div>
                <div class="col-md-8">
                    <h2><?= htmlentities($value->description); ?></h2>


                    <p><span class="pull-left">Product-id: <?= htmlentities($value->productId); ?> </span>

                    <span style="margin-left: 3%;">Vooraad:<input type="textarea" name="quantity" form="formleerling<?=htmlentities($value->productId);?>" id="quantity" step="1" value=""> 
                    
                    <span style="margin-left: 1%;">Beschrijving: <input type="textarea" name="description" form="formleerling<?=htmlentities($value->productId);?>"  id="description" value="">
              
                    <span style="margin-left: 1%;">Prijs: <?= htmlentities($value->price); ?></span>

                    <span style="margin-left: 2%;">Leverancier: <?= htmlentities($value->name); ?>

                    <span style="margin-left: 3%;">Uitgeleend: 
                        <?php if ($value->userid == 0) {
                              echo "Nee";}
                        else{ echo $value->user_name; }?></span></p>
     </div></a>  
              <div class="h-divider">
                            <form class="form-inline" style="margin-top:110px!important;" action="<?= Config::get('URL');?>component/createMutation/?productId=<?=htmlentities($value->productId);?>" method="post" id="formleerling<?=htmlentities($value->productId);?>">
                                  <div class="form-group">
                                  
                                    <div class="input-group">
                            
                                      <input  id="student" name="student" type="text" class="form-control"  placeholder="Leerlingnummer" type="submit">
                                      </form>
                              


                                    </div>

                                  </div>
                             <a href="<?= Config::get('URL') . 'component/edit/' . $value->productId; ?>">Edit </a>
                              <a href="<?= Config::get('URL') . 'component/delete/' . $value->productId; ?>">Delete</a>

                                    <div class="pull-right" style="margin-top:20px;">

                                    <form  action="<?= Config::get('URL');?>component/index?productId=<?=htmlentities($value->productId);?>" method="post">
                                        <button style="margin-left:40px;" type="submit" class="btn btn-info">Innemen</button>  
                                        </form>
                                         <?php if ($value->userid == 0 || $value->userid == null) {
                                        echo " <button style='margin-left:40px;'' type='submit' form='formleerling$value->productId' value='submit'class='btn btn-primary'>Uitlenen</button>";}
                                      else{}?>

                                    </div>


                                </form>
               </div>
      
</div>
</div>
<?php } 

}
 ?>
 <p id="create">
        <h3>New component</h3>
        
         
        </p>
        <p>
            <form id="reset" method="post" action="<?php echo Config::get('URL');?>component/create">
                <label id="reset">Url of photo: </label><input id="reset" class="reset" type="text" name="photo" />
                <label id="reset">Description: </label><input id="reset" class="reset" type="text" name="description" />
                <label id="reset">Supplier id: </label><input id="reset" class="reset" type="text" name="supplier_id" />
                <label id="reset">Price: </label><input id="reset" class="reset" type="text" name="price" />
                
                <input class="button" id="reset" type="submit" value='Create this component' autocomplete="off" />
            </form>
        </p>

 </div>
 </div>


