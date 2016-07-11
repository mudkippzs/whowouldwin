<?php 
//include the header 
include_once './resources/header.php'; 
?>

<div class='header_wrapper'>
	<div class='header_inner'>
		<div class='header_login_box'>
			<?php 
			if(is_user_logged_in()!= FALSE){
				echo "Welcome! <p><a href='/logout.php'>Logout</a></p>";
			}else{				
				include_once './resources/login_form.php';
			}
			?>	
			<div class='header_forgot_password'>
				<?php include_once './resources/forgot_password.php';  ?>
			</div>
		</div>
		<div class='header_registration'>
			<?php 
			//logged in? show message - else: show reg form
			if(is_user_logged_in()!= FALSE){
				//show MOTD announcement for members
				
			}else{
				include_once './resources/registration_form.php'; 
			}
			
			?>
				
		</div>
	</div>
</div>
<div class='main_wrapper'>
	<div class='main_inner'>
		<?php 
		if(isset($currentPage)){
			$content = get_content($currentPage); 
			echo "<h1>" . $content['page_title'] . "</h1>";
			echo "<p>" . $content['content'] . "</p>";
			
		}
		?>
	</div>

	<div class='main_tower'>
	
	
	</div>
</div>

<?php 
//include the footer
include_once './resources/footer.php'; 
?>


