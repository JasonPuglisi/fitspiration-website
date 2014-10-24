<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>

	<div class='jumbotron'>
		<div class='container text-center'>
			<img class='img-logo' src='/img/logo.svg' width='20%' alt='Logo'>
		</div>
	</div>

	<?php if ($signed_in) { ?>

	<a id='account'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1>Dashboard<br><small>Your account is <span class='account-<?php echo strtolower($account_level); ?>'><?php echo $account_level; ?> <i class='fa fa-trophy'></i></span></small></h1>
		</div>
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

			<?php if (isset($password_valid) && !$password_valid) { ?>

			<div class='alert alert-danger' role='alert'>Your password is incorrect. Please try again or <a href='mailto:contact@findanewmax.com' class='alert-link'>email us</a> for assistance.</div>

			<?php } else if (isset($password_too_short) && $password_too_short) { ?>

			<div class='alert alert-danger' role='alert'>Your password is too short. Please use at least eight characters.</div>

			<?php } ?>

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
			<div class='col-md-3'>
				<h3 class='account-basic'>Basic<small> Free</small></h3>
				<h4>Access to:</h4>
				<p>Recipe previews</p>
				<p>Exercise previews</p>
				<p>Workout and yoga video previews</p>
			</div>
			<div class='col-md-3'>
				<h3 class='account-bronze'>Bronze<small> TBD</small></h3>
				<h4>Access to:</h4>
				<p>Fitness tracking</p>
				<p>Quick meal recipes</p>
				<p>Exercise information</p>
				<p>Health articles</p>
				<h4>Accessory:</h4>
				<p>Wristband with pedometer and calorie tracker</p>
			</div>
			<div class='col-md-3'>
				<h3 class='account-silver'>Silver<small> TBD</small></h3>
				<h4>Access to:</h4>
				<p>Breakfast, lunch, and dinner recipes</p>
				<p>Dietary recommendations</p>
				<p>Exercise plans and challenges</p>
				<p>Discussion forum</p>
				<h4>Accessory:</h4>
				<p>Wristband with pedometer and calorie tracker</p>
			</div>
			<div class='col-md-3'>
				<h3 class='account-gold'>Gold<small> TBD</small></h3>
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
