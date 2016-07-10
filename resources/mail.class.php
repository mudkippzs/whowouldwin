<?php

class mailTemplate{
	
	protected $headers;
	protected $to;
	protected $from;
	protected $subject;
	protected $fromName;
	protected $messageContent;
	protected $template;
	protected $message;
	protected $mailBox;
	protected $postbag;
	

	public function __construct(){
		$this->mailBox = array();		
				
	}
	
	public function add_mail($envelope){
			if(empty($envelope)){
				 $envelope = array($to = 'me@alexsheridan.me',$from = 'noreply@whowouldwin.io',$fromName = 'Who Would Win',$subject = 'News and Updates!',$messageContent = 'Empty',$template = 'THIS IS A {{MESSAGE_BODY}} TEMPLATE');
			}			
			$count = count($this->mailBox) + 1;			
			$this->mailBox[$count]  = $envelope;
	}
	
	public function build_mail_array(){		
		$this->postbag = array();
		foreach($this->mailBox as $env){
			$to = $env[0];
			$from = $env[1];
			$fromName = $env[2];
			$subject = $env[3];
			$msg = $env[4];
			$tpl = $env[5];
			$this->format_message($msg,$tpl);
			$this->assemble_headers($from,$fromName);			
			$message = $this->message;			
			$headers = $this->headers;
			$cmd = "mail('$to','$subject','$message','$headers');";
			array_push($this->postbag,$cmd);			
		}
		
		echo "\nAll letters in postbag!\n";		
		
	}
	
	public function batch_info(){
		$sizeofbatch = count($this->mailBox);		
		echo '< ' . $this->to . " >\n";		
		echo "\n<-- Message Start -->\n";
		var_dump($this->mailBox);
		echo "<-- Message End -->\n";
		echo "\nTotal Count: " . $sizeofbatch . "\n";
		
	}
	
	public function send_mail(){		
		$this->batch_info();
		$this->build_mail_array();
		foreach($this->postbag as $index=>$letter){
			eval($letter);
		}
		
	}
	
	public function set_subject($s){
		$this->subject = $s;
	}
	
	public function set_to($t){
		if(!empty($t)){
			$this->to = $t;
		}
	}
	
	public function set_from_label($l){
		$this->fromName = $l;
	}
	
	public function set_from_address($f){
		$this->from = $f;		
	}
	
	public function assemble_headers($f,$l){
		$this->headers = 'MIME-Version: 1.0' . "\r\n";
		$this->headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$this->headers .= 'From: ' . $f . ' <' . $l . ">\r\n";
		
	}
	
	public function format_message($m,$t){
		$t = str_replace("{{MESSAGE_BODY}}",$m,$t);		
		$this->message = $t;
	}
	
	public function is_valid_email($e){
		$r = 0;
		
		if (!filter_var($e, FILTER_VALIDATE_EMAIL) === false) {
		  $r = 1;
		}
		
		return $r;		
	}

}
$env1 = array('mudkippzs@gmail.com','noreply@whowouldwin.io','Alex','Test Mail','THIS IS A MESASGE',"This is a template {{MESSAGE_BODY}} GOOD BYE ALEX");
$env2 = array('alex@gmail.com','noreply@whowouldwin.io','Alex','2Test Mail','2THIS IS A MESASGE',"This is a template {{MESSAGE_BODY}} GOOD BYE2 ALEX");
$mail = new mailTemplate();
$mail->add_mail($env1);
$mail->add_mail($env2);
$mail->send_mail();



?>
