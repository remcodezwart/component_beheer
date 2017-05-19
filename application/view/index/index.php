
<div class="container">
    <h1>IndexController/index</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages()?>

        <h3>What happens here ?</h3>
        <!--span><?=var_dump($this->component)?></span-->
        <p>
            This is the homepage. As no real URL-route (like /login/register) is provided, the app uses the default
            controller and the default action, defined in application/config/config.php, by default it's
            IndexController and index()-method. So, the app will load application/controller/IndexController.php and
            run index() from that file. Easy. That index()-method (= the action) has just one line of code inside
            ($this->view->render('index/index');) that loads application/view/index/index.php, which is basically
            this text you are reading right now.
        </p>
        <?php foreach($this->component as $key => $value) {?>
            <div class="col-md-8">
                <h2><?=$value->name?></h2>
                <p><?=$value->hyperlink?></p>
                <p><?=$value->description?> <?=$value->specs?></p>
                <p>In voorraad: <?=$value->amount?></p>
                <?php if (Session::userIsLoggedIn()) : ?>
                    <form method="post" action="<?=Config::get('URL'); ?>component/editSave">
                        <p>Verander beschrijving:<input type="textarea" name="description" value="<?=$value->description?>"/></p>
                        <p>Verander specs:<input type="textarea" name="specs" value="<?=$value->specs?>"/></p>
                        <p>Verander hyperlink:<input type="textarea" name="hyperlink" value="<?=$value->hyperlink?>"/></p>
                        <p>Verander voorraad:<input type="textarea" name="amount" value="<?=$value->amount?>"/></p>
                        <input type="hidden" name="id" id="id" value="<?=$value->id?>"/>
                        <input type="submit" class="button" value='Change'/>
                    </form>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
</div>