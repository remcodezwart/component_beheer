<div class="container">

    <?=$this->renderFeedbackMessages(); ?>

    <div class="box">
        <h2>Verander acount type</h2>
        <!-- basic implementation for two account types: type 1 and type 2 -->
	    <form action="<?=Config::get('URL'); ?>login/changeUserRole_action" method="post">
                <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
            <?php if (Session::get('user_account_type') == 1) { ?>
                <input type="submit" name="user_account_upgrade" value="Upgrade my account (to Premium User)">
	        <?php } else if (Session::get('user_account_type') == 2) { ?>
	            <input type="submit" name="user_account_downgrade" value="Downgrade my account (to Basic User)">
	        <?php } ?>
	    </form>
    </div>
</div>
