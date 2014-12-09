<?php
if (isset($_POST['logout']) && $_POST['logout'])
{	setcookie('session', '', time() - 3600, '/', 'www.findanewmax.com');

	reload();
}

// EOF: logout.php
