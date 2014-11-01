<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>

	<?php if ($signed_in) {
		$account_name = 'Your name';
		$account_company = 'Your company';
		$account_address = 'Your address';

		$stmt = $db->prepare('SELECT level, name, company, address FROM accounts WHERE session_id=:session_id LIMIT 1');
		$stmt->execute(array(
			':session_id'=>$account_session_id
		));
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if ($results) {
			if ($results[0]['name'])
				$account_name = $results[0]['name'];
			if ($results[0]['company'])
				$account_company = $results[0]['company'];
			if ($results[0]['address'])
				$account_address = $results[0]['address'];
		}

		if (isset($_POST['name']) && strlen($_POST['name']) > 1 && strlen($_POST['name']) < 101) {
			$update_name = $_POST['name'];

			$stmt = $db->prepare('UPDATE accounts SET name=:name WHERE session_id=:session_id');
			$stmt->execute(array(
				':name'=>$update_name,
				':session_id'=>$account_session_id
			));

			$account_name = $update_name;
		}

		if (isset($_POST['company']) && strlen($_POST['company']) > 1 && strlen($_POST['company']) < 50) {
			$update_company = $_POST['company'];

			$stmt = $db->prepare('UPDATE accounts SET company=:company WHERE session_id=:session_id');
			$stmt->execute(array(
				':company'=>$update_company,
				':session_id'=>$account_session_id
			));

			$account_company = $update_company;
		}

		if (isset($_POST['address']) && strlen($_POST['address']) > 1 && strlen($_POST['address']) < 256) {
			$update_address = $_POST['address'];

			$stmt = $db->prepare('UPDATE accounts SET address=:address WHERE session_id=:session_id');
			$stmt->execute(array(
				':address'=>$update_address,
				':session_id'=>$account_session_id
			));

			$account_address = $update_address;
		}
	?>

	<div class='container'>

		<a id='account'></a>
		<div class='row text-center'>
			<h1>Account<br><small>Your account is <span class='account-<?php echo strtolower($account_level); ?>'><?php echo $account_level; ?> <i class='fa fa-trophy'></i></span></small></h1>
			<p>Before you modify your account, please fill out and verify your profile information. This lets up keep track of your orders!</p>
			<br>
			<form class='form-inline' method='post' role='form'>
				<div class='form-group'>
					<label class='sr-only' for='nameInput'>Name</label>
					<div class='input-group'>
						<div class='input-group-addon'>Name</div>
						<input type='text' class='form-control' id='nameInput' name='name' placeholder='<?php echo $account_name; ?>'>
					</div>
				</div>
				<div class='form-group'>
					<label class='sr-only' for='companyInput'>Company</label>
					<div class='input-group'>
						<div class='input-group-addon'>Company</div>
						<input type='text' class='form-control' id='companyInput' name='company' placeholder='<?php echo $account_company; ?>'>
					</div>
				</div>
				<div class='form-group'>
					<label class='sr-only' for='addressInput'>Address</label>
					<div class='input-group'>
						<div class='input-group-addon'>Address</div>
						<input type='text' class='form-control' id='addressInput' name='address' placeholder='<?php echo $account_address; ?>'>
					</div>
				</div>
				<button type='submit' class='btn btn-primary'>Update profile</button>
			</form>
		</div>
		<hr>

		<a id='levels'></a>
		<div class='row text-center'>
			<h1>Levels <i class='fa fa-bar-chart'></i></h1>
			<p>As soon as you select a level, your account will be updated. The price of each level is listed next to the name. Use your Virtual Enterprises International bank account to send a payment to FITspiration once you're done. Keep in mind that your purchase is non-refundable, and if you wish to change your level at a later date, you  must pay the full price.</p>
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

	</div>

	<?php } else
		$error = $ERROR_MESSAGE['not_signed_in'];

		if ($error) { ?>

	<a id='error'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1><?php echo $ERROR_MESSAGE['default']; ?></h1>
			<h3><?php echo $error; ?></h3>
		</div>
	</div>

	<?php } ?>

	<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?>
