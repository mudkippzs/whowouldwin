<?php

class postService{
	
	protected $page_data;
	protected $db;
	
	public function __construct(){
		$this->db =  new MysqliDb(
			DBHOST, //dbhost
			DBUSER, //dbuser
			DBPASS, //dbpass
			DBNAME //dbname
		);	
		
	}
	
	public function validate_post_info($key,$data){
		$r = 0;
		$cols = Array ($key);
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