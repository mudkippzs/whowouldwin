<?php



class logger{
	
	protected $log_id;
	protected $event;
	protected $ip;
	protected $note;
	protected $formData;
	protected $userAgent;
	protected $page_id;
	protected $user_id;
	protected $dateCreated;	
	protected $unread;	
	protected $db;
	protected $response;
	
	public function __construct($note = null,$event = 'info',$formData = null){
		$this->db =  new MysqliDb(
			DBHOST, //dbhost
			DBUSER, //dbuser
			DBPASS, //dbpass
			DBNAME //dbname
		);
		
		$this->response = array('reply'=>0,'message'=>null);
		
		$this->make_new_log($note,$event,$formData);
		
	}
	
	public function make_new_log($note,$event,$formData){		
		//check the note is clean
		if(!empty($note)){
			$this->note = $this->handle_note($note);
			//check the event is a valid enum value and set it
			if($this->set_event($event)!=FALSE){
				if(isset($_SESSION['user_id'])){
					if($this->validate_user_id($_SESSION['user_id'])){
						$this->user_id = $this->validate_user_id($_SESSION['user_id']);									
					}else{
						$this->user_id = '0';
						$this->response['message'] = 'User ID isnt valid or is unset for this log';
						echo $this->response['message'];
					}					
				}
				if(isset($formData) && !is_null($formData)){
						$this->formData = serialize_form_data($formData);
					}
				$this->ip = $this->get_ip();
				$this->userAgent = $this->get_user_agent();
				$this->log_id = $this->generate_log_id();
				$this->dateCreated = date('Y-m-d H:i:s');
				$this->page_id = $this->validate_page_id();
				$this->unread = 1;
				
			}else{
				$this->response['message'] = 'Event isnt a valid enum type';
				echo $this->response['message'];
			}
		}else{
			$this->response['message'] = 'Note is not set';
			echo $this->response['message'];
		}
	}
	
	public function save_log(){
		$r = 0;
		$data = Array (
			'log_id' => $this->log_id,
			'event' => $this->event,
			'ip' => $this->ip,
			'note' => $this->note,
			'formData' => $this->formData,
			'userAgent' => $this->userAgent,
			'page_id' => $this->page_id,
			'user_id' => $this->user_id,
			'dateCreated' => $this->dateCreated,
			'unread' => $this->unread
			
		);

		$newLog = $this->db->insert('site_activity',$data);
		if($newLog){
			$r=1;
		}else{
			//echo $this->db->getLastError();
		}
		return $r;
	}
	
	public function print_log(){
		if(isset($this->log_id)){
			$logid = substr($this->log_id, -7);
			echo <<<LOG
				<div class='log_output'>
					<ul>
						<li><strong>Log ID</strong> $logid <strong>Page</strong> $this->page_id </li>
						<li>created: $this->dateCreated</li>
						<li>user id: $this->user_id</li>
						<li>event: $this->event</li>
						<li>userAgent: $this->userAgent</li>
						<li>IP: $this->ip</li>
						<li>note: $this->note</li>
						<li>form data: $this->formData</li>
					</ul>
				</div>
LOG;
		}
	}
	
	public function get_log($options){
		
	}
	
	public function handle_note($n){
		$note = $this->db->escape($n);
		return $note;
	}
	
	public function get_ip(){
		$ip = $_SERVER['REMOTE_ADDR'];
		if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
			$ip = '0.0.0.0';
		}
		
		return $ip;
	}
	
	public function get_user_agent(){
		return $_SERVER['HTTP_USER_AGENT'];
	}
	
	public function set_event($e){
		$r = 0;
		$events = $this->get_event_list();
		$event = $this->db->escape($e);
		if(in_array($event,$events)){
			$this->event = $event;
			$r = 1;
		}	
		return $r;
	}
	
	public function get_event_list(){
		$dbname = DBNAME;
		$events = array();
		$sql = "SELECT SUBSTRING(COLUMN_TYPE,5)
				FROM information_schema.COLUMNS
				WHERE TABLE_SCHEMA='$dbname' 
				AND TABLE_NAME='site_activity'
				AND COLUMN_NAME='event'";
		$results = $this->db->rawQueryOne($sql);
		foreach($results as $e){
			array_push($events,$e);
		}
		$events =  explode(",",str_replace(array( '(', ')' ,"'", ' ' ), '', $events[0]));		
		return $events;
	
	}
	
	public function serialize_form_data($fD){
		
		foreach($fd as $formData=>$data){
			$data = $this->db->escape($data);
			
		}
		
		return json_encode($fD);
		
	}
	
	public function validate_user_id($uid){
		$user = new userService();
		$uid = $this->db->escape($uid);
		$user->user_id = $uid;
		if($user->user_id_is_valid()){
			$r = 1;
			$this->response['message'] = 'The user ID is valid';			
		}
		if($r = 1){
			$r = $uid;
		}
		return $r;		
	}
	
	public function validate_page_id(){
			if(isset($_GET['page']) && !empty($_GET['page'])){
				$pageid = $this->db->escape($_GET['page']);
				$post = new postService();
				$pageid = $post->validate_post_info('stub',$pageid);
			}else{
				$pageid = 'home';
			}
			
			return $pageid;
			
	}
	
	public function generate_log_id(){
		return uniqid(rand()). uniqid();
	}
	
	
	


}


?>