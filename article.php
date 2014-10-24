<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/php/header.php';

	if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
		$stmt = $db->prepare('SELECT * FROM articles WHERE id=:id LIMIT 1');
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
?>

	<div class='jumbotron' <?php if ($article_image) echo 'style=\'background-image:url("' . $article_image .  '");\''; ?>>
		<div class='container text-center'>
			<img class='img-logo' src='/img/logo.svg' width='20%' alt='Logo'>
		</div>
	</div>

	<?php if ($signed_in && $article_valid && $article_allowed) { ?>

	<a id='article'></a>
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

	<?php } else if ($signed_in && $article_valid) { ?>

	<a id='error'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1>You're not allowed to view this article  <i class='fa fa-frown-o'></i></h1>
			<h3>This article is only available to <span class='account-<?php echo strtolower($article_level); ?>'><?php echo $article_level; ?></span> level subscribers. If you'd like, you can <a href='account'>upgrade your account</a> or <a href='/'>return to the home page</a>.</h3>
		</div>
	</div>

	<?php } else if ($signed_in) { ?>

	<a id='error'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1>This article doesn't exist  <i class='fa fa-frown-o'></i></h1>
			<h3>Make sure your link is correct and try again. If you'd like, you can <a href='/'>return to the home page</a>.</h3>
		</div>
	</div>

	<?php } else { ?>

	<a id='error'></a>
	<div class='container'>
		<div class='row text-center'>
			<h1>You're not signed in  <i class='fa fa-frown-o'></i></h1>
			<h3>For access to articles, please register or sign in on the <a href='/'>home page</a>.</h3>
		</div>
	</div>

	<?php } ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?>
