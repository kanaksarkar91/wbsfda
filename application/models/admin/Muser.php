<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function get_user($where = array()){
        $this->db->select('ma.*,mr.role_name');
        $this->db->from('master_admin ma');
        $this->db->join('master_role mr', 'mr.role_id = ma.role_id', 'inner');
        $this->db->where('ma.status <>','2');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_user_nodal($p_user_id=null, $p_unit_id = null){
        $SQL='select ma.*,mr.role_name from master_admin ma inner join master_role mr on mr.role_id = ma.role_id inner join user_unit_list_view u on ma.user_id=u.user_id where ma.user_id<>'.$p_user_id.' and ma.status <>2 and u.zilla_id='.$p_unit_id.'';
		//echo $SQL;		
        $query=$this->db->query($SQL);
        return $query->result_array();
    }
	
    public function get_role(){
        $this->db->select('*');
        $this->db->from('master_role');
        $this->db->where('status','0');
        $this->db->where('role_id <>','2');
        $this->db->order_by('role_id','DESC');
        $query=$this->db->get();
        return $query->result_array();
		}

    public function get_state(){
        $this->db->select('*');
        $this->db->from('state');
        $this->db->order_by('state_id','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }
    
    public function submit_user($data){
        $this->db->insert('master_admin', $data);
        return $this->db->insert_id();
    }

    public function edit_user($user_id){
        $this->db->select('master_admin.*, lv.*');
        $this->db->from('master_admin');
        $this->db->join('property_unit_list_view lv', 'master_admin.property_unit_master_id = lv.id', 'LEFT OUTER');
		$this->db->where('user_id',$user_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function update_user($condition,$data){
        $result=$this->db->update('master_admin', $data, $condition);
        return $result;
    }

    public function delete_user($condition,$data){
        $result=$this->db->update('master_admin', $data, $condition);
        return $result;
    }

    public function get_district($state_id){
        $this->db->select('district_id,district_name');
        $this->db->from('district');
        $this->db->where('status','0');
        $this->db->where('state_id',$state_id);
		$this->db->order_by('district_id','ASC');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_user_property($where = array()){
        $sql = $this->db->where($where)->get('user_property_mapping');
        return $sql->result_array();
    }
    public function submit_user_property($data){
        $this->db->insert('user_property_mapping', $data);
        return $this->db->insert_id();
    }

    public function delete_user_property($where = array()){
        $this->db->where($where)->delete('user_property_mapping');
        return TRUE;
    }

    public function get_role_permission($role_id = '')
    {
        $role_permission = $this->db->where('role_id', $role_id)
                                    ->get('user_permission')->result();
        return $role_permission;
    }

    public function add_edit_permission($data_array = array(), $insert_count_on)
    {
        $role_permission = '';
        if(!empty($data_array['role_id'])){
            $role_permission = $this->db->where('role_id', $data_array['role_id'])
                                        ->where('menu_id', $data_array['menu_id'])
                                        ->get('user_permission')->row();
        }
        
        $data_array['created_by'] = $this->admin_session_data['user_id'];
        $data_array['created_ts'] = date('Y-m-d h:i:s');

        if(!empty($role_permission)){
            $data_array['created_by'] = $role_permission->created_by;
            $data_array['created_ts'] = $role_permission->created_ts;
            $data_array['updated_by'] = $this->admin_session_data['user_id'];
            $data_array['updated_ts'] = date('Y-m-d h:i:s');
            $this->db->where('permission_id', $role_permission->permission_id)->delete('user_permission');
        }
        if($insert_count_on){
            $this->db->insert('user_permission', $data_array);
            return $this->db->insert_id();
        }else{
            return true;
        }
    }
	
	public function get_pos($property_ids = 0){
        $sql="SELECT * FROM cost_center_master WHERE is_active = 1 AND property_id IN(".$property_ids.") ";
		//echo $sql;		
        $query=$this->db->query($sql);
        return $query->result_array();
    }

}