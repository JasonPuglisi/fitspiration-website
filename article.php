<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php';

	if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
		$stmt = $db->prepare('SELECT level, title, date, source, body, image, description, category FROM articles WHERE id=:id LIMIT 1');
		$stmt->execute(array(
			':id'=>$_GET['id']
		));
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if ($results) {
			$article_level = $results[0]['level'];
			$article_title = $results[0]['title'];
			$article_date = $results[0]['date'];
			$article_source = $results[0]['source'];
			$article_body = $results[0]['body'];
			$article_image = $results[0]['image'];
			$article_description = $results[0]['description'];
			$article_category = $results[0]['category'];

			$article_valid = true;
			$article_allowed = array_search($article_level, $account_levels_inherited) !== false;
		}
	}

	if (!$article_valid) {
		$error = $ERROR_MESSAGE['article_invalid'];
	}

	else if (!$signed_in) {
		$error = $ERROR_MESSAGE['not_signed_in'];
	}

	else if (!$article_allowed) {
		$error = preg_replace('/%LEVEL%/', $article_level, $ERROR_MESSAGE['article_not_allowed']);
	}

	if (!$error) {
?>

	<div class='container'>
		<div class='row text-center'>
			<h1><?php echo $article_title; ?></h1>
			<?php if ($article_description) echo '<h1><small>', $article_description, '</small></h1>'; ?>
		</div>
		<hr>
		<div class='row'>
			<?php echo $article_body; ?>
			<br>
			<h4 class='text-center'><small>Published <?php echo date('l, F j, Y', strtotime($article_date)); ?> in <span class='badge'><?php echo $article_category; ?></span>

			<?php if ($article_source) { ?>

			<br>Source: <a href='<?php echo $article_source; ?>'><?php echo $article_source; ?></a>

			<?php } ?>

			</small></h4>
		</div>
	</div>

	<?php } else  { ?>

	<a id='error'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1><?php echo $ERROR_MESSAGE['default']; ?></h1>
			<h3><?php echo $error; ?></h3>
		</div>
	</div>

	<?php
		}

		require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';
	?>
