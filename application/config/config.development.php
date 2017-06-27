<?php

/**
 * Configuration for DEVELOPMENT environment
 * To create another configuration set just copy this file to config.production.php etc. You get the idea :)
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard / no errors in production.
 * It's a little bit dirty to put this here, but who cares. For development purposes it's totally okay.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Returns the full configuration.
 * This is used by the core/Config class.
 */
return array(
	/**
	 * Configuration for: Base URL
	 * This detects your URL/IP incl. sub-folder automatically. You can also deactivate auto-detection and provide the
	 * URL manually. This should then look like 'http://192.168.33.44/' ! Note the slash in the end.
	 */
	'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
	/**
	 * Configuration for: Folders
	 * Usually there's no reason to change this.
	 */
	'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controller/',
	'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/view/',

	/**
	 * Configuration for: Default controller and action
	 */
	'DEFAULT_CONTROLLER' => 'index',
	'DEFAULT_ACTION' => 'index',
	/**
	 * Configuration for: Database
	 * DB_TYPE The used database type. Note that other types than "mysql" might break the db construction currently.
	 * DB_HOST The mysql hostname, usually localhost or 127.0.0.1
	 * DB_NAME The database name
	 * DB_USER The username
	 * DB_PASS The password
	 * DB_PORT The mysql port, 3306 by default (?), find out via phpinfo() and look for mysqli.default_port.
	 * DB_CHARSET The charset, necessary for security reasons. Check Database.php class for more info.
	 */
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'component_management',
	'DB_USER' => 'root',
	'DB_PASS' => '',
	'DB_PORT' => '3306',
	'DB_CHARSET' => 'utf8',
	/**
	 * Configuration for: Captcha size
	 * The currently used Captcha generator (https://github.com/Gregwar/Captcha) also runs without giving a size,
	 * so feel free to use ->build(); inside CaptchaModel.
	 */
	'CAPTCHA_WIDTH' => 359,
	'CAPTCHA_HEIGHT' => 100,
	/**
	 * Configuration for: Cookies
	 * 1209600 seconds = 2 weeks
	 * COOKIE_PATH is the path the cookie is valid on, usually "/" to make it valid on the whole domain.
	 * @see http://stackoverflow.com/q/9618217/1114320
	 * @see php.net/manual/en/function.setcookie.php
	 */
	'COOKIE_RUNTIME' => 1209600,
	'COOKIE_PATH' => '/',
	/**
	 * Configuration for: Email server credentials
	 *
	 * Here you can define how you want to send emails.
	 * If you have successfully set up a mail server on your linux server and you know
	 * what you do, then you can skip this section. Otherwise please set EMAIL_USE_SMTP to true
	 * and fill in your SMTP provider account data.
	 *
	 * EMAIL_USED_MAILER: Check Mail class for alternatives
	 * EMAIL_USE_SMTP: Use SMTP or not
	 * EMAIL_SMTP_AUTH: leave this true unless your SMTP service does not need authentication
	 */
	'EMAIL_USED_MAILER' => 'phpmailer',
	'EMAIL_USE_SMTP' => false,
	'EMAIL_SMTP_HOST' => '127.0.0.1',
	'EMAIL_SMTP_AUTH' => false,
	'EMAIL_SMTP_USERNAME' => '',
	'EMAIL_SMTP_PASSWORD' => '',
	'EMAIL_SMTP_PORT' => 25,
	'EMAIL_SMTP_ENCRYPTION' => false,
	/**
	 * Configuration for: Email content data
	 */
	'EMAIL_PASSWORD_RESET_URL' => 'login/verifypasswordreset',
	'EMAIL_PASSWORD_RESET_FROM_EMAIL' => 'no-reply@component-beheer.com',
	'EMAIL_PASSWORD_RESET_FROM_NAME' => 'component-beheer',
	'EMAIL_PASSWORD_RESET_SUBJECT' => 'wachtwoord resseten voor component-beheer',
	'EMAIL_PASSWORD_RESET_CONTENT' => 'klik alstublieft op deze link om u wachtwoord te resseten: ',
	'EMAIL_VERIFICATION_URL' => 'login/verify',
	'EMAIL_VERIFICATION_FROM_EMAIL' => 'no-reply@component-beheer.com',
	'EMAIL_VERIFICATION_FROM_NAME' => 'component-beheer',
	'EMAIL_VERIFICATION_SUBJECT' => 'activeer u acount voor component-beheer',
	'EMAIL_VERIFICATION_CONTENT' => 'Klik up deze link om u acount te activeren: ',
	'EMAIL_VERIFICATION_SUBJECT_OUT_OF_COMPONENTS' => 'te weinig onderdelen'

);
