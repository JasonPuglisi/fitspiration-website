<?php
require $_SERVER['DOCUMENT_ROOT'] . '/template/header.php';

if ($signed_in)
{
?>

		<a id='welcome'></a>
		<div class='container row text-center'>
			<h1>Welcome<?php if ($account_name) echo ', ', $account_name ?>!</h1>
			<hr>
		</div>

<?php
	$account_progress = 100;
	$account_progress_steps = [];

	if ($account_level === 'Basic')
	{
		$account_progress -= 25;
		$account_progress_steps[] = '<a href=\'/account#account\'>Upgrade to a higher level for the full experience</a>';
?>

		<a id='warning'></a>
		<div class='container row text-center alert alert-danger'>
			<h1><i class='fa fa-exclamation-triangle fa-2x'></i></h1>
			<h1>Account Warning</h1>
			<p>You only have a basic account, so you'll be missing out on articles, recipes, workouts, videos, and more! Please <a class='alert-link' href='/account'>upgrade your account</a> to Bronze, Silver, or Gold as soon as possible for the full FITspiration experience! On your account page, you'll be able to upgrade your account and have a receipt sent to your email instantly.</p>
		</div>
		<hr>

<?php
	}

	if (!$account_name)
	{	$account_progress -= 25;
		$account_progress_steps[] = '<a href=\'/account\'>Tell us your name so we can greet you more easily</a>';
	}

	if (!$account_company)
	{	$account_progress -= 25;
		$account_progress_steps[] = '<a href=\'/account\'>Let us know where you work so we can learn about your company</a>';
	}

	if (!$account_address)
	{	$account_progress -= 25;
		$account_progress_steps[] = '<a href=\'/account\'>Save your address so we can ship your order straight to you</a>';
	}

	$account_progress_steps[] = 'Check out our latest <a href=\'/articles\'>articles</a>, <a href=\'/recipes\'>recipes</a>, <a href=\'/workouts\'>workouts</a>, and <a href=\'/videos\'>videos</a>'
?>

		<div class='container row text-center'>
			<a id='account'></a>
			<div class='col-md-6'>
				<h2><i class='fa fa-user'></i> Your account</h2>
				<h3 class='account-<?php echo strtolower($account_level) ?>'><?php echo $account_level ?></h3>
				<p><a class='btn btn-default btn-sm' href='/account'>Update account</a></p>
<?php
	if ($account_progress !== 100)
	{
?>
				<br>
				<div class='progress'>
					<div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='<?php echo $account_progress ?>' aria-valuemix='0' aria-valuemax='100' style='width: <?php echo $account_progress ?>%'></div>
				</div>
				<h3>Your account is <?php echo $account_progress ?>% complete!</h3>
<?php
	}
?>
				<hr>
				<h4>What's next?</h4>

<?php
	foreach ($account_progress_steps as $account_progress_step)
	{
?>

				<p><i class='fa fa-check'></i> <?php echo $account_progress_step ?></p>

<?php
	}
?>

			</div>

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

			<a id='latest'></a>
			<div class='col-md-6'>
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
			</div>
		</div>
		<hr>

		<a id='wod'></a>
		<div class='container row text-center'>
			<h1>Workout of the day</h1>
			<p>Looking for something to achieve today? We've got you covered. Check back daily for new workouts and challenges!</p>
		</div>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/wod-row.php';
?>

		<div class='container row text-center'>
			<br>
			<hr>
		</div>

		<a id='resources'></a>
		<div class='container row text-center'>
			<h1>Need something to read?</h2>
			<br>
		</div>
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

<?php
	if (array_search('Diamond', $account_levels_inherited) !== false)
	{	$reddit_link_source = $REDDIT_SUBREDDIT;
?>

		<div class='container row text-center'>
			<hr>
		</div>

		<a id='<?php echo $reddit_link_source ?>'></a>
		<div class='container row text-center'>
			<h1><a href='https://www.reddit.com/r/<?php echo $reddit_link_source ?>'><i class='fa fa-reddit'></i> <?php echo $reddit_link_source ?></a></h1>
			<br>

<?php
		$reddit_link = 'http://www.reddit.com/r/' . $reddit_link_source . '/hot.json?limit=32';
		$reddit_data = json_decode(file_get_contents($reddit_link));

		$reddit_item_count = 0;

		foreach ($reddit_data->data->children as $reddit_item)
		{	if ($reddit_item_count < 16 && $reddit_item->data->domain === 'i.imgur.com')
			{	if ($reddit_item_count >= 1 && $reddit_item_count % 4 === 0)
				{
?>

		</div>
		<br>
		<div class='container row text-center'>

<?php
				}

				$reddit_item_link = preg_replace('/http:/', 'https:', $reddit_item->data->url);
				$reddit_item_permalink = 'https://www.reddit.com' . $reddit_item->data->permalink;
				$reddit_item_title = $reddit_item->data->title;
				$reddit_item_count++;
?>

			<div class='col-sm-3'>
				<div class='thumbnail'>
					<a href='<?php echo $reddit_item_link ?>'><img src='<?php echo $reddit_item_link ?>' class='img-responsive' alt='<?php echo $reddit_link_source ?> thumbnail'></a>
					<div class='caption'>
						<p><a href='<?php echo $reddit_item_permalink ?>'><?php echo $reddit_item_title ?></a></p>
					</div>
				</div>
			</div>

<?php
			}
		}
?>

		</div>

<?php
	}
}
else
{
?>

		<a id='login'></a>
		<div class='container row text-center'>
			<h1>Get started</h1>
			<p>Whether you have an account or not, just enter your email address and password to start using FITspiration!</p>
			
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/login-form-inline.php';
?>

			<br>
			<hr>
		</div>

		<a id='wod'></a>
		<div class='container row text-center'>
			<h1>Workout of the day</h1>
			<p>Looking for something to achieve today? We've got you covered. Check back daily for new workouts and challenges!</p>
		</div>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/wod-row.php';
?>

		<div class='container row text-center'>
			<br>
			<hr>
		</div>

		<a id='perks'></a>
		<div class='container row text-center'>
			<h1>Perks</h1>
			<p>What benefits are waiting for you on the other side? We'll name just a few.</p>
		</div>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/perks-row.php';
?>

		<div class='container row text-center'>
			<hr>
		</div>

		<a id='packages'></a>
		<div class='container row text-center'>
			<h1>Packages</h1>
			<p>Ready to find your new max? Once you register or sign in above, you'll be ready to upgrade your account to one of the options below.</p>
		</div>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/packages-row.php';
?>

	</div>
</div>

<?php
}

require $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

// EOF: index.php
