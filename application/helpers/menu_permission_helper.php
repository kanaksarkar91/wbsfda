<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function getSidebarMenu($role_id = ''){
        $where = array('menu_master.parent_id'=> 0);
        if($role_id != 2){
        //    $where['user_permission.role_id'] = $role_id;
           $where['menu_master.is_active'] = 1;
		   $where['menu_master.item_type'] = 'M';
        }
        $result = getMenuObject($where, $role_id, false);
        // echo '<pre>'; print_r($result); die;
        $CI =& get_instance();
        // echo $CI->db->last_query(); die;
        $menu_array = array();
        if(!empty($result)){
            foreach($result as $index => $res){
                $temp = $res;
                $where_submenu = array('menu_master.parent_id'=> $res['menu_id']);
                if($role_id != 2){
                    $where_submenu['user_permission.role_id'] = $role_id;
                    $where_submenu['user_permission.is_active'] = 1;
                 }
                $temp['child_menu'] = getMenuObject($where_submenu, $role_id, true);
                if(count($temp['child_menu']) >0 ){
                    $menu_array[] = $temp;
                }
            }
        }
        return $menu_array;
    }

    function getMenuObject($where = array(), $role_id = '', $check_user_permission){
        $CI =& get_instance();
        // $CI->load->model('Mmenu');
        // $result = $CI->Mmenu->get_menu_by_condition(array('menu_master.parent_id'=> 0));
        $CI->db->select('menu_master.*');
        $CI->db->from('menu_master');
        if($role_id != 2 && $check_user_permission){
            $CI->db->join('user_permission', 'user_permission.menu_id = menu_master.menu_id', 'LEFT');
        }
        if(!empty($where)){
            $CI->db->where($where);
        }
        $CI->db->where('menu_master.is_active', 1);
		$CI->db->where('menu_master.item_type', 'M');
		$CI->db->order_by('menu_master.menu_rank', 'ASC');
        return $result=$CI->db->get()->result_array();
    }

    function check_user_permission($menu_id, $permission_for){
        $CI =& get_instance();
        if($CI->admin_session_data['role_id'] == ROLE_SUPERADMIN){
            return true;
        }else{
            $result = $CI->db->select('permission_id')
                                ->from('user_permission')
                                ->where('role_id', $CI->admin_session_data['role_id'])
                                ->where('menu_id', $menu_id)
                                ->where('is_active', 1)
                                ->where($permission_for, 1)
                                ->get()->num_rows();
            if($result >0 ){
                return true;
            }else{
                return false;
            }
        }
    }