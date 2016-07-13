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

	<div class='main_wrapper'>
		<li>
		<div class='main_tower'>
			<div class='tower_statbox'>
				<h2>Site Stats</h2>
				<p>
					<ul>
						<li>Users</li>
						<li>Users Registered</li>
						<li>Today</li>
						<li>This Week</li>
						<li>This Month</li>
						<li>Logins</li>
						<li>Users Online</li>
						<li>Logged in </li>
						<li>Today</li>
						<li>Last 5 days</li>
						<li>Last 2 weeks</li>
						<li>Last Month</li>
						<li>All time</li>
						<li>Avg Daily p/Month</li>
					</ul>
				</p>
				<h2>Heroes</h2>
					<ul>
						<li>Heroes Created</li>
						<li>Today</li>
						<li>Last 5 days</li>
						<li>Last 2 weeks</li>
						<li>Last Month</li>
						<li>All time</li>
						<li>Avg per User</li>
					</ul>
				<p>
				</p>
				<h2>Battles</h2>
					<ul>
						<li>Battles</li>
						<li>Today</li>
						<li>Last 5 days</li>
						<li>Last 2 weeks</li>
						<li>Last Month</li>
						<li>All time</li>
						<li>Avg per User</li>					
					</ul>
				<p>		
				</p>
				<h2>Votes and Comments</h2>
					<ul>
						<li>Votes</li>
						<li>Today (up/down)</li>
						<li>Last 5 days (up/down)</li>
						<li>Last 2 weeks (up/down)</li>
						<li>Last Month (up/down)</li>
						<li>All time (up/down)</li>
						<li>Avg per User (up/down)</li>
						<li>Top Wins (up/down)</li>
						<li>Top Votes (up/down)</li>
						<li>Lowest Wins (up/down)</li>
						<li>Lowest Votes (up/down)</li>
						<li>Comments</li>
						<li>Today</li>
						<li>Last 5 days</li>
						<li>Last 2 weeks</li>
						<li>Last Month</li>
						<li>All time</li>
						<li>Avg per User</li>
					</ul>
				<p>		
				</p>
			</div>
		</div>
	<div class='main_inner'>
		<?php include './resources/new_post.php'; ?>
	</div>

</div>

<?php 
}
//include the footer
include_once './resources/footer.php'; 
?>
