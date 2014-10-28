<?php
	// Database connection details
	$DATABASE_TYPE = 'mysql';
	$DATABASE_HOST = 'localhost';
	$DATABASE_NAME = 'DATABASE';
	$USER_NAME = 'USERNAME';
	$USER_PASSWORD = 'PASSWORD';

	// SendGrid SMTP credentials
	$SENDGRID_DIRECTORY = '/sendgrid/sendgrid-php.php';
	$SENDGRID_USERNAME = 'USERNAME';
	$SENDGRID_PASSWORD = 'PASSWORD';

	// Other stuff
	$REDDIT_SUBREDDIT = 'SUBREDDIT';

	// Error Messages
	$ERROR_MESSAGE['default'] = 'There\'s a bit of a problem <i class=\'fa fa-frown-o\'></i>';
	$ERROR_MESSAGE['not_signed_in'] = 'You\'re not signed in. To view your account, please register or sign in on the <a href=\'/\'>home page</a>.';
	$ERROR_MESSAGE['email_invalid'] = 'Your email is invalid. Please enter a valid email address.';
	$ERROR_MESSAGE['password_incorrect'] = 'Your password is incorrect. Please try again or <a href=\'mailto:contact@findanewmax.com\' class=\'alert-link\'>email us</a> for assistance.';
	$ERROR_MESSAGE['password_too_short'] = 'Your password is too short. Please use at least eight characters.';
	$ERROR_MESSAGE['article_invalid'] = 'This article doesn\'t exist. Make sure your link is correct and try again. If you\'d like, you can <a href=\'/\'>return to the home page</a>.</i>';
	$ERROR_MESSAGE['article_not_allowed'] = 'This article is only available to <span class=\'account-%LEVEL%\'>%LEVEL%</span> level subscribers. If you\'d like, you can <a href=\'account\'>upgrade your account</a> or <a href=\'/\'>return to the home page</a>.'
?>
