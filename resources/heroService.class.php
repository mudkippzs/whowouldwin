<?php


class heroService{
	
	protected $hero_id;
	protected $user_id;
	protected $attrib_array;
	protected $attribCost;
	protected $name;
	protected $cost;
	protected $votes;
	protected $createdDate;
	protected $lastEdited;
	protected $approved;	
	protected $deleted;	
	protected $db;
	
	public function __construct(){
		$this->db =  new MysqliDb(
			DBHOST, //dbhost
			DBUSER, //dbuser
			DBPASS, //dbpass
			DBNAME //dbname
		);		
		
	}
	
	public function build_hero($pa){		
		if(isset($pa['new_hero_name'])){			
			$this->name = $this->db->escape($pa['new_hero_name']);
			$this->attrib_array[0] = $this->db->escape($pa['attribute_range_1']);
			$this->attrib_array[1] = $this->db->escape($pa['attribute_range_2']);
			$this->attrib_array[2] = $this->db->escape($pa['attribute_range_3']);
			$this->attrib_array[3] = $this->db->escape($pa['attribute_range_4']);
			$this->attrib_array[4] = $this->db->escape($pa['attribute_range_5']);
			$this->attrib_array[5] = $this->db->escape($pa['attribute_range_6']);
			$this->attrib_array[6] = $this->db->escape($pa['attribute_range_7']);
			$this->attrib_array[7] = $this->db->escape($pa['attribute_range_8']);
			$this->attribCost = $this->calc_attrib_total_cost();
			$this->cost = $this->attribCost;			
			$this->votes = 0;			
		}
		
		return 1;
		
	}
	
	public function calc_attrib_single_cost($id,$v){
		$attributes = $this->db->get('attribute_definitions',8);
		$costM = $attributes[$id]['multiplier'];
		$cost = $v * $costM;
		return $cost;
	}
	
	public function calc_attrib_total_cost(){
		$count = 0;
		$cost = 0;
			foreach($this->attrib_array as $val){
				$cost += $this->calc_attrib_single_cost($count,$val);			
				$count += 1;
			}
		return $cost;
	}
	
	public function generate_hero_id(){
		return uniqid(rand()). uniqid();
	}
	
	public function save_hero($uid){
		$r = 0;
		$user = new userService();		
		if($user->user_id_is_valid($uid)){
			$this->user_id = $uid;
		}
		$this->createdDate = date('Y-m-d H:i:s');
		$this->hero_id = $this->generate_hero_id();
		$data = Array (
			'hero_id' => $this->hero_id,
			'user_id' => $this->user_id,
			'name' => $this->name,
			'cost' => $this->cost,
			'votes' => $this->votes,
			'createdDate' => $this->createdDate,			
			'is_approved' => 1,
			'deleted' => 0
			
		);
		$hero = $this->db->insert ('hero_base', $data);
		if($hero){
			foreach($this->attrib_array as $val){
			$data = Array (
				'hero_id' => $this->hero_id,
				'attribute_id' => $this->generate_hero_id(),
				'value' => $val
			);
			$attr = $this->db->insert ('hero_attributes', $data);
				if($attr){
					$r = 1;
				}else{
					$r = 0;
				}
			}
		}
		return $r;
	}
	
	public function get_last_error(){
		return $this->db->getLastError();
	}
	
	public function update_hero($pa){
		
	}
	
	public function get_hero_info($id){
		
	}
	
	public function get_user_heroes($uid){
		
	}
	
	
}


?>