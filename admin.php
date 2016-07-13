<?php 
//include the header 
include_once './resources/header.php';
if(is_user_logged_in()!= FALSE){ 
?>

<div class='header_wrapper'>
	<div class='header_inner'>
		<h1>Admin Panel</h1>
	</div>
</div>

	<div class='main_tower'>
		<h2>Site Stats</h2>
		<p>
		<!--user stats/battle engine usage -->
		</p>
		<h2>Current Users Online</h2>
		<p>
		
		</p>	
	</div>
	<div class='main_wrapper'>
	<div class='main_inner'>
		<?php include './resources/new_post.php'; ?>
	</div>

</div>

<?php 
}
//include the footer
include_once './resources/footer.php'; 
?>
