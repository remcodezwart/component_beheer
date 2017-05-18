<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>component beheer</title>

    <link rel="stylesheet" href="<?=Config::get('URL'); ?>css/style.css" />
    <link rel="stylesheet" href="<?=Config::get('URL'); ?>css/style2.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <a href="<?=Config::get('URL'); ?>login/showprofile">Mijn acount</a>
                <ul class="navigation-submenu">
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?=Config::get('URL'); ?>login/changeUserRole">verander acount type</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?=Config::get('URL'); ?>login/editusername">wijzig gebruikersnaam</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?=Config::get('URL'); ?>login/edituseremail">wijzig email-adress</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "location")) { echo ' class="active" '; } ?> >
                        <a href="<?=Config::get('URL'); ?>location/index">locaties</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "supplier")) { echo ' class="active" '; } ?> >
                        <a href="<?=Config::get('URL'); ?>supplier/index">Leveranciers</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?=Config::get('URL'); ?>login/logout">Uitloggen</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        </ul>