<div class='container row text-center'>
	<div class='col-sm-6 col-md-4'>
		<h3><i class='fa fa-trophy fa-2x account-bronze'></i></h3>
		<h3 class='account-bronze'>Bronze<small> $<?php echo $LEVEL_PRICES['Bronze'] ?>/yr</small></h3>

<?php
if ($signed_in)
{
?>

		<form role='form' method='post'>
			<button type='submit' class='btn btn-default' name='level' value='Bronze'>Purchase for $<?php echo $LEVEL_PRICES['Bronze'] ?></button>
		</form>
		<br>

<?php
}
?>

		<p>Fitness tracking</p>
		<p>Quick meal recipes</p>
		<p>Exercise information</p>
		<p>Health articles</p>
		<p>Infinity Band with pedometer and calorie tracker</p>
	</div>
	<div class='col-sm-6 col-md-4'>
		<h3><i class='fa fa-trophy fa-2x account-silver'></i></h3>
		<h3 class='account-silver'>Silver<small> $<?php echo $LEVEL_PRICES['Silver'] ?>/yr</small></h3>

<?php
if ($signed_in)
{
?>

		<form role='form' method='post'>
			<button type='submit' class='btn btn-default' name='level' value='Silver'>Purchase for $<?php echo $LEVEL_PRICES['Silver'] ?></button>
		</form>
		<br>

<?php
}
?>

		<p>Breakfast, lunch, and dinner recipes</p>
		<p>Dietary recommendations</p>
		<p>Exercise plans and challenges</p>
		<p>Discussion forum</p>
		<p>Infinity Band with pedometer and calorie tracker</p>
	</div>
	<div class='col-sm-6 col-md-4'>
		<h3><i class='fa fa-trophy fa-2x account-gold'></i></h3>
		<h3 class='account-gold'>Gold<small> $<?php echo $LEVEL_PRICES['Gold'] ?>/yr</small></h3>

<?php
if ($signed_in)
{
?>

		<form role='form' method='post'>
			<button type='submit' class='btn btn-default' name='level' value='Gold'>Purchase for $<?php echo $LEVEL_PRICES['Gold'] ?></button>
		</form>
		<br>

<?php
}
?>

		<p>Snack and dessert recipes</p>
		<p>Workout and yoga videos</p>
		<p>Custom dietary recommendations</p>
		<p>Custom exercise plans and challenges</p>
		<p>Custom grocery lists and restaurant recommendations</p>
		<p>Infinity Watch with fitness tracking capabilities</p>
	</div>
</div>
