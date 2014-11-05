<?php
require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php';

if (isset($_GET['id']) && ctype_digit($_GET['id']))
{	$stmt = $db->prepare('SELECT level, title, date, source, body, image, description, category FROM recipes WHERE id=:id LIMIT 1');
	$stmt->execute(array(
		':id'=>$_GET['id']
	));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{	$recipe_level = $results[0]['level'];
		$recipe_title = $results[0]['title'];
		$recipe_date = $results[0]['date'];
		$recipe_source = $results[0]['source'];
		$recipe_body = $results[0]['body'];
		$recipe_image = $results[0]['image'];
		$recipe_description = $results[0]['description'];
		$recipe_category = $results[0]['category'];

		$recipe_valid = true;
		$recipe_allowed = array_search($recipe_level, $account_levels_inherited) !== false;
	}
}

if (!$recipe_valid && !$error)
{	$_SESSION['error'] = 'recipe_invalid';
}
else if (!$signed_in && !$error)
{	$_SESSION['error'] = 'not_signed_in';
}
else if (!$recipe_allowed && !$error)
{	$_SESSION['error'] = 'recipe_not_allowed';
}

if ($_SESSION['error'] && !$error)
{	reload();
}

if (!$error)
{
?>

		<a id='recipe'></a>
		<div class='container row text-center'>
			<h1><?php echo $recipe_title ?></h1>

<?php
	if (!empty($recipe_description))
	{
?>

			<h1><small><?php echo $recipe_description ?></small></h1>

<?php
	}
?>

			<hr>
		</div>

		<div class='container row'>

<?php
	require $_SERVER['DOCUMENT_ROOT'] . $PARSEDOWN_LOCATION;

	echo (new Parsedown())->text($recipe_body);
?>

			<br>
			<h4 class='text-center'><small>Published <?php echo date('l, F j, Y', strtotime($recipe_date)) ?> in <a href='recipes?tag=<?php echo $recipe_category ?>'><span class='badge'><?php echo $recipe_category ?></span></a>

<?php
	if (!empty($recipe_source))
	{
?>

			<br>Source: <a href='<?php echo $recipe_source; ?>'><?php echo $recipe_source ?></a>

<?php
	}
?>

			</small></h4>
		</div>

<?php
}

require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';

// EOF: recipe.php
