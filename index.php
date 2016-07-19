<?php 
//include the header 
include_once './resources/header.php'; 
?>

<div class='header_wrapper'>
	<div class='header_inner'>
		<div class='header_form_box'>
			<div class='header_login_box'>
				<?php 
				if(is_user_logged_in()!= TRUE){
					include_once './resources/login_form.php';
				}
				?>	
				<div class='header_forgot_password'>
					<?php include_once './resources/forgot_password.php';  ?>
				</div>
			</div>
			<div class='header_registration'>
				<?php 			
				if(is_user_logged_in()!= TRUE){				
					include_once './resources/registration_form.php'; 
				}
				?>				
			</div>
		</div>
	</div>
</div>
<div class='main_wrapper'>
	<div class='main_tower'>
	<h2>FAQ</h2>
	<ul>
		<li>When is the project going to be functional?</li>
		<ul><li>It is right now, its just not available. The initial versions of the project focused on prototyping the battle engine and hero system with basic user function integrated for proof of concept. v2 focused on the battle engine and the battle logic including the integration of powers and effects in the battle loop.</li></ul>
		<li>What's v3 about?</li>
		<ul><li>Tying together the new user system and the battle engine and hero system. I'll be taking the oppertunity to integrate new features and lay the ground work for future features in terms of code. But this version should enable a rolling update going forward and should result in much less DB wiping before release (with the exception of extreme reworks of certain parts of the battle system and analytics but hopefully it should be too hard to migrate any old data.</li></ul>
		<li>How can I leave my feedback, and will it really matter?</li>
		<ul><li><a href="http://docs.google.com/forms/d/1zKansQ13GHGvO9Pq6NBppFmz41FtlGqX0HVpqXbVO7k/edit?usp=sharing" target='_blank'>Click here</a> to go and do my Google Form survey! Feedback is reviewed every few weeks and it has a strong influence on the direction of the platform in terms of utility. At it's core - I'm building a platform for quantifying heroes from any work of fiction and creating a universal system of scale for them to compete on. The scale is decided by community vote and feedback on a constant basis.</li></ul>
		<li>Whats with the constant change of the frontend?</li>
		<ul><li>Its still under development - since this is primarily a personal project I don't care much about holding pages etc. I do have a dedicated FE dev doing the design and development of the UI because I'm terribley uncreative in that regard. But I'm a whizz with code and databases so that's my focus.</li></ul>
	</ul>	
	</div>
	<div class='main_inner'>	
		<?php 
		if(isset($currentPage)){
			
			$content = get_content($currentPage); 
			echo "<h1>" . $content['page_title'] . "</h1>";			
			echo "<p>" . $content['content'] . "</p>";	
			echo "<span class='post_timestamp'><small><strong>Updated </strong>" . time_elapsed_string($content['createdDate']) . "</small></span>";			
			$logger = new logger('Page visit','info',null);
			$logger->save_log();
		}
		?>
	</div>

</div>
<?php 
//include the footer
include_once './resources/footer.php'; 
?>


