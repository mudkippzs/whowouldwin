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
		return $this->newHash;
	}

}