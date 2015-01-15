<?php
// Database connection details
$DATABASE_TYPE = 'mysql';
$DATABASE_HOST = 'localhost';
$DATABASE_NAME = 'DATABASE';
$USER_NAME = 'USERNAME';
$USER_PASSWORD = 'PASSWORD';

// Package location details
$SENDGRID_LOCATION = '/sendgrid/sendgrid-php.php';
$PARSEDOWN_LOCATION = '/parsedown/Parsedown.php';

// Email details
$SENDGRID_USERNAME = 'USERNAME';
$SENDGRID_PASSWORD = 'PASSWORD';
$EMAIL_OUTBOUND = 'contact@findanewmax.com';
$EMAIL_INVOICE_COPY = 'invoice@findanewmax.com';

// Extra details
$REDDIT_SUBREDDIT = 'SUBREDDIT';
$LEVEL_PRICES = ['Basic' => 'Free', 'Bronze' => 340, 'Silver' => 520, 'Gold' => 875];

// Error messages
$ERROR_MESSAGE['default'] = 'There\'s a bit of a problem <i class=\'fa fa-frown-o\'></i>';
$ERROR_MESSAGE['signed_out'] = 'You\'ve been signed out. Please sign in again to continue.';
$ERROR_MESSAGE['not_signed_in'] = 'You\'re not signed in. To view your account, please register or sign in on the <a href=\'/\'>home page</a>.';
$ERROR_MESSAGE['email_invalid'] = 'Your email is invalid. Please enter a valid email address.';
$ERROR_MESSAGE['password_incorrect'] = 'Your password is incorrect. Please try again or <a href=\'mailto:contact@findanewmax.com\' class=\'alert-link\'>email us</a> for assistance.';
$ERROR_MESSAGE['password_too_short'] = 'Your password is too short. Please use at least eight characters.';
$ERROR_MESSAGE['profile_incomplete'] = 'Your profile is not complete. Please update your information and try again.';
$ERROR_MESSAGE['no_articles'] = 'There are no articles available yet. Please check back later or consider upgrading your account.';
$ERROR_MESSAGE['article_invalid'] = 'This article doesn\'t exist. Make sure your link is correct and try again. If you\'d like, you can <a href=\'/\'>return to the home page</a>.</i>';
$ERROR_MESSAGE['article_not_allowed'] = 'This article is not available for your level. If you\'d like, you can <a href=\'account\'>upgrade your account</a> or <a href=\'/\'>return to the home page</a>.';
$ERROR_MESSAGE['no_workouts'] = 'There are no workouts available yet. Please check back later or consider upgrading your account.';
$ERROR_MESSAGE['workout_invalid'] = 'This workout doesn\'t exist. Make sure your link is correct and try again. If you\'d like, you can <a href=\'/\'>return to the home page</a>.</i>';
$ERROR_MESSAGE['workout_not_allowed'] = 'This workout is not available for your level. If you\'d like, you can <a href=\'account\'>upgrade your account</a> or <a href=\'/\'>return to the home page</a>.';
$ERROR_MESSAGE['no_recipes'] = 'There are no recipes available yet. Please check back later or consider upgrading your account.';
$ERROR_MESSAGE['recipe_invalid'] = 'This recipe doesn\'t exist. Make sure your link is correct and try again. If you\'d like, you can <a href=\'/\'>return to the home page</a>.</i>';
$ERROR_MESSAGE['recipe_not_allowed'] = 'This recipe is not available for your level. If you\'d like, you can <a href=\'account\'>upgrade your account</a> or <a href=\'/\'>return to the home page</a>.';
$ERROR_MESSAGE['no_videos'] = 'There are no videos available yet. Please check back later or consider upgrading your account.';
$ERROR_MESSAGE['video_invalid'] = 'This video doesn\'t exist. Make sure your link is correct and try again. If you\'d like, you can <a href=\'/\'>return to the home page</a>.</i>';
$ERROR_MESSAGE['video_not_allowed'] = 'This video is not available for your level. If you\'d like, you can <a href=\'account\'>upgrade your account</a> or <a href=\'/\'>return to the home page</a>.';
$ERROR_MESSAGE['no_wod'] = 'Sorry, we can\'t seem to find today\'s WOD. Please check back later!';

// EOF: config.php
