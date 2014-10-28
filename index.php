<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>

	<?php if ($signed_in) { ?>

	<a id='account'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1>Dashboard<br><small>Your account is <span class='account-<?php echo strtolower($account_level); ?>'><?php echo $account_level; ?> <i class='fa fa-trophy'></i></span></small></h1>
		</div>
		<div class='row text-center'>
			<div class='col-sm-6'>
				<h2>Articles:</h2>

				<?php
					$stmt = $db->prepare('SELECT id, level, title, date FROM articles WHERE level=\'' . implode('\' or level=\'', $account_levels_inherited) . '\' ORDER BY id DESC LIMIT 5');
					$stmt->execute();
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($results as $article) {
						$days_ago = date_diff(date_create(date('Y-m-d')), date_create($article['date']))->format('%a');
						$days_ago_string = $days_ago . ' days ago';

						switch (true) {
							case ($days_ago == 0):
								$days_ago_string = 'today <span class=\'badge\'>New!</span>';
							break;
							case ($days_ago == 1):
								$days_ago_string = 'yesterday';
							break;
							case ($days_ago == 7):
								$days_ago_string = 'a week ago';
							break;
							case ($days_ago > 7):
								$days_ago_string = date('l, F j, Y', strtotime($article['date']));
							break;
						}
				?>

				<br>
				<h4><a href='article?id=<?php echo $article['id']; ?>'><?php echo $article['title']; ?></a></h4>
				<p>Published <?php echo $days_ago_string; ?></p>

				<?php } ?>

			</div>
		</div>

		<?php
			if (!isset($_COOKIE['demo']) && array_search('Diamond', $account_levels_inherited) !== false) {
				$reddit_link_source = $REDDIT_SUBREDDIT;
		?>

		<hr>
		<a id='<?php echo $reddit_link_source; ?>'></a>
		<div class='row text-center'>
			<h1><a href='https://www.reddit.com/r/<?php echo $reddit_link_source; ?>'><?php echo $reddit_link_source; ?></a></h1>
			<br>

			<?php
				$reddit_link = 'http://www.reddit.com/r/' . $reddit_link_source . '/hot.json?limit=32';
				$reddit_data = json_decode(file_get_contents($reddit_link));

				$reddit_item_count = 0;

				foreach ($reddit_data->data->children as $reddit_item) {
					if ($reddit_item_count < 16 && $reddit_item->data->domain == 'i.imgur.com') {
						if ($reddit_item_count > 0 && $reddit_item_count % 4 == 0) {
			?>

		</div>
		<br>
		<div class='row text-center'>

			<?php
						}

						$reddit_item_link = preg_replace('/http:/', 'https:', $reddit_item->data->url);
						$reddit_item_permalink = 'https://www.reddit.com' . $reddit_item->data->permalink;
						$reddit_item_title = $reddit_item->data->title;
						$reddit_item_count++;
			?>

			<div class='col-xs-6 col-sm-3'>
				<div class='thumbnail'>
					<a href='<?php echo $reddit_item_link; ?>'><img src='<?php echo $reddit_item_link; ?>' class='img-responsive' alt='Image'></a>
					<div class='caption'>
						<p><a href='<?php echo $reddit_item_permalink; ?>'><?php echo $reddit_item_title; ?></p></a>
					</div>
				</div>
			</div>

			<?php
					}
				}
			?>

		</div>

		<?php } ?>

	</div>

	<?php } else { ?>

	<a id='fitspiration'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1><strong>FIT</strong>spiration.<br><small>Find a new max. <i class='fa fa-level-up'></i></small></h1>
		</div>
		<hr>
		<div class='row text-center'>
			<h2>On your mark, get set, go! <i class='fa fa-flag-checkered'></i></h2>
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
			<h4>Once you're logged in, you'll be able to choose one of the plans below for full access to FITspiration!</h4>
		</div>
		<div class='row text-center'>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-basic'>Basic<small> Free</small></h3>
				<h4>Access to:</h4>
				<p>Recipe previews</p>
				<p>Exercise previews</p>
				<p>Workout and yoga video previews</p>
			</div>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-bronze'>Bronze<small> $340/yr</small></h3>
				<h4>Access to:</h4>
				<p>Fitness tracking</p>
				<p>Quick meal recipes</p>
				<p>Exercise information</p>
				<p>Health articles</p>
				<h4>Accessory:</h4>
				<p>Wristband with pedometer and calorie tracker</p>
			</div>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-silver'>Silver<small> $520/yr</small></h3>
				<h4>Access to:</h4>
				<p>Breakfast, lunch, and dinner recipes</p>
				<p>Dietary recommendations</p>
				<p>Exercise plans and challenges</p>
				<p>Discussion forum</p>
				<h4>Accessory:</h4>
				<p>Wristband with pedometer and calorie tracker</p>
			</div>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-gold'>Gold<small> $875/yr</small></h3>
				<h4>Access to:</h4>
				<p>Snack and dessert recipes</p>
				<p>Workout and yoga videos</p>
				<p>Custom dietary recommendations</p>
				<p>Custom exercise plans and challenges</p>
				<p>Custom grocery lists and restaurant recommendations</p>
				<h4>Accessory:</h4>
				<p>Smart watch with fitness tracking capabilities</p>
			</div>
		</div>
		<hr>
		<div class='row text-center'>
			<div class='col-md-4'>
				<h3><i class='fa fa-child fa-5x'></i></h3>
				<h3>Stay active.</h3>
				<p>Follow effective workout plans, face exciting challenges, and meet outstanding goals. Log your activities and share your experiences with others to motivate yourself and those around you.</p>
			</div>
			<div class='col-md-4'>
				<h3><i class='fa fa-leaf fa-5x'></i></h3>
				<h3>Stay healthy.</h3>
				<p>Try nutritious recipes, improve your lifestyle, and find a health plan that fits your needs perfectly. Discuss diets and meals with others, and share what works for you and what doesn't.</p>
			</div>
			<div class='col-md-4'>
				<h3><i class='fa fa-wifi fa-5x'></i></h3>
				<h3>Stay connected.</h3>
				<p>Discover new recipes every week, learn more about staying fit, and motivate yourself to live a healthy lifestyle. Use your FITspiration Fitness Tracker to get insights into your health and more.</p>
			</div>
		</div>
		<hr>
	</div>

	<a id='staff'></a>
	<div class='container'>
		<div class='row text-center'>
			<h2>Meet our staff. <i class='fa fa-users'></i></h2>
			<br>
			<p>Our staff work hard to give you the personalized experience you need to help you live a healthy and active lifestyle. As a company, we dedicate ourselves fully to helping you create a positive lifestyle that will stay with you for the rest of your life.</p>
			<br>
		</div>
		<div class='row text-center'>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/michaelScott.png' alt='Michael Scott'>
				<h4><strong>Michael</strong><br>Scott<br><small>CEO</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/seanCook.png' alt='Sean Cook'>
				<h4><strong>Sean</strong><br>Cook<br><small>CIO</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/dianeGray.png' alt='Diane Gray'>
				<h4><strong>Diane</strong><br>Gray<br><small>COO</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/carolynEvans.png' alt='Carolyn Evans'>
				<h4><strong>Carolyn</strong><br>Evans<br><small>CFO</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/saraDiaz.png' alt='Sara Diaz'>
				<h4><strong>Sara</strong><br>Diaz<br><small>CMO</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/eugeneCampbell.png' alt='Eugene Campbell'>
				<h4><strong>Eugene</strong><br>Campbell<br><small>IT<br>Manager</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/joanWalker.png' alt='Joan Walker'>
				<h4><strong>Joan</strong><br>Walker<br><small>HR<br>Manager</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/christopherRogers.png' alt='Christopher Rogers'>
				<h4><strong>Christopher</strong><br>Rogers<br><small>Accounting<br>Manager</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/michelleCarter.png' alt='Michelle Carter'>
				<h4><strong>Michelle</strong><br>Carter<br><small>Marketing<br>Manager</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/joshuaBryant.png' alt='Joshua Bryant'>
				<h4><strong>Joshua</strong><br>Bryant<br><small>IT<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/stephanieJohnson.png' alt='Stephanie Johnson'>
				<h4><strong>Stephanie</strong><br>Johnson<br><small>IT<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/joseScott.png' alt='Jose Scott'>
				<h4><strong>Jose</strong><br>Scott<br><small>HR<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/cherylRoberts.png' alt='Cheryl Roberts'>
				<h4><strong>Cheryl</strong><br>Roberts<br><small>HR<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/kathrynLopez.png' alt='Kathryn Lopez'>
				<h4><strong>Kathryn</strong><br>Lopez<br><small>Accounting<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/annaGarcia.png' alt='Anna Garcia'>
				<h4><strong>Anna</strong><br>Garcia<br><small>Accounting<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/helenRobinson.png' alt='Helen Robinson'>
				<h4><strong>Helen</strong><br>Robinson<br><small>Accounting<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/pamelaNelson.png' alt='Pamela Nelson'>
				<h4><strong>Pamela</strong><br>Nelson<br><small>Marketing<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/judyPrice.png' alt='Judy Price'>
				<h4><strong>Judy</strong><br>Price<br><small>Marketing<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/davidLee.png' alt='David Lee'>
				<h4><strong>David</strong><br>Lee<br><small>Marketing<br>Analyst</small></h4>
			</div>
			<div class='col-xs-6 col-sm-2'>
				<img class='img-responsive img-circle' src='/img/staff/russellJohnson.png' alt='Russell Johnson'>
				<h4><strong>Russell</strong><br>Johnson<br><small>Marketing<br>Analyst</small></h4>
			</div>
		</div>
	</div>

	<?php } ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?>
