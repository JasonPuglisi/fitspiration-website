<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>

	<div class='jumbotron'>
		<div class='container text-center'>
			<img class='img-logo' src='/img/logo.svg' width='20%' alt='Logo'>
		</div>
	</div>

	<?php
		if ($signed_in) {
			if (isset($_POST['name']) && strlen($_POST['name']) < 101) $insert_name = $_POST['name'];
			else $name_valid = false;

			if (isset($_POST['company']) && strlen($_POST['company']) < 51) $insert_company = $_POST['company'];
			else $company_valid = false;

			if (isset($_POST['address']) && strlen($_POST['address']) < 256) $insert_address = $_POST['address'];
			else $address_valid = false;
		}
	?>

	<a id='account'></a>
	<div class='row text-center'>
		<h1>Dashboard<br><small>Your account is <span class='account-<?php echo strtolower($account_level); ?>'><?php echo $account_level; ?> <i class='fa fa-trophy'></i></span></small></h1>
	</div>

	<?php } else { ?>

	<a id='error'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1>You're not signed in  <i class='fa fa-frown-o'></i></h1>
			<h3>To view your account, please register or sign in on the <a href='/'>home page</a>.</h3>
		</div>
	</div>

	<?php } ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?>
