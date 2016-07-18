<?php 
//include the header 
include_once './resources/header.php';
if(is_user_logged_in()!= FALSE){ 


	$userService = new userService();
	$logger = new logger('User page loaded','info',null);
	$logger->save_log();
?>

<div class='header_wrapper'>
	<div class='header_inner'>
		<h1>Welcome <?php echo ucfirst(get_username($_SESSION['user_id'])); ?>!</h1>
	</div>
</div>

	<div class='main_wrapper'>
		
		<div class='main_tower'>
			<div class='tower_statbox'>
				<h2>Your Stats</h2>
				<h2>Heroes</h2>
					<ul>
						<h3>Most Wins</h3>
						<li>Most Votes</li>
						<li>Last Created</li>
						<li>Total Heroes</li>
					</ul>				
				<h2>Battles</h2>
					<ul>
						<h3>Battles</h3>
						<li>Won</li>
						<li>Lost</li>
						<li>Longest Round</li>
						<ul>
							<li>Hero</li>
							<li>Opponent</li>
							<li>Winner</li>
							<li>Click to view this battle!</li>
						</ul>
						<li>as an Opponent</li>
						<ul>
							<li>Won</li>
							<li>Lost</li>														
						</ul>					
					</ul>
				
			</div>
		</div>
	<div class='main_inner'>
		
	</div>

</div>

<?php 
}
//include the footer
include_once './resources/footer.php'; 
?>
