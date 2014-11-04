<?php
require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php';

if (isset($_GET['id']) && ctype_digit($_GET['id']))
{	$stmt = $db->prepare('SELECT level, title, date, source, body, image, description, category FROM workouts WHERE id=:id LIMIT 1');
	$stmt->execute(array(
		':id'=>$_GET['id']
	));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{	$workout_level = $results[0]['level'];
		$workout_title = $results[0]['title'];
		$workout_date = $results[0]['date'];
		$workout_source = $results[0]['source'];
		$workout_body = $results[0]['body'];
		$workout_image = $results[0]['image'];
		$workout_description = $results[0]['description'];
		$workout_category = $results[0]['category'];

		$workout_valid = true;
		$workout_allowed = array_search($workout_level, $account_levels_inherited) !== false;
	}
}

if (!$workout_valid && !$error)
{	$_SESSION['error'] = 'workout_invalid';
}
else if (!$signed_in && !$error)
{	$_SESSION['error'] = 'not_signed_in';
}
else if (!$workout_allowed && !$error)
{	$_SESSION['error'] = 'workout_not_allowed';
}

if ($_SESSION['error'] && !$error)
{	reload();
}

if (!$error)
{
?>

		<div class='container row text-center'>
			<h1><?php echo $workout_title ?></h1>

<?php
	if (!empty($workout_description))
	{
?>

			<h1><small><?php echo $workout_description ?></small></h1>

<?php
	}
?>

			<hr>
		</div>

		<div class='container row'>

<?php
	require $_SERVER['DOCUMENT_ROOT'] . $PARSEDOWN_LOCATION;

	echo (new Parsedown())->text($workout_body);
?>

			<br>
			<h4 class='text-center'><small>Published <?php echo date('l, F j, Y', strtotime($workout_date)) ?> in <a href='workouts?tag=<?php echo $workout_category ?>'><span class='badge'><?php echo $workout_category ?></span></a>

<?php
	if (!empty($workout_source))
	{
?>

			<br>Source: <a href='<?php echo $workout_source; ?>'><?php echo $workout_source ?></a>

<?php
	}
?>

			</small></h4>
		</div>

<?php
}

require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';

// EOF: workout.php
