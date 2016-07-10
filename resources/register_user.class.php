<?php
//simple class to register a user extends the userService helper
class register_user extends userService{
	
	protected $registerDate;
	
	public function __construct($username,$email = null,$password){
		$this->db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
	);	
		if(is_null($email)){
			$this->email = null;
		}else{
			$this->email = $email;
		}	
		$this->username = $this->db->escape($username);
		$this->password = $this->hash_pass($this->db->escape($password));
		$this->user_id = $this->generate_user_id();
	}
	
	public function add_new_user(){	
		$r = 0;
		$m = 'nothin happened';		
		if($this->check_existing_username() != FALSE){
			if($this->register_user() != FALSE){
				$r = 1;
				$m = 'User registered - register_user()';
				$user = $this->post_card($this->user_id);
				$env = array($user['email'],'noreply@whowouldwin.io','Who Would Win','WWW - Account Info!',"","Hi " . ucfirst($user['username']) . " <p>You can login and start creating heroes!</p><p>Remember, we're always looking for feedback on how we can improve the site! <a href='https://docs.google.com/forms/d/1zKansQ13GHGvO9Pq6NBppFmz41FtlGqX0HVpqXbVO7k/edit?usp=sharing' target='_blank' >Click this link</a> for a short survey on to let me know what you want to get from this platform!</p><p>Thanks,</br><br>Alex<br><strong>Admin</strong></p>");
				$mail = new mailTemplate();
				$mail->add_mail($env);
				$mail->send_mail();				
			}else{
				$m = 'User not registered - register_user()';
			}			
		}else{
			$m = 'Username exists in add_new_user() -> check_existing_username()';
		}
		//give the result of the registration		
		$this->return_result($r,$m);
		return $this->result;		
	}
	
	public function register_user(){
			$r = 0;			
			$this->registerDate = date('Y-m-d H:i:s');
			$data = array(
			"username" => $this->username,
			"email" => $this->email,
			"user_id" => $this->user_id,
			"dateRegistered" => $this->registerDate
			);	
						
			if($this->db->insert('users',$data)){
				$data = array(
				"hash" => $this->password,
				"user_id" => $this->user_id,
				"lastChanged" => date('Y-m-d H:i:s')
				);
				if($this->db->insert('user_access',$data)){
					if($this->set_command_level()){
						$r = 1;
					}					
				}				
			}
		
			return $r;
	}
	
}

?>