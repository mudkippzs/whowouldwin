<?php 
include_once './resources/header.php'; 


//test classes and functions in here :D 

if(isset($_SESSION['user_id'])){
	$logout = new logout_user($_SESSION['user_id']);
	if($logout->do_logout()){
		header('Location:index.php');
		//echo 'User logged out';
	}
}else{
		header('Location:index.php');
		//echo 'User not logged in';
}



include_once './resources/footer.php';



?>