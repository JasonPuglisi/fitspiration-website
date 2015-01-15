<?php
if ($account_level === 'Basic')
{
	$account_progress -= 25;
	$account_progress_steps[] = '<a href=\'/account#account\'>Upgrade to a higher level for the full experience</a>';
?>

<div class='row text-center alert alert-danger'>
	<h2><i class='fa fa-exclamation-triangle'></i> Account Warning</h2>
	<p>You only have a basic account, so you'll be missing out on articles, recipes, workouts, videos, and more! Please <a class='alert-link' href='/account'>upgrade your account</a> to Bronze, Silver, or Gold as soon as possible for the full FITspiration experience! On your account page, you'll be able to upgrade your account and have a receipt sent to your email instantly.</p>
	<br>
</div>

<?php
}
?>

<h2><i class='fa fa-user'></i> Your account</h2>
<h3 class='account-<?php echo strtolower($account_level) ?>'><?php echo $account_level ?></h3>
<p><a class='btn btn-default btn-sm' href='/account'>Update account</a></p>

<?php
$account_progress = 100;
$account_progress_steps = [];

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

$account_progress_steps[] = 'Check out our latest <a href=\'/articles\'>articles</a>, <a href=\'/recipes\'>recipes</a>, <a href=\'/workouts\'>workouts</a>, and <a href=\'/videos\'>videos</a>';

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

// EOF: account-summary-section.php
