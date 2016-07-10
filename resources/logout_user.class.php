<?php
//simple class to logout a user extends the userService helper
class logout_user extends userService{
		
	protected $userData;
	
	public function __construct($s){
		$this->db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
	);	
		$this->userData = array(
		'user_id'=> $s
		);
			
	}
	
	public function logout(){
		$r = 0;
		$uid = $this->userData['user_id'];
		if($this->expire_user_session($uid) != FALSE){
			$r = 1;			
		}				
		return $r;
	}
	
	
	public function do_logout(){
		$r = 0;
		if(isset($_SESSION['user_id'])){			
			if($this->logout() != FALSE){
				$r = 1;
				$m = 'Logged out - do_logout()';
			}else{
				$m = 'Failed logout - do_logout()';
			}
			$m = 'Failed logout -  validate $_session';
		}		
		$this->return_result($r,$m);
		return $this->result;
	}


}



?>