<?php
require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php';

if (isset($_GET['tag']) && !empty($_GET['tag']) && strlen($_GET['tag']) <= 50)
{	$stmt = $db->prepare('SELECT id, title, date, description, category, link, type FROM videos WHERE (level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\') AND category=:tag AND type!=\'Disabled\' ORDER BY id DESC LIMIT 50');
	$stmt->execute(array(
		':tag'=>$_GET['tag']
	));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else
{	$stmt = $db->prepare('SELECT id, title, date, description, category, link, type FROM videos WHERE (level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\') AND type!=\'Disabled\' ORDER BY id DESC LIMIT 50');
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!$signed_in && !$error)
{	$_SESSION['error'] = 'not_signed_in';
}
else if (!$results && !$error)
{	$_SESSION['error'] = 'no_videos';
}

if ($_SESSION['error'] && !$error)
{	reload();
}

if (!$error)
{
?>

		<a id='articles'></a>
		<div class='container row text-center'>
			<h1>Videos <i class='fa fa-video-camera'></i></h1>
			<p>Wanna know how to do an exercise or cook a meal? Check out our videos for some great ideas!</p>
			<br>
		</div>
		<div class='container row text-center'>

<?php
	foreach ($results as $video)
	{	if ($video['type'] === 'Vimeo')
		{
?>

			<div class='col-sm-6'>
				<h2><?php echo $video['title'] ?><br><small><?php echo $video['description'] ?></small></h2>
				<p><small>Published <?php echo date('l, F j, Y', strtotime($video['date'])) ?> in <a href='videos?tag=<?php echo $video['category'] ?>'><span class='badge'><?php echo $video['category'] ?></span></a></small></p>
				<div class='embed-responsive embed-responsive-16by9'>
					<iframe class='embed-responsive-item' src='//player.vimeo.com/video/<?php echo $video['link'] ?>?byline=0&amp;portrait=0&amp;color=fff' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
				<br>
			</div>

<?php
		}
	}
?>

		</div>

<?php
}

require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';

// EOF: videos.php
