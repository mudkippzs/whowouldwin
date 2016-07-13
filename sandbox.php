<?php 
include_once './resources/header.php'; 

//test classes and functions in here :D 
//do nothing
?>
Users registered: 
<?php 

$userService = new userService();
echo $userService->get_users_registered("-30 days"); 
?>

<?
include_once './resources/footer.php';



?>
