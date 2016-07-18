<?php
include_once './config.php'; 

/*
	LISTENERS
*/

//registration form
if(isset($_POST["www_new_user_register"])) {
	process_user_registration($_POST);
}	

//reset password form
if(isset($_POST["www_user_reset_password_form"])) {
	process_password_reset($_POST);
}	

//login form
if(isset($_POST["www_user_login_form"])) {
	process_user_login($_POST);
}	

//submit comment form
if(isset($_POST["www_new_comment_form"])) {
	process_new_comment($_POST);
}	

//submit post form
if(isset($_POST["www_new_post_form"])) {
	process_new_post($_POST);
}
	
//edit post form
if(isset($_POST["www_edit_post_form"])) {
	process_edit_post($_POST);
}	
	
//new hero form
if(isset($_POST["www_new_hero_form"])) {
	process_new_hero($_POST);
}	
	
//edit hero form
if(isset($_POST["www_edit_hero_form"])) {
	process_edit_hero($_POST);
}	
	
//ajax call for attributes from db
if(isset($_POST["get_attributes"])) {
	$attr = pull_attribute_definitions();
	$attributes = array();	
	$c = 0;
	foreach($attr as $k=>$v){
		$lab = $v['label'];
		$attributes[$c] = $lab;
		$c += 1;
	}
	
	echo stripslashes(json_encode($attributes));
}	

//ajax call for attributes from db
if(isset($_POST["get_damage_types"])) {
	$dT = pull_damage_types();
	$dmgTypes = array();	
	$c = 0;
	foreach($dT as $k=>$v){
		$lab = $v['label'];
		$dmgTypes["$c"] = $lab;
		$c += 1;
	}
	
	echo stripslashes(json_encode($dmgTypes,TRUE));
}	

/*
	Spell Book (functions to handle forms)
*/

//user registration spell
function process_user_registration($p){
	$reply = array('reply'=>0,'response'=>null);
		
	if(!empty($p)){	
	$registerUser = new register_user($p['register_username'],$p['register_email'],$p['register_password']);
	
	$res = $registerUser->add_new_user();
		if($res['reply'] != FALSE){			
			$reply['reply'] = 1;
			$reply['response'] = $res['response'];
		}else{			
			$reply['response'] = $res['response'];
		}
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

//user login spell
function process_user_login($p){
	$reply = array('reply'=>0,'response'=>'null');		
	if(!empty($p)){
		$loggedIn = new login_user($p['login_username'],$p['login_password']);
		if($loggedIn->do_login() != FALSE){
			$reply['reply'] = 1;
			$reply['response'] = "User: " . $p['login_username'] . " logged in";
		}
				
	}else{
		$reply['response'] = "User: " . $p['login_username'] . " couldnt log in";
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

//reset password spell
function process_password_reset($p){
	$reply = array('reply'=>0,'response'=>'null');
		
	if(!empty($p)){
		if(is_valid_email($p['Email'])){
		$email = $p['Email'];
		$passwordReset = new pass_reset($email);
		$results = $passwordReset->make_new_pass();
		if($results['reply'] != FALSE){
			$reply['reply'] = 1;
			$reply['response'] = 'Password reset! Please check your email!';
		}
		}else{
			$reply['response'] = 'Password reset! Please check your email!';
		}
				
	}else{
			$reply['response'] = 'No form info submited';
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

//process new comment spell
function process_new_comment($p){
	$reply = array('reply'=>0,'response'=>'null');
		
	if(!empty($p)){
				$reply['reply'] = 1;
				$reply['response'] = "Form submitted and processed without error";
	}else{
		$reply['response'] = "Form wasn't submitted correctly!";
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

//process new post spell
function process_new_post($p){
	$reply = array('reply'=>0,'response'=>'null');
	//check for drugsmuggling in $p here
	if(!empty($p)){
		$post = new post($p);
				if($post->save_post()!=FALSE){
				$reply['reply'] = 1;
				$reply['response'] = "Post submitted";
				}else{
					$reply['response'] = "Post wasn't submitted correctly!";
				}
	}else{
		$reply['response'] = "Post wasn't submitted correctly!";
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

//process edit post spell
function process_edit_post($p){
	$reply = array('reply'=>0,'response'=>'null');
	//check for drugsmuggling in $p here
	if(!empty($p)){
		$post = new post($p);
				if($post->update_post()!=FALSE){
				$reply['reply'] = 1;
				$reply['response'] = "Post edited";
				}else{
					$reply['response'] = "Post wasn't edited correctly!";
				}
	}else{
		$reply['response'] = "Post wasn't edited correctly!";
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

//process new hero spell
function process_new_hero($p){
	$reply = array('reply'=>0,'response'=>'null');
	$uid = $_SESSION['user_id'];	
	if(!empty($p)){
			$hero = new hero();
			if($hero->build_hero($p)){
				if($hero->save_hero($uid)){
					$reply['reply'] = 1;
					$reply['response'] = "Hero saved!";					
				}else{
					$reply['response'] = $hero->get_last_error();
				}
				
			}else{
				$reply['response'] = "Couldnt build hero";
			}
			
			
	}else{
		$reply['response'] = "Hero wasnt saved for some randomass reason!";
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

//process edit hero spell
function process_edit_hero($p){
	$reply = array('reply'=>0,'response'=>'null');
		
	if(!empty($p)){
				$reply['reply'] = 1;
				$reply['response'] = "Form submitted and processed without error";
	}else{
		$reply['response'] = "Form wasn't submitted correctly!";
	}
	header('Content-Type: application/json');
	echo json_encode($reply);
}

?>