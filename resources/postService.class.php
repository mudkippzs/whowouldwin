<?php

class postService{
		
	protected $db;
	protected $title;
	protected $stub;
	protected $template;
	protected $content;
	protected $page_id;
	protected $modifiedDate;
	protected $createdDate;		
	protected $pid;
	
	public function __construct(){
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
	
	public function validate_post_info($key,$data){
		$r = 0;
		$cols = Array ("$key");
		$pages = $this->db->get ("content", null, $cols);
		if($this->db->count > 0){
				foreach($pages as $k=>$d){
					if(in_array($data,$d)){						
						$pageid = $data;						
					}else{						
						$pageid = 'home';	
					}
				}
				
		}
		
		return $pageid;
	}
		
			
	
	

}


?>