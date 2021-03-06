<?php
require $_SERVER['DOCUMENT_ROOT'] . '/template/config.php';

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

require $_SERVER['DOCUMENT_ROOT'] . '/template/login.php';
require $_SERVER['DOCUMENT_ROOT'] . '/template/logout.php';

$signed_in = false;

if (isset($_COOKIE['session']))
{	$stmt = $db->prepare('SELECT email, level, session_id, session_ip, session_user_agent, name, company, address FROM accounts WHERE session_id=:session_id LIMIT 1');
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
		$account_name = $results[0]['name'];
		$account_company = $results[0]['company'];
		$account_address = $results[0]['address'];

		if ($account_session_id === $_COOKIE['session'] && $account_session_ip === $_SERVER['REMOTE_ADDR'] && $account_session_user_agent === $_SERVER['HTTP_USER_AGENT'])
		{	$signed_in = true;

			if (isset($_COOKIE['demo']) && $_COOKIE['demo'] && $account_level === 'Diamond')
			{	$account_level = 'Gold';
			}

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

		setcookie('session', '', time() - 3600, '/', 'www.findanewmax.com');
	}
}

function get_days_ago($date_string)
{	return date_diff(date_create(date('Y-m-d')), date_create($date_string))->format('%a');
}

function get_days_ago_string($date_string)
{	$days_ago = get_days_ago($date_string);
	$days_ago_string = $days_ago . ' days ago';
	
	switch (true)
	{	case ($days_ago == 0):
			$days_ago_string = 'today <span class=\'badge\'>New!</span>';
			break;
		case ($days_ago == 1):
			$days_ago_string = 'yesterday';
			break;
		case ($days_ago == 7):
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

	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='/css/style.css'>

	<link rel='shortcut icon' sizes='16x16 24x24 32x32 48x48 64x64' href='https://www.findanewmax.com/favicon.ico'>
	<link rel='apple-touch-icon' sizes='57x57' href='https://www.findanewmax.com/img/ico/57.png'>
	<link rel='apple-touch-icon-precomposed' sizes='57x57' href='https://www.findanewmax.com/img/ico/57.png'>
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
			<div class='navbar-header'>
				<a class='navbar-brand' href='/'><img src='/img/logo.svg' height='22px' alt='Logo'></a>
				<a class='navbar-brand' href='/'>FITspiration</a>
			</div>
			<div class='collapse navbar-collapse' id='navbar-collapse'>
				<form class='navbar-form navbar-right' method='post' role='form'>
					<button type='submit' class='btn btn-default' id='signout' name='logout' value='true'><i class='fa fa-sign-out'></i> Sign out</button>
				</form>
				<ul class='nav navbar-nav navbar-right'>
					<li><a href='/'><i class='fa fa-dashboard'></i> Dashboard</a></li>
					<li><a href='/articles'><i class='fa fa-newspaper-o'></i> Articles</a></li>
					<li><a href='/recipes'><i class='fa fa-cutlery'></i> Recipes</a></li>
					<li><a href='/workouts'><i class='fa fa-child'></i> Workouts</a></li>
					<li><a href='/videos'><i class='fa fa-video-camera'></i> Videos</a></li>
					<li><a href='/account'><i class='fa fa-user'></i> Account</a></li>
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
			<div class='navbar-header'>
				<a class='navbar-brand' href='/'><img src='/img/logo.svg' height='22px' alt='Logo'></a>
				<a class='navbar-brand' href='/'>FITspiration</a>
			</div>
			<div class='collapse navbar-collapse' id='navbar-collapse'>
				<form class='navbar-form navbar-right' action='/#login' method='post' role='form'>
					<button type='submit' class='btn btn-default'><i class='fa fa-sign-in'></i> Register or sign in</button>
				</form>
			</div>
		</div>
	</nav>

<?php
}
?>

	<div class='jumbotron'>
		<div class='row text-center'>
			<img class='img-logo' src='/img/logo.svg' width='20%' alt='Logo'>
		</div>
		<div class='row text-center'>

<?php
if (!$signed_in)
{
?>

			<h1><span class='title'>FITspiration</span></h1>
			<h2><span class='title'>Find a new max</span></h2>

<?php
}
?>

		</div>
	</div>
	<br>

	<a id='page'></a>
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
