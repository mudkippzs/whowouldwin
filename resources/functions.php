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

function is_admin($s){
	$r = 0;	
	$user = new userService();
	$user->user_id = $user->db->escape($s);
	$user_id = $user->user_id_is_valid($s);
	if($user_id!= FALSE){
		if($user->is_admin() != FALSE){
			$r = 1;	
		}		
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
		
	$cols = Array ("page_title", "stub");
	$stubs = $db->get ("content", null, $cols);
	if ($db->count > 0)
		echo "<ul>";
		foreach ($stubs as $s) {
			if(is_null($s['stub'])){
				$s['stub'] = 'HOME';
			}
			print_r ("<li><a href='/index.php?page=" . $s['stub'] . "'>" . strtoupper($s['page_title']) . "</a></li>");
		}
		if(is_user_logged_in()!= FALSE){
			if(is_admin($_SESSION['user_id'])){
				print_r ("<li><a href='/admin.php'>ADMIN</a></li>");
			}
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
		
	if(!empty($p)){	
		$cols = Array ("stub");
		$stubs = $db->get ("content", null, $cols);
		if ($db->count > 0){		
			foreach ($stubs as $s) { 
				if($p === $s['stub']){			
					$content = $s['stub'];
					break;
				}else{
					$content = 'home';
				}
			}		
		}
	}else{
		$content = 'home';
	}
	
	$page = $db->escape($content);
	$db->where ("stub", $page);
	$content = $db->getOne ("content");
	return $content;
	
}
?>