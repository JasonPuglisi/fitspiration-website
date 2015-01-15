<?php
$current_date = date('Y-m-d');

$stmt = $db->prepare('SELECT title, date, body FROM wods WHERE date=:date LIMIT 1');
$stmt->execute(array(
	':date'=>$current_date
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
