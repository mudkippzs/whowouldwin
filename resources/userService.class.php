<?php

class userService{

	protected $username;
	protected $email;
	protected $password;
	protected $user_id;	
	protected $result;
	protected $db;
	
	public function __construct(){
	$this->db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
	);	
		$this->result = array('reply'=>0,'response' => null);
	}
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}

		return $this;
	}
	
	public function post_card($uid){
		if(empty($uid)){
			$uid = $this->user_id;
		}
		$this->db->where("user_id",$uid);
		$user = $this->db->getOne("users");
		
		return $user;
	}
	
	public function get_user_id($username){
	
		$this->db->where("username",$username);
		$user = $this->db->getOne("users");
		$user_id = $user['user_id'];
		
		return $user_id;
			
	}
	
	public function email_is_valid($e){
		if(is_null($e)){
			if(isset($this->email) && !empty($this->e)){
				$e =  $this->email;
			}else{
				$this->result['response'] = 'No email set';
			}
			
		}
		$r = 0;
		$this->db->where("email",$e);
		$user = $this->db->getOne("users");
		$email = $user['email'];		
		if($e === $email){
			$r =1;
		}		
		return $r;	
	}
	
	public function check_existing_username($user = null){
		if(is_null($user)){
			if(isset($this->username) && !empty($this->username)){
				$user =  $this->username;
			}else{
				$this->result['response'] = 'No username set';
			}
			
		}
		$r = 0;
		$this->db->where("username",$user);
		$user = $this->db->getOne("users");
		$username = $user['username'];		
		if($user === $username){
			$r =1;
		}		
		return $r;				
	}
		
	public function set_command_level(){
		$r = 0;
		if(isset($this->user_id)){
		$data = array(
			"user_id" => $this->user_id,
			"level" => "1",
			"banned" => "0"
			);
		if($this->db->insert('command_level',$data)){
					$r = 1;			
			}	
		}
		return $r;
	}
	
	public function generate_user_id($more_entropy=false) {
		$s = uniqid('', $more_entropy);
		if (!$more_entropy)
			return base_convert($s, 16, 36);
			
		$hex = substr($s, 0, 13);
		$dec = $s[13] . substr($s, 15); // skip the dot
		return base_convert($hex, 16, 36) . base_convert($dec, 10, 36);
}
	
	public function return_result($r,$m){
		$this->result['reply'] = $r;
		$this->result['response'] = $m;		
		
	}
	
	public function create_new_session($uid){
		$_SESSION['user_id'] = $uid;
		$this->update_last_login($uid);
		$this->update_last_activity($uid);
		$this->add_session($uid);
	}
	
	public function expire_user_session($uid){
		$r = 0;
		$data = Array (
		'expired' => 1
		);
		$this->db->where ('user_id', $uid);
		$this->db->where ('expired', 0);
		if ($this->db->update ('user_sessions', $data)){
			unset($_SESSION['user_id']);
			session_unset();
			session_destroy();
			$r = 1;
		}
		return $r;
	}
	
	public function add_session($uid){
		$r = 0;
		$data = Array (
		'expired' => 1
		);
		$this->db->where ('user_id', $uid);
		$this->db->where ('expired', 0);
		if ($this->db->update ('user_sessions', $data)){
		$data = array(
			"user_id" => $uid,
			"last_activity" => date('Y-m-d H:i:s'),
			"expired" => "0"			
			);	
		}else{
			$data = array(
			"user_id" => $uid,
			"last_activity" => date('Y-m-d H:i:s'),
			"expired" => "0"			
			);	
						
			if($this->db->insert('user_sessions',$data)){
				$r = 1;
			}
		}
		return $r;	
	}
	
	public function update_last_login($uid){
		$r = 0;
		$data = Array (
		'lastLogin' =>  date('Y-m-d H:i:s')
		);
		$this->db->where('user_id', $uid);
		if ($this->db->update('users', $data)){
			$r = 1;
		}
		return $r;
}
	
	public function update_last_activity($uid){
		$r = 0;
		$data = Array (
		'lastActive' =>  date('Y-m-d H:i:s')
		);
		$this->db->where ('user_id', $uid);
		if ($this->db->update ('users', $data)){
			$r = 1;
		}
		return $r;
	}

	public function hash_pass($pass){		
		$options = Array (
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		);		
		$pass = password_hash($pass,PASSWORD_BCRYPT,$options);
		return $pass;		
	}
	
	public function get_user_id_email($e = null){
		if(is_null($e)){
			$e = $this->email;
		}
		$email = $e;
		$this->db->where("email",$email);
		$user = $this->db->getOne("users");
		$user_id = $user['user_id'];
		return $user_id;
	}
	
	public function random_pass($uniq,$uid){
		$r = 0;
		$this->result = array('reply'=>0,'response' => null);
		$gib = $uniq . $uid;
		$hash = $this->hash_pass($gib);
		$pass = $uniq;
		$data = Array (
		'hash' =>  $hash,
		'lastChanged' => date('Y-m-d H:i:s')
		);
		$this->db->where ('user_id', $uid);
		if ($this->db->update ('user_access', $data)){
			$r = 1;			
			$m = $gib;
		}else{
			$m = 'Password not reset :(';
		}
		
		$this->return_result($r,$m);
		return $this->result;
	}

	public function verify_pass($user,$pass){
		$r = 0;
		$this->db->where("username",$user);
		$user = $this->db->getOne("users");
		$user_id = $user['user_id'];
		$this->db->where('user_id',$user_id);
		$hash = $this->db->getOne("user_access");
		if(password_verify($pass,$hash['hash'])){
			$r =1;
		}
		
		return $r;				
	}
	
}
	
	
?>
		
