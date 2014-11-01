<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>

	<?php if ($signed_in) { ?>

	<a id='account'></a>
	<div class='row text-center'>
		<h1>Account<br><small>Your account is <span class='account-<?php echo strtolower($account_level); ?>'><?php echo $account_level; ?> <i class='fa fa-trophy'></i></span></small></h1>
	</div>

	<?php } else {
		$error = $ERROR_MESSAGE['not_signed_in'];
	?>

	<a id='error'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1><?php echo $ERROR_MESSAGE['default']; ?></h1>
			<h3><?php echo $error; ?></h3>
		</div>
	</div>

	<?php } ?>

	<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?>
