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
		$pages = $db->get ("content", null, $cols);
		if($db->count > 0){
				if(in_array($data,$pages)){
					$pageid = $data;
				}else{
					$pageid = 'not valid page';
				}
		}
		
		return $pageid;
	}
		
			
	
	

}


?>