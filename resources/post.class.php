<?php

class post extends postService{
		
	public function __construct($pa = null){
		$this->db =  new MysqliDb(
			DBHOST, //dbhost
			DBUSER, //dbuser
			DBPASS, //dbpass
			DBNAME //dbname
		);	
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
			}else{
				$list = $this->get_post($pa);				
			}
		}
	}
	
	public function get_post($stub = null){
		$r = 0;
		$posts;
		if(!isset($stub) && (empty($stub) || is_null($stub))){
			$cols = array("page_id","page_title","stub","template","content");
			$posts = $this->db->get("content", null, $cols);			
				
		}else{
			$cols = array("page_id","page_title","stub","template","content");
			$this->db->where("stub",$stub);
			$posts = $this->db->get("content", null, $cols);
			
		}		
		return $posts;
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
	
	public function update_post(){
		$r = 0;			
		$this->modifiedDate = date('Y-m-d H:i:s');
		$data = array(
		"page_id" => $this->page_id,
		"page_title" => $this->title,
		"stub" => $this->stub,
		"template" => $this->template,
		"content" => $this->content,
		"lastModified" => $this->modifiedDate
		);		
		$this->db->where ('page_id', $this->page_id);			
		if($this->db->update('content',$data)){
			$r = 1;
		}
		
		return $r;
	}
	
		 
	
}

?>