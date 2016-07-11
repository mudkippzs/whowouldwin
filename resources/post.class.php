<?php

class post extends postService{
	
	protected $title;
	protected $stub;
	protected $template;
	protected $content;
	protected $page_id;
	protected $modifiedDate;
	protected $createdDate;	
	protected $db;
	protected $pid;


	public function __construct($pa){
		if(is_array($pa) && !empty($pa)){
		//get the post all setup
		$this->set_title($pa['new_post_title']);
		$this->set_stub($pa['new_post_stub']);
		$this->set_template($pa['new_post_location']);
		$this->set_content($pa['new_post_body']);
		$this->set_page_id($pa['new_post_index']);		
		}elseif(is_string($pa)){
			if(is_int($pa)){
				$this->pid = $pa; //should be an int at this stage :3 dont for get to check because I know you alex, i know you'll forget to check. Like you forget everything.
			}
		}
		$this->db =  new MysqliDb(
		DBHOST, //dbhost
		DBUSER, //dbuser
		DBPASS, //dbpass
		DBNAME //dbname
		);	
	}
	
	public function set_title($t){
		
		$this->title = 	$t;
	}
	
	public function set_stub($s){
		$this->stub = $s;	
	}
	
	public function set_template($t){
		$this->template = $t;	
	}
	
	public function set_content($c){
		$this->content = $c;
	}
	
	public function set_page_id($p){
		$this->page_id = $p;	
	}
	
	public function save_post(){
		$r = 0;			
		$this->createdDate = date('Y-m-d H:i:s');
		$data = array(
		"page_id" => $this->page_id,
		"page_title" => $this->title,
		"stub" => $this->stub,
		"template" => $this->template,
		"content" => $this->content,
		"createdDate" => $this->createdDate
		);	
					
		if($this->db->insert('content',$data)){
			$r = 1;
		}
		
		return $r;
	}
	
		 
	
}

?>