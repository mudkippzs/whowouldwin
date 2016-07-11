<?php
//quickly update timestamp for user activity
function update_user_activity(){
	if(isset($_SESSION['user_id'])){
		$user = new userService();
		$uid = $_SESSION['user_id'];
		$user->user_id = $uid;
		$user->update_last_activity($user->user_id);
		
	}
}

function is_user_logged_in(){
	if(isset($_SESSION['user_id'])){
		return TRUE;
	}else{
		return FALSE;
	}
	
}

function is_valid_email($e){
	$r = 0;	
	$user = new userService();

	$user->email = $user->db->escape($e);
	$email = $user->email_is_valid($e);
	if($email != FALSE){
		$r = 1;
	}		
	return $r;
}

function print_nav($currentPage){
	$db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
		);	
		
	$cols = Array ("page_id", "stub");
	$stubs = $db->get ("content", null, $cols);
	if ($db->count > 0)
		echo "<ul>";
		foreach ($stubs as $stub) { 
			print_r ("<li><a href=''>" . strtoupper($stub) . "</a></li>");
		}
		echo "</ul>";
	
	
}


function get_content($p){
	$db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
		);	
		
	$page = $db->escape($p);
	$content;
	switch($page){
		case 'about':
			$content = 'about';
		break;
		default:
			$content = 'home';
		break;
	}
	
		
	$page = $db->escape($currentPage);
	$db->where ("stub", $page);
	$content = $db->getOne ("content");
	return $content;
	
}
?>