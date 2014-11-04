<?php
require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php';

if ($signed_in)
{	$account_name = 'Your name';
	$account_company = 'Your company';
	$account_address = 'Your address';

	$stmt = $db->prepare('SELECT level, name, company, address FROM accounts WHERE session_id=:session_id LIMIT 1');
	$stmt->execute(array(
		':session_id'=>$account_session_id
	));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{
		if ($results[0]['name'])
		{	$account_name = $results[0]['name'];
		}

		if ($results[0]['company'])
		{	$account_company = $results[0]['company'];
		}

		if ($results[0]['address'])
		{	$account_address = $results[0]['address'];
		}
	}

	if (isset($_POST['name']) && strlen($_POST['name']) >= 1 && strlen($_POST['name']) <= 100)
	{	$update_name = $_POST['name'];

		$stmt = $db->prepare('UPDATE accounts SET name=:name WHERE session_id=:session_id');
		$stmt->execute(array(
			':name'=>$update_name,
			':session_id'=>$account_session_id
		));

		$account_name = $update_name;
	}

	if (isset($_POST['company']) && strlen($_POST['company']) >= 1 && strlen($_POST['company']) <= 50)
	{	$update_company = $_POST['company'];

		$stmt = $db->prepare('UPDATE accounts SET company=:company WHERE session_id=:session_id');
		$stmt->execute(array(
			':company'=>$update_company,
			':session_id'=>$account_session_id
		));

		$account_company = $update_company;
	}

	if (isset($_POST['address']) && strlen($_POST['address']) >= 1 && strlen($_POST['address']) <= 255)
	{	$update_address = $_POST['address'];

		$stmt = $db->prepare('UPDATE accounts SET address=:address WHERE session_id=:session_id');
		$stmt->execute(array(
			':address'=>$update_address,
			':session_id'=>$account_session_id
		));

		$account_address = $update_address;
	}

	$profile_valid = $account_name !== 'Your name' && $account_company !== 'Your company' && $account_address !== 'Your address';

	if (isset($_POST['level']))
	{	if (!$profile_valid && !$error)
		{	$_SESSION['error'] = 'profile_incomplete';

			reload();
		}
		else
		{
?>

		<a id='updated'></a>
		<div class='container row text-center'>
			<h1>Account updated <i class='fa fa-level-up'></i></h1>
			<p>Your account has been updated!</p>

<?php
			if ($_POST['level'] !== 'Basic')
			{
?>

			<p>If you haven't already, please use your Virtual Enterprises International bank account to send a payment of $<?php echo $LEVEL_PRICES[$_POST['level']] ?>.00 to FITspiration. Please check your email inbox for a receipt!</p>

<?php
			}
			else
			{
?>

			<p>Your account has been set to basic. Please note that if you wish to upgrade your account, you must pay the full upgrade price.</p>

<?php
			}
?>

			<hr>
		</div>

<?php
		}
	}
?>

		<a id='account'></a>
		<div class='container row text-center'>
			<h1>Account<br><small>Your account is <span class='account-<?php echo strtolower($account_level) ?>'><?php echo $account_level ?> <i class='fa fa-trophy'></i></span></small></h1>

<?php
	if (!$profile_valid)
	{
?>

			<br>
			<div class='alert alert-warning' role='alert'>
				<p>Before you update your account, please fill out and verify your profile information. This lets us handle your order as fast as possible!</p>
			</div>

<?php
	}
?>

			<br>
			<form class='form-inline' method='post' role='form'>
				<div class='form-group'>
					<label class='sr-only' for='nameInput'>Name</label>
					<div class='input-group'>
						<div class='input-group-addon'>Name</div>
						<input type='text' class='form-control' id='nameInput' name='name' placeholder='<?php echo $account_name ?>'>
					</div>
				</div>
				<div class='form-group'>
					<label class='sr-only' for='companyInput'>Company</label>
					<div class='input-group'>
						<div class='input-group-addon'>Company</div>
						<input type='text' class='form-control' id='companyInput' name='company' placeholder='<?php echo $account_company ?>'>
					</div>
				</div>
				<div class='form-group'>
					<label class='sr-only' for='addressInput'>Address</label>
					<div class='input-group'>
						<div class='input-group-addon'>Address</div>
						<input type='text' class='form-control' id='addressInput' name='address' placeholder='<?php echo $account_address ?>'>
					</div>
				</div>
				<button type='submit' class='btn btn-primary'>Update profile</button>
			</form>
			<br>
			<hr>
		</div>

		<a id='levels'></a>
		<div class='container row text-center'>
			<h1>Levels <i class='fa fa-bar-chart'></i></h1>
			<p>Get ready for your new lifestyle with FITspiration! Once you select a level, find the price listed next to the name and use your Virtual Enterprises International bank account to send a payment to FITspiration. After that, your account will be updated and you'll be ready to use your account to its full potential!</p>
		</div>
		<div class='container row text-center'>
			<div class='col-sm-6 col-md-3'>
				<h3 class='account-basic'>Basic<small> <?php echo $LEVEL_PRICES['Basic'] ?></small></h3>
				<h4>Access to:</h4>
				<p>Recipe previews</p>
				<p>Exercise previews</p>
				<p>Workout and yoga video previews</p>
				<form role='form' method='post'>
					<button type='submit' class='btn btn-default' name='level' value='Basic'>Update account</button>
				</form>
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
				<form role='form' method='post'>
					<button type='submit' class='btn btn-default' name='level' value='Bronze'>Update account</button>
				</form>
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
				<form role='form' method='post'>
					<button type='submit' class='btn btn-default' name='level' value='Silver'>Update account</button>
				</form>
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
				<form role='form' method='post'>
					<button type='submit' class='btn btn-default' name='level' value='Gold'>Update account</button>
				</form>
			</div>
		</div>

<?php
}
else
{	if (!$error)
	{	$_SESSION['error'] = 'not_signed_in';

		reload();
	}
}

require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';

// EOF: account.php
