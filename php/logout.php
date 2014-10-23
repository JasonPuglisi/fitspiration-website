<?php
	if (isset($_POST['logout']) && $_POST['logout']) {
		setcookie('session', '', time() - 3600, '/');

		header('Location: ' . preg_replace('/\.php|index\.php/', '', $_SERVER['PHP_SELF']));
	}
?>
