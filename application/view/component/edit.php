<div class="container">
    <div class="box">
        <h2>Edit a component</h2>
        <!-- echo out the system feedback (error and success messages) -->
        <?php if ($this->comp) { ?>
            <form method="post" action="<?=Config::get('URL'); ?>component/editSave">
                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" name="productId" value="<?=htmlentities($this->comp->productId); ?>" />
                 <label>Change photo: </label>
                <input type="text" class="reset" name="photo" value="<?=htmlentities($this->comp->photo); ?>" />
                <br>
                 <label>Change description: </label>
                <input type="text" class="reset" name="description" value="<?=htmlentities($this->comp->description); ?>" />
                <br>
                   <label>Change price: </label>
                <input type="text" class="reset" name="price" value="<?=htmlentities($this->comp->price); ?>" />
                <br>             
                   <label>Change supplier: </label>
                <input type="text" class="reset" name="supplierId" value="<?=htmlentities($this->comp->supplierId); ?>" />
                <br>
                <input type="submit" class="button" value='Change' />
            </form>
        <?php } else { ?>
            <p>This components does not exist.</p>
        <?php } ?>
    </div>
</div>
