<div class='container row text-center'>
	<div class='col-sm-6 col-md-4'>
		<h2><i class='fa fa-newspaper-o'></i> Articles</h2>
		<hr>

<?php
if ($articles)
{	foreach ($articles as $article)
	{	$days_ago_string = get_days_ago_string($article['date']);
?>

		<h4><a href='article?id=<?php echo $article['id'] ?>'><?php echo $article['title'] ?></a></h4>
		<p>Published <?php echo $days_ago_string ?></p>
		<br>

<?php
	}
?>

		<p><a class='btn btn-default' href='articles'>View all</a></p>
		<br>

<?php
}
else
{
?>

		<br>
		<p><?php echo $ERROR_MESSAGE['no_articles'] ?></p>

<?php
}
?>

	</div>

	<div class='col-sm-6 col-md-4'>
		<h2><i class='fa fa-cutlery'></i> Recipes</h2>
		<hr>

<?php
if ($recipes)
{	foreach ($recipes as $recipe)
	{	$days_ago_string = get_days_ago_string($recipe['date']);
?>

		<h4><a href='recipe?id=<?php echo $recipe['id'] ?>'><?php echo $recipe['title'] ?></a></h4>
		<p>Published <?php echo $days_ago_string ?></p>
		<br>

<?php
	}
?>

		<p><a class='btn btn-default' href='recipes'>View all</a></p>
		<br>

<?php
}
else
{
?>

		<br>
		<p><?php echo $ERROR_MESSAGE['no_recipes'] ?></p>

<?php
}
?>

	</div>

	<div class='col-sm-6 col-md-4'>
		<h2><i class='fa fa-child'></i> Workouts</h2>
		<hr>

<?php
if ($workouts)
{	foreach ($workouts as $workout)
	{	$days_ago_string = get_days_ago_string($workout['date']);
?>

		<h4><a href='workout?id=<?php echo $workout['id'] ?>'><?php echo $workout['title'] ?></a></h4>
		<p>Published <?php echo $days_ago_string ?></p>
		<br>

<?php
	}
?>

		<p><a class='btn btn-default' href='workouts'>View all</a></p>
		<br>

<?php
}
else
{
?>

		<br>
		<p><?php echo $ERROR_MESSAGE['no_workouts'] ?></p>

<?php
}
?>

	</div>
</div>
