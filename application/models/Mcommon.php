<?php
 class Mcommon extends CI_Model {
    function __construct(){
        parent::__construct();
    }
    public function insert($table,$data){
        $this->db->insert($table,$data);
		//echo $this->db->last_query();
        return $this->db->insert_id();
    }
    public function batch_insert($table,$data){
        $this->db->insert_batch($table,$data); 
        return 1; 
    }
	public function getNumRow($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        return $query->num_rows();
    }
    public function getDetails($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();die;
        return $query->result_array(); 
    }
	public function getDetailsOrder($table,$condition,$order_by='',$order='ASC'){
        $this->db->where($condition);
		$this->db->order_by($order_by,$order);
        $query=$this->db->get($table);
        //echo $this->db->last_query();die;
        return $query->result_array(); 
    }
    public function getRow($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        return $query->row_array();
    }  
    public function checkUser($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        return $query->row_array(); 
    } 
    public function update($table,$condition,$data){
        $this->db->where($condition);
        $this->db->update($table,$data);
        //echo $this->db->last_query();die;
        return 1;
    }
    public function delete($table,$condition){ 
        $this->db->where($condition);
        $this->db->delete($table);
        return 1;
    }

    public function getFullDetails($table){
        $query=$this->db->get($table);
        return $query->result_array();
    }

     public function getDetailsFiltered($table,$params){
         $this->db->from($table);
        if(!empty($params['date_min']))
            {
                $this->db->where('date_of_creation >', $params['date_min']);
            }
            if(!empty($params['date_max']))
            {
                $stop_date = date('Y-m-d', strtotime($params['date_max'].' +1 day'));

                $this->db->where('date_of_creation <=', $stop_date);
            }
        $query=$this->db->get();
        return $query->result_array(); 
    }
	public function recursive_change_key($arr, $set) {
        if (is_array($arr) && is_array($set)) {
    		$newArr = array();
    		foreach ($arr as $k => $v) {
    		    $key = array_key_exists( $k, $set) ? $set[$k] : $k;
    		    $newArr[$key] = is_array($v) ? $this->recursive_change_key($v, $set) : $v;
    		}
    		return $newArr;
    	}
    	return $arr;    
    }
	public function get_user_service($where = array())
	{
		$this->db->select('safari_service_header_id');
		if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get('user_safari_service_mapping');
        $result = $query->result_array();
		if(!empty($result)){
			$ids = array_column($result, 'safari_service_header_id');
			return implode(',', $ids);
		}
	}
}


