<?php
require $_SERVER['DOCUMENT_ROOT'] . '/php/config.php';

function reload()
{	$header_location = 'Location: ' . preg_replace('/\.php|index\.php/', '', $_SERVER['PHP_SELF']);
	if (!empty($_SERVER['QUERY_STRING']))
	{	$header_location .= '?' . $_SERVER['QUERY_STRING'];
	}
	header($header_location);
}

session_start();

if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') === 0)
{	$_SESSION['postdata'] = $_POST;
	reload();
	exit;
}

if (isset($_SESSION['postdata']))
{	$_POST = $_SESSION['postdata'];
	unset($_SESSION['postdata']);
}

if (isset($_SESSION['error']))
{	$error = $_SESSION['error'];

	unset($_SESSION['error']);
}

$db = new PDO("$DATABASE_TYPE:dbname=$DATABASE_NAME;host=$DATABASE_HOST", $USER_NAME, $USER_PASSWORD);

require $_SERVER['DOCUMENT_ROOT'] . '/php/login.php';
require $_SERVER['DOCUMENT_ROOT'] . '/php/logout.php';

$signed_in = false;

if (isset($_COOKIE['session']))
{	$stmt = $db->prepare('SELECT email, level, session_id, session_ip, session_user_agent FROM accounts WHERE session_id=:session_id LIMIT 1');
	$stmt->execute(array(
		':session_id'=>$_COOKIE['session']
	));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{	$account_email = $results[0]['email'];
		$account_level = $results[0]['level'];
		$account_session_id = $results[0]['session_id'];
		$account_session_ip = $results[0]['session_ip'];
		$account_session_user_agent = $results[0]['session_user_agent'];

		if ($account_session_id === $_COOKIE['session'] && $account_session_ip === $_SERVER['REMOTE_ADDR'] && $account_session_user_agent === $_SERVER['HTTP_USER_AGENT'])
		{	$signed_in = true;

			$account_levels_inherited = array();
			switch($account_level)
			{	case 'Diamond':
					$account_levels_inherited[] = 'Diamond';
				case 'Gold':
					$account_levels_inherited[] = 'Gold';
				case 'Silver':
					$account_levels_inherited[] = 'Silver';
				case 'Bronze':
					$account_levels_inherited[] = 'Bronze';
				case 'Basic':
					$account_levels_inherited[] = 'Basic';
					break;
			}
		}
	}

	if (!$signed_in)
	{	$error = 'signed_out';

		setcookie('session', '', time() - 3600, '/');
	}
}

function get_days_ago($date_string)
{	return date_diff(date_create(date('Y-m-d')), date_create($date_string))->format('%a');
}

function get_days_ago_string($date_string)
{	$days_ago = get_days_ago($date_string);
	$days_ago_string = $days_ago . ' days ago';
	
	switch (true)
	{	case ($days_ago === 0):
			$days_ago_string = 'today <span class=\'badge\'>New!</span>';
			break;
		case ($days_ago === 1):
			$days_ago_string = 'yesterday';
			break;
		case ($days_ago === 7):
			$days_ago_string = 'a week ago';
			break;
		case ($days_ago > 7):
			$days_ago_string = date('l, F j, Y', strtotime($date_string));
			break;
	}

	return $days_ago_string;
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>

	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content='Track your fitness and find recipes, workouts, and more to help you live healthy. Share your progress with friends and work with others to meet goals and challenges.'>

	<title>FITspiration</title>

	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='/css/style.css'>

	<link rel='shortcut icon' sizes='16x16 24x24 32x32 48x48 64x64' href='https://www.findanewmax.com/favicon.ico'>
	<link rel='apple-touch-icon' sizes='57x57' href='https://www.findanewmax.com/img/ico/57.png'>
	<link rel='apple-touch-icon' sizes='57x57' href='https://www.findanewmax.com/img/ico/57.png'>
	<link rel='apple-touch-icon' sizes='72x72' href='https://www.findanewmax.com/img/ico/72.png'>
	<link rel='apple-touch-icon' sizes='114x114' href='https://www.findanewmax.com/img/ico/114.png'>
	<link rel='apple-touch-icon' sizes='120x120' href='https://www.findanewmax.com/img/ico/120.png'>
	<link rel='apple-touch-icon' sizes='144x144' href='https://www.findanewmax.com/img/ico/144.png'>
	<link rel='apple-touch-icon' sizes='152x152' href='https://www.findanewmax.com/img/ico/152.png'>
	<link rel='apple-touch-icon' sizes='180x180' href='https://www.findanewmax.com/img/ico/180.png'>
	<meta name='apple-mobile-web-app-capable' content='yes'>
	<meta name='apple-mobile-web-app-status-bar-style' content='black'>
	<meta name='application-name' content='FITspiration'>
	<meta name='msapplication-TileImage' content='https://www.findanewmax.com/img/ico/144.png'>
	<meta name='msapplication-TileColor' content='#f2f2f2'>

	<!--[if lt IE 9]>
		<script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
		<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
	<![endif]-->

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-39410002-8', 'auto');
		ga('require', 'displayfeatures');
		ga('send', 'pageview');
	</script>

</head>
<body>

<?php
if ($signed_in)
{
?>

	<nav class='navbar navbar-default' role='navigation'>
		<div class='container-fluid'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-collapse'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
			<a class='navbar-brand' href='/'>FITspiration</a>
			<div class='collapse navbar-collapse' id='navbar-collapse'>
				<form class='navbar-form navbar-right' method='post' role='form'>
					<button type='submit' class='btn btn-default' id='signout' name='logout' value='true'>Sign out</button>
				</form>
				<ul class='nav navbar-nav navbar-right'>
					<li><a href='/articles'>Articles</a></li>
					<li><a href='/recipes'>Recipes</a></li>
					<li><a href='/workouts'>Workouts</a></li>
					<li><a href='/account'>Account</a></li>
				</ul>
			</div>
		</div>
	</nav>

<?php
}
else
{
?>

	<nav class='navbar navbar-default' role='navigation'>
		<div class='container-fluid'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-collapse'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
			<a class='navbar-brand' href='/'>FITspiration</a>
			<div class='collapse navbar-collapse' id='navbar-collapse'>
				<form class='navbar-form navbar-right' action='/#body' method='post' role='form'>
					<button type='submit' class='btn btn-default'>Register or sign in</button>
				</form>
				<ul class='nav navbar-nav navbar-right'>
					<li><a href='/staff'>Staff</a></li>
				</ul>
			</div>
		</div>
	</nav>

<?php
}
?>

	<div class='jumbotron'>
		<div class='container text-center'>
			<img class='img-logo' src='/img/logo.svg' width='20%' alt='Logo'>
		</div>
	</div>
	<br>

	<a id='body'></a>
	<div class='container'>

<?php
if ($error)
{
?>

		<a id='error'></a>
		<div class='container row text-center'>
			<div class='alert alert-danger' role='alert'><?php echo $ERROR_MESSAGE[$error] ?></div>
		</div>

<?php
}

// EOF: header.php
