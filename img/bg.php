<?php
	$images = glob('bg/*');
	header('Location: ' . $images[array_rand($images)]);
?>
