<?php

class pass_reset extends userService{

	protected $newHash;
	public function __construct($email){
		$this->db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
		);				
		$this->user_id = $this->get_user_id_email($email);		
	
	}
	
	public function make_new_pass(){		
		$this->newHash = $this->random_pass($this->generate_user_id(),$this->user_id);		
		$hash = $this->result['m'];		
		$user = $this->post_card($this->user_id);
		$env = array($user['email'],'noreply@whowouldwin.io','Who Would Win','Password has been reset!',"$hash","Hi " . ucfirst($user['username']) . " <p>Your new password is: {{MESSAGE_BODY}} </p><p>Please update it soon to something you wont forget!</p><p>Thanks,</br><br>Alex<br><strong>Admin</strong></p>");
		$mail = new mailTemplate();
		$mail->add_mail($env);
		$mail->send_mail();
		return $this->newHash['r'];
	}

}