<div class="container">
    <h1>LoginController/showProfile</h1>

    <div class="box">
        <h2>Your profile</h2>

        <?=$this->renderFeedbackMessages(); ?>

        <div>Your username: <?= $this->user_name; ?></div>
        <div>Your email: <?= $this->user_email; ?></div>
        <div>Your avatar image:
            Your avatar picture: <img src='<?=Config::get('URL'); ?>pictures/default.jpg'>
        </div>
        <div>Your account type is: <?= $this->user_account_type; ?></div>
    </div>
</div>
