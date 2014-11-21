<?php
require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php';

if ($signed_in)
{
?>

		<a id='dashboard'></a>
		<div class='container row text-center'>
			<h1>Dashboard<br><small>Your account is <span class='account-<?php echo strtolower($account_level) ?>'><?php echo $account_level ?> <i class='fa fa-trophy'></i></span></small></h1>
			<p><a class='btn btn-default btn-sm' href='/account'>Update account</a></p>
			<hr>
		</div>

		<a id='resources'></a>
		<div class='container row text-center'>
			<h1>Resources <i class='fa fa-compass'></i></h1>
			<p>Check out our most recent articles, workouts, and recipes below. Be sure to visit often so you don't miss anything!</p>
		</div>
		<div class='container row text-center'>
			<div class='col-sm-6 col-md-4'>
				<h3><i class='fa fa-newspaper-o fa-5x'></i></h3>
				<h2>Recent articles</h2>

<?php
	$stmt = $db->prepare('SELECT id, level, title, date FROM articles WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 3');
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{	foreach ($results as $article)
		{	$days_ago_string = get_days_ago_string($article['date']);
?>

				<br>
				<h4><a href='article?id=<?php echo $article['id'] ?>'><?php echo $article['title'] ?></a></h4>
				<p>Published <?php echo $days_ago_string ?></p>

<?php
		}
?>

				<br>
				<p><a class='btn btn-default' href='articles'>View all</a></p>

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
				<h3><i class='fa fa-cutlery fa-5x'></i></h3>
				<h2>Recent recipes</h2>

<?php
	$stmt = $db->prepare('SELECT id, level, title, date FROM recipes WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 3');
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{	foreach ($results as $recipe)
		{	$days_ago_string = get_days_ago_string($recipe['date']);
?>

				<br>
				<h4><a href='recipe?id=<?php echo $recipe['id'] ?>'><?php echo $recipe['title'] ?></a></h4>
				<p>Published <?php echo $days_ago_string ?></p>

<?php
		}
?>

				<br>
				<p><a class='btn btn-default' href='recipes'>View all</a></p>

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
				<h3><i class='fa fa-child fa-5x'></i></h3>
				<h2>Recent workouts</h2>

<?php
	$stmt = $db->prepare('SELECT id, level, title, date FROM workouts WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 3');
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{	foreach ($results as $workout)
		{	$days_ago_string = get_days_ago_string($workout['date']);
?>

				<br>
				<h4><a href='workout?id=<?php echo $workout['id'] ?>'><?php echo $workout['title'] ?></a></h4>
				<p>Published <?php echo $days_ago_string ?></p>

<?php
		}
?>

				<br>
				<p><a class='btn btn-default' href='workouts'>View all</a></p>

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
	if (!isset($_COOKIE['demo']) && array_search('Diamond', $account_levels_inherited) !== false)
	{	$reddit_link_source = $REDDIT_SUBREDDIT;
?>

		<div class='container row text-center'>
			<hr>
		</div>

		<a id='<?php echo $reddit_link_source ?>'></a>
		<div class='container row text-center'>
			<h1><a href='https://www.reddit.com/r/<?php echo $reddit_link_source ?>'><?php echo $reddit_link_source ?></a></h1>
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

		<a id='fitspiration'></a>
		<div class='container row text-center'>
			<h1>FITspiration.<br><small>Find a new max. <i class='fa fa-level-up'></i></small></h1>
			<hr>
		</div>

		<a id='start'></a>
		<div class='container row text-center'>
			<h1>Get started <i class='fa fa-flag-checkered'></i></h1>
			<p>On your mark, get set, go! Let's find a healthy lifestyle that fits you.</p>
			<br>
			<form class='form-inline' method='post' role='form'>
				<div class='form-group'>
					<label class='sr-only' for='emailInput'>Email</label>
					<div class='input-group'>
						<div class='input-group-addon'>Email</div>
						<input type='email' class='form-control' id='emailInput' name='email' placeholder='Your email'>
					</div>
				</div>
				<div class='form-group'>
					<label class='sr-only' for='passwordInput'>Password</label>
					<div class='input-group'>
						<div class='input-group-addon'>Password</div>
						<input type='password' class='form-control' id='passwordInput' name='password' placeholder='Your password'>
					</div>
				</div>
				<button type='submit' class='btn btn-primary'>Register or sign in</button>
			</form>
			<br>
			<hr>
		</div>

		<a id='plans'></a>
		<div class='container row text-center'>
			<h1>Plans <i class='fa fa-bar-chart'></i></h1>
			<p>Check out what's waiting for you when you activate your account!</p>
		</div>
		<div class='container row text-center'>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-basic'>Basic<small> <?php echo $LEVEL_PRICES['Basic'] ?></small></h3>
				<h4>Access to:</h4>
				<p>Recipe previews</p>
				<p>Exercise previews</p>
				<p>Workout and yoga video previews</p>
			</div>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-bronze'>Bronze<small> $<?php echo $LEVEL_PRICES['Bronze'] ?>/yr</small></h3>
				<h4>Access to:</h4>
				<p>Fitness tracking</p>
				<p>Quick meal recipes</p>
				<p>Exercise information</p>
				<p>Health articles</p>
				<h4>Accessory:</h4>
				<p>Infinity Band with pedometer and calorie tracker</p>
			</div>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-silver'>Silver<small> $<?php echo $LEVEL_PRICES['Silver'] ?>/yr</small></h3>
				<h4>Access to:</h4>
				<p>Breakfast, lunch, and dinner recipes</p>
				<p>Dietary recommendations</p>
				<p>Exercise plans and challenges</p>
				<p>Discussion forum</p>
				<h4>Accessory:</h4>
				<p>Infinity Band with pedometer and calorie tracker</p>
			</div>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-gold'>Gold<small> $<?php echo $LEVEL_PRICES['Gold'] ?>/yr</small></h3>
				<h4>Access to:</h4>
				<p>Snack and dessert recipes</p>
				<p>Workout and yoga videos</p>
				<p>Custom dietary recommendations</p>
				<p>Custom exercise plans and challenges</p>
				<p>Custom grocery lists and restaurant recommendations</p>
				<h4>Accessory:</h4>
				<p>Infinity Watch with fitness tracking capabilities</p>
			</div>
		</div>
		<div class='container row text-center'>
			<hr>
		</div>

		<a id='benefits'></a>
		<div class='container row text-center'>
			<h1>Benefits <i class='fa fa-star'></i></h1>
			<p>What does a FITspiration account help you accomplish? Below are some examples, but the possibilities are endless!</p>
		</div>
		<div class='container row text-center'>
			<div class='col-sm-6 col-md-4'>
				<h3><i class='fa fa-child fa-5x'></i></h3>
				<h3>Stay active.</h3>
				<p>Follow effective workout plans, face exciting challenges, and meet outstanding goals. Keep track your activities and share your experiences with others to motivate yourself and those around you.</p>
			</div>
			<div class='col-sm-6 col-md-4'>
				<h3><i class='fa fa-leaf fa-5x'></i></h3>
				<h3>Stay healthy.</h3>
				<p>Try nutritious recipes, improve your lifestyle, and find a health plan that fits your needs perfectly. Discuss diets and meals with others, and share what works for you and what doesn't.</p>
			</div>
			<div class='col-sm-6 col-md-4'>
				<h3><i class='fa fa-wifi fa-5x'></i></h3>
				<h3>Stay connected.</h3>
				<p>Discover new facts every week, learn more about staying fit, and motivate yourself to live a healthy lifestyle. Use your FITspiration Infinity Band or Infinity Watch to get insights into your health and more.</p>
			</div>
		</div>

<?php
}

require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';

// EOF: index.php
