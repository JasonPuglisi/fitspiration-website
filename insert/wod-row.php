<?php
$stmt = $db->prepare('SELECT count(*) FROM wods');
$stmt->execute();
$wods = $stmt->fetch(PDO::FETCH_NUM)[0];
$day = time() / (60 * 60 * 24);
$id = $day % $wods + 1;

$stmt = $db->prepare('SELECT title, date, body FROM wods WHERE id=:id LIMIT 1');
$stmt->execute(array(
	':id'=>$id
));
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class='container row text-center'>

<?php
if ($results)
{	$wod_title = $results[0]['title'];
	$wod_date = $results[0]['date'];
	$wod_body = $results[0]['body'];

	require_once $_SERVER['DOCUMENT_ROOT'] . $PARSEDOWN_LOCATION;
	$wod_body_parsed = (new Parsedown())->text($wod_body);
?>

	<h2><i class='fa fa-calendar'></i> <?php echo $wod_title ?></h2>

<?php
	echo $wod_body_parsed;
}
else
{
?>

	<br>
	<p><?php echo $ERROR_MESSAGE['no_wod'] ?></p>

<?php
}
?>

</div>
