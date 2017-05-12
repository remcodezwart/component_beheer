<div class="container">


    <div class="box">
        <h2>Edit a component</h2>

        <!-- echo out the system feedback (error and success messages) -->


        <?php if ($this->comp) { ?>
            <form method="post" id="reset" action="<?php echo Config::get('URL'); ?>component/editSave">
                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" id="reset" name="productId" value="<?php echo htmlentities($this->comp->productId); ?>" />
                 <label id="reset">Change photo: </label>
                <input type="text" id="reset" class="reset" name="photo" value="<?php echo htmlentities($this->comp->photo); ?>" />
                <br>
                 <labe id="reset"l>Change description: </label>
                <input type="text" id="reset" class="reset" name="description" value="<?php echo htmlentities($this->comp->description); ?>" />
                <br>
                   <label id="reset">Change price: </label>
                <input type="text" id="reset" class="reset" name="price" value="<?php echo htmlentities($this->comp->price); ?>" />
                <br>
             
                   <label id="reset">Change supplier: </label>
                <input type="text" id="reset" class="reset" name="supplierId" value="<?php echo htmlentities($this->comp->supplierId); ?>" />
                <br>
            
                <input type="submit" id="reset" class="button" value='Change' />
            </form>
        <?php } else { ?>
            <p>This components does not exist.</p>
        <?php } ?>
    </div>
</div>
