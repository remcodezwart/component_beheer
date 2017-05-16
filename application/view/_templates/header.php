<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>component beheer</title>

    <link rel="stylesheet" href="<?=Config::get('URL'); ?>css/style.css" />
    <link rel="stylesheet" href="<?=Config::get('URL'); ?>css/style2.css" />
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
    

        <!-- navigation -->
        <ul class="navigation">
            <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                <a href="<?=Config::get('URL'); ?>index/index">Home</a>
            </li>
            <li <?php if (View::checkForActiveController($filename, "overview")) { echo ' class="active" '; } ?> >
                <a href="<?=Config::get('URL'); ?>profile/index">Profielen</a>
            </li>
            <?php if (Session::userIsLoggedIn()) { ?>
                <li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>dashboard/index">Dashboard</a>
                </li>
                <li <?php if (View::checkForActiveController($filename, "Components")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>component/index">Componenten</a>
                </li>
            <?php } else { ?>
                <!-- for not logged in users -->
                <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>login/index">Inloggen</a>
                </li>
                <li <?php if (View::checkForActiveControllerAndAction($filename, "login/register")) { echo ' class="active" '; } ?> >
                    <a href="<?=Config::get('URL'); ?>login/register">Registreren</a>
                </li>
            <?php } ?>
        </ul>

        <!-- my account -->
        <ul class="navigation right">
        <?php if (Session::userIsLoggedIn()) : ?>
            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                <a href="<?=Config::get('URL'); ?>login/showprofile">My Account</a>
                <ul class="navigation-submenu">
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?=Config::get('URL'); ?>login/changeUserRole">Change account type</a>
                    </li>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/editusername">wijzig gebruikersnaam</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/edituseremail">wijzig email-adress</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/logout">Uitloggen</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        </ul>