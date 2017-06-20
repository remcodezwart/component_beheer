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
    	<div class="row">
    		<div class="col s12">
			    <nav>
		            <div class="nav-wrapper">
				    	<ul id="nav-mobile" class="left hide-on-med-and-down">
			                <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
			                    <a href="<?=Config::get('URL'); ?>index/index">Home</a>
			                </li>
			            	
			                <?php if (Session::userIsLoggedIn()) { ?>
			                <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Acount</a>
							
							<ul id='dropdown1' class='dropdown-content'>
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
				                <li <?php if (View::checkForActiveControllerAndAction($filename, "supplier/index")) { echo ' class="active" '; } ?> >
				                    <a href="<?=Config::get('URL'); ?>supplier/index">Leveranciers</a>
				                </li>
				                <li <?php if (View::checkForActiveControllerAndAction($filename, "supplier/mutationsIndex")) { echo ' class="active" '; } ?> >
				                    <a href="<?=Config::get('URL'); ?>supplier/mutationsIndex">mutations</a>
				                </li>
				                <li <?php if (View::checkForActiveAction($filename, "login")) { echo ' class="active" '; } ?> >
				                    <a href="<?=Config::get('URL'); ?>login/logout">Uitloggen</a>
				                </li>
				            </ul>
				            <?php } else { ?>
				                <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
				                    <a href="<?=Config::get('URL'); ?>login/index">Inloggen</a>
				                </li>
		               		<?php } ?>
		               	</ul>
		               	<?php if ($filename !== "index/search") { ?>
			   				<form id="searchForm" class="right" action="<?=Config::get('URL') ?>index/searchAction" method="post">
						        <div class="input-field">
						        	<input type="hidden" name="csrf_token" value="<?=Csrf::makeToken() ?>">
							        <input placeholder="Zoeken bv arduino" name="search" id="search" type="search" required="true">
							        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
							        <i class="material-icons">close</i>
						        </div>
					        </form>
						<?php } ?>
		            </div>
		        </nav>
		    </div>
        </div>
        <?=$this->renderFeedbackMessages(); ?>