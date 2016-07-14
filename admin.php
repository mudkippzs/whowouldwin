<?php 
//include the header 
include_once './resources/header.php';
if(is_user_logged_in()!= FALSE){ 


	$userService = new userService();
	$logger = new logger('Admin page loaded','info',null);
	$logger->save_log();
?>

<div class='header_wrapper'>
	<div class='header_inner'>
		<h1>Admin Panel</h1>
	</div>
</div>

	<div class='main_wrapper'>
		
		<div class='main_tower'>
			<div class='tower_statbox'>
				<h2>Site Stats</h2>
				<p>
					<ul>
						<h3>Users</h3>
						<strong>Users Registered</strong>
						<li>Today: <?php echo "<span>" . $userService->get_users_registered("-1 days") . "</span>"; ?>	</li>
						<li>Last 5 days: <?php echo "<span>" . $userService->get_users_registered("-5 days") . "</span>"; ?></li>
						<li>Last 30 days: <?php echo "<span>" . $userService->get_users_registered("-31 days") . "</span>"; ?></li>
						<li>All time: <?php echo "<span>" . $userService->get_users_registered("-10 years") . "</span>"; ?>	</li>
						<h3>Logins</h3>						
						<strong>Logged in </strong>
						<li>Today: <?php echo "<span>" . $userService->get_users_logged_in("-1 days") . "</span>"; ?>	</li>
						<li>Last 5 days: <?php echo "<span>" . $userService->get_users_logged_in("-5 days") . "</span>"; ?>	</li>						
						<li>Last 30 days: <?php echo "<span>" . $userService->get_users_logged_in("-31 days") . "</span>"; ?></li>				
						<li>Users Online<small>(last 30 minutes)</small>: <?php echo "<span>" . $userService->get_users_logged_in("-30 minutes") . "</span>"; ?></li></li>
					</ul>
				</p>
				<h2>Heroes</h2>
					<ul>
						<h3>Heroes Created</h3>
						<li>Today</li>
						<li>Last 5 days</li>
						<li>Last 30 days</li>
						<li>All time</li>
						<li>Avg per User</li>
					</ul>
				<p>
				</p>
				<h2>Battles</h2>
					<ul>
						<h3>Battles</h3>
						<li>Today</li>
						<li>Last 5 days</li>
						<li>Last 30 days</li>
						<li>All time</li>
						<li>Avg per User</li>					
					</ul>
				<p>		
				</p>
				<h2>Votes and Comments</h2>
					<ul>
						<h3>Votes</h3>
						<li>Today (up/down)</li>
						<li>Last 5 days (up/down)</li>
						<li>Last 30 days (up/down)</li>
						<li>All time (up/down)</li>
						<li>Avg number of votes (up/down)</li>
						<li>Top Wins (up/down)</li>
						<li>Top Votes (up/down)</li>
						<li>Lowest Wins (up/down)</li>
						<li>Lowest Votes (up/down)</li>
						<h3>Comments</h3>
						<li>Today</li>
						<li>Last 5 days</li>
						<li>Last 30 days</li>
						<li>All time</li>
						<li>Avg per User</li>
					</ul>
				<p>		
				</p>
			</div>
		</div>
	<div class='main_inner'>
		<?php include './resources/post_bin.php'; ?>
		<?php include './resources/new_post.php'; ?>
	</div>

</div>

<?php 
}
//include the footer
include_once './resources/footer.php'; 
?>
