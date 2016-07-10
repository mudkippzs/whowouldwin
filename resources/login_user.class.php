<?php
//simple class to login a user extends the userService helper
class login_user extends userService{
	
	protected $session_id;
	protected $userData;
	
	public function __construct($username,$password){
		$this->db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
	);	
		$this->userData = array(
		'username'=>$username,
		'password'=>$password,
		'user_id'=> $this->get_user_id($username)
		);
			
	}
	
	public function validate_cred(){
		$user = $this->userData['username'];
		$pass = $this->userData['password'];
		$r = 0;
		if($this->verify_pass($user,$pass)){
			$r = 1;
		}
		
		return $r;
	}
	
	public function login(){
		$uid = $this->userData['user_id'];
		$this->create_new_session($uid);				
	}
	
	public function do_login(){
		$r = 0;
		$m = 'nothin';
		if($this->validate_cred()){			
			if($this->login() != FALSE){
				$r = 1;
				$m = 'Logged in - do_login()';
			}else{
				$m = 'Failed login - do_login()';
			}
			$m = 'Failed login - validate_cred()';
		}		
		$this->return_result($r,$m);
		return $this->result;
	}


}

?>