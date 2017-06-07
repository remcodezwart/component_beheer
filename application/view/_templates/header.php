<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="<?=Csrf::makeToken() ?>">
    <meta name="url" content="<?=Config::get('URL')?>">

    <title>component beheer</title>

    <link rel="stylesheet" href="<?=Config::get('URL'); ?>css/style.css" />

    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?=Config::get('URL') ?>css/materialize.min.css"  media="screen,projection"/>
</head>
<body>
    <div class="container">
        <nav>
            <ul class="navigation">
                <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>index/index">Home</a>
                </li>
                <?php if (Session::userIsLoggedIn()) { ?>
                <li <?php if (View::checkForActiveController($filename, "component")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>component/index">Componenten</a>
                </li>
                <li <?php if (View::checkForActiveControllerAndAction  ($filename,                 "orderOverview/index")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>component/orderOverview">Order overzicht/geschiedenis</a>
                </li>
                <li <?php if (View::checkForActiveControllerAndAction($filename,                   "login/editUsername")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>login/editusername">wijzig gebruikersnaam</a>
                </li>
                <li <?php if (View::checkForActiveControllerAndAction  ($filename,                 "login/editUserEmail")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>login/edituseremail">wijzig email-adress</a>
                </li>
                <li <?php if (View::checkForActiveController($filename, "location")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>location/index">locaties</a>
                </li>
                <li <?php if (View::checkForActiveController($filename, "supplier")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>supplier/index">Leveranciers</a>
                </li>
                <li <?php if (View::checkForActiveController($filename, "supplier")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>supplier/mutationsIndex">mutations</a>
                </li>
                <li <?php if (View::checkForActiveAction($filename, "login")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>login/logout">Uitloggen</a>
                </li>
                <?php } else { ?>
                <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>login/index">Inloggen</a>
                </li>
                <?php } ?>
            </ul>
        </nav>
        <?=$this->renderFeedbackMessages(); ?>