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

		<a id='summary'></a>
		<div class='container row text-center'>
			<div class='col-md-6'>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/account-summary-section.php';
?>

			</div>
			<div class='col-md-6'>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/releases-summary-section.php';
?>

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

		<a id='releases'></a>
		<div class='container row text-center'>
			<h1>Need something to read?</h2>
			<br>
		</div>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/releases-row.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/reddit-row.php';
}
else
{
?>

		<a id='login'></a>
		<div class='container row text-center'>
			<h1>Get started</h1>
			<p>Whether you have an account already or not, simply enter your email address and password to start using FITspiration!</p>
			
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
			<br>
			<hr>
		</div>

		<a id='packages'></a>
		<div class='container row text-center'>
			<h1>Packages</h1>
			<p>Ready to find your new max? Register or sign in to select one of the following packages.</p>
		</div>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/packages-row.php';
?>

		<div class='container row text-center'>
			<br>
			<hr>
		</div>

		<a id='about'></a>
		<div class='container row text-center'>
			<h1>About us</h1>
			<p>What makes the FITspiration experience a unique one? Take a moment to find out.</p>
			<br>
		</div>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/insert/company-description-row.php';
?>

	</div>
</div>

<?php
}

require $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

// EOF: index.php
