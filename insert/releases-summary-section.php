<?php
$stmt = $db->prepare('SELECT id, title, date, description, category, link, type FROM videos WHERE (level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\') AND type!=\'Disabled\' ORDER BY id DESC LIMIT 1');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$videos = $results;

$stmt = $db->prepare('SELECT id, level, title, date FROM articles WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 3');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$articles = $results;

$stmt = $db->prepare('SELECT id, level, title, date FROM recipes WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 3');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$recipes = $results;

$stmt = $db->prepare('SELECT id, level, title, date FROM workouts WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 3');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$workouts = $results;
?>

<h2><i class='fa fa-refresh'></i> Latest releases</h2>
<div class='row'>
	<div class='col-xs-8 col-xs-offset-2 text-left'>

<?php
if ($videos || $articles || $recipes || $workouts)
{	if ($videos)
	{
?>

		<h4><small>Video</small> <a href='/videos'><?php echo $videos[0]['title'] ?></a></h4>
		<div class='embed-responsive embed-responsive-16by9'>

<?php
		if ($videos[0]['type'] === 'Vimeo')
		{
?>

			<iframe class='embed-responsive-item' src='//player.vimeo.com/video/<?php echo $videos[0]['link'] ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff' allowfullscreen></iframe>

<?php
		}
		else if ($videos[0]['type'] === 'YouTube')
		{
?>

			<iframe class='embed-responsive-item' src='//www.youtube-nocookie.com/embed/<?php echo $videos[0]['link'] ?>?rel=0&amp;showinfo=0' allowfullscreen></iframe>

<?php
		}
?>

		</div>
		<hr>

<?php
	}
	if ($articles)
	{
?>

		<h4><small>Article</small> <a href='article?id=<?php echo $articles[0]['id'] ?>'><?php echo $articles[0]['title'] ?></a></h4>

<?php
	}
	if ($recipes)
	{
?>

		<h4><small>Recipe</small> <a href='recipe?id=<?php echo $recipes[0]['id'] ?>'><?php echo $recipes[0]['title'] ?></a></h4>

<?php
	}
	if ($workouts)
	{
?>

		<h4><small>Workout</small> <a href='workout?id=<?php echo $workouts[0]['id'] ?>'><?php echo $workouts[0]['title'] ?></a></h4>

<?php
	}
}
?>

	</div>
</div>
