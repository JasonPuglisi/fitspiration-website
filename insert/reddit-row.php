<?php
if (array_search('Diamond', $account_levels_inherited) !== false)
{	$reddit_link_source = $REDDIT_SUBREDDIT;
?>

<div class='container row text-center'>
	<hr>
</div>

<a id='<?php echo $reddit_link_source ?>'></a>
<div class='container row text-center'>
	<h1><a href='https://www.reddit.com/r/<?php echo $reddit_link_source ?>'><i class='fa fa-reddit'></i> <?php echo $reddit_link_source ?></a></h1>
	<br>

<?php
	$reddit_link = 'http://www.reddit.com/r/' . $reddit_link_source . '/hot.json?limit=32';
	$reddit_data = json_decode(file_get_contents($reddit_link));

	$reddit_item_count = 0;

	foreach ($reddit_data->data->children as $reddit_item)
	{	if ($reddit_item_count < 16 && $reddit_item->data->domain === 'i.imgur.com')
		{	if ($reddit_item_count >= 1 && $reddit_item_count % 4 === 0)
			{
?>

</div>
<br>
<div class='container row text-center'>

<?php
			}

			$reddit_item_link = preg_replace('/http:/', 'https:', $reddit_item->data->url);
			$reddit_item_permalink = 'https://www.reddit.com' . $reddit_item->data->permalink;
			$reddit_item_title = $reddit_item->data->title;
			$reddit_item_count++;
?>

	<div class='col-sm-3'>
		<div class='thumbnail'>
			<a href='<?php echo $reddit_item_link ?>'><img src='<?php echo $reddit_item_link ?>' class='img-responsive' alt='<?php echo $reddit_link_source ?> thumbnail'></a>
			<div class='caption'>
				<p><a href='<?php echo $reddit_item_permalink ?>'><?php echo $reddit_item_title ?></a></p>
			</div>
		</div>
	</div>

<?php
		}
	}
?>

</div>

<?php
}

// EOF: reddit-row.php
