<?php 
include_once './resources/header.php'; 

//test classes and functions in here :D 
//do nothing
?>
<?php 

$logger = new logger('user log test','warning',null);

$logger->print_log();
if($logger->save_log()!=FALSE){	
	echo 'Event logged';
}else{
	echo 'Event not logged';
}

?>

<?
include_once './resources/footer.php';



?>
