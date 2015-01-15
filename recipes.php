<?php
require $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';

if (isset($_GET['tag']) && !empty($_GET['tag']) && strlen($_GET['tag']) <= 50)
{	$stmt = $db->prepare('SELECT id, title, date, description, category FROM recipes WHERE (level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\') AND category=:tag ORDER BY id DESC LIMIT 50');
	$stmt->execute(array(
		':tag'=>$_GET['tag']
	));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else
{	$stmt = $db->prepare('SELECT id, title, date, description, category FROM recipes WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 50');
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!$signed_in && !$error)
{	$_SESSION['error'] = 'not_signed_in';
}
else if (!$results && !$error)
{	$_SESSION['error'] = 'no_recipes';
}

if ($_SESSION['error'] && !$error)
{	reload();
}

if (!$error)
{
?>

		<a id='recipes'></a>
		<div class='container row text-center'>
			<h1><i class='fa fa-cutlery'></i> Recipes</h1>
			<p>Looking for something good to read? You're in the right place. Check out all of the recipes we've ever published, and come back often to stay up to date with our newest material!</p>
			<br>
		</div>
		<div class='container row text-center'>

<?php
	foreach ($results as $recipe)
	{
?>

			<div class='col-sm-6'>
				<h4><a href='/recipe?id=<?php echo $recipe['id'] ?>'><?php echo $recipe['title'] ?></a></h4>
				<p><?php echo $recipe['description'] ?></p>
				<p><small>Published <?php echo date('l, F j, Y', strtotime($recipe['date'])) ?> in <a href='recipes?tag=<?php echo $recipe['category'] ?>'><span class='badge'><?php echo $recipe['category'] ?></span></a></small></p>
				<br>
			</div>

<?php
	}
?>

		</div>

<?php
}

require $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

// EOF: recipes.php
