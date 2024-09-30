<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbudget extends CI_Model {

    public function __construct() {
        parent::__construct();

    }


	public function property_list($curUser){  

        $sql = "SELECT property_id, property_name FROM property_master WHERE is_active = '1' AND is_deleted = '0' AND created_by = '".$curUser."' AND (p_type = 'H' OR p_type = 'G')";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }


	/*public function particular_list(){  

        $sql = "SELECT particular_id, particular_title FROM budget_particular_master WHERE is_active = '1'";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }*/


	public function budget_particular_list($propertyId){  

        $sql = "SELECT b.* FROM property_master a LEFT JOIN budget_particular_master b ON a.p_type = b.type WHERE a.property_id = '".$propertyId."'";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		return $rows;

    }


	public function check_budget_details($property_id, $billing_month, $financial_year){  

        $sql = "SELECT * FROM budget_header WHERE property_id = '".$property_id."' AND financial_year = '".$financial_year."' AND expense_month = '".$billing_month."'";         
        $query = $this->db->query($sql);
        //$rows = $query->result_array();
		$num = $query->num_rows();

		if($num > 0){
			return true;
		} else {
			return false;
		}

    }


	public function budget_header_insert($budgetHeaderarray){
        $this->db->insert('budget_header', $budgetHeaderarray);
        return $this->db->insert_id();
    }


	public function budget_details_insert($budgetDetailsarray) {

        /*$sql = $this->db->insert_batch('budget_details', $budgetDetailsarray);

        if($sql){

			return true;

        } else {
			return false;
		}*/

		$this->db->insert('budget_details', $budgetDetailsarray);
        return $this->db->insert_id();

    }


	public function budget_details_file_insert($dataFiles){
        $this->db->insert('budget_details_file', $dataFiles);
        return $this->db->insert_id();
    }


	public function estimation_list($financial_year, $billing_month){  

        $sql = "SELECT a.*, b.property_name, c.full_name FROM budget_header a LEFT JOIN property_master b ON a.property_id = b.property_id LEFT JOIN master_admin c ON a.estimated_by = c.user_id WHERE a.financial_year = '".$financial_year."' AND a.expense_month = '".$billing_month."' AND a.approved_expence_total IS NULL";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		//echo "<pre>"; print_r($rows); die;

		return $rows;

    }


	public function approved_list($financial_year, $billing_month){  

        $sql = "SELECT a.*, b.property_name, c.full_name, d.full_name as approval_person FROM budget_header a LEFT JOIN property_master b ON a.property_id = b.property_id LEFT JOIN master_admin c ON a.estimated_by = c.user_id LEFT JOIN master_admin d ON a.approved_by = d.user_id WHERE a.financial_year = '".$financial_year."' AND a.expense_month = '".$billing_month."' AND a.approved_expence_total IS NOT NULL";         
        $query = $this->db->query($sql);
        $rows = $query->result_array();

		//echo "<pre>"; print_r($rows); die;

		return $rows;

    }


	public function estimation_details($hid){  

		$result = array();
		$res = array();

        $sql = "SELECT a.*, b.property_name FROM budget_header a LEFT JOIN property_master b ON a.property_id = b.property_id WHERE a.budget_header_id = '".$hid."'";         
        $query = $this->db->query($sql);
        $row = $query->row_array();
		
		$dsql = "SELECT a.*, b.particular_title FROM budget_details a LEFT JOIN budget_particular_master b ON a.particulars_id = b.particular_id WHERE a.budget_header_id = '".$row['budget_header_id']."'";
		$dquery = $this->db->query($dsql);
		$drows = $dquery->result_array();			

		$j = 0;
		foreach($drows as $drow){

			$fsql = "SELECT * FROM budget_details_file WHERE budget_details_id = '".$drow['budget_details_id']."'";
			$fquery = $this->db->query($fsql);
			$frows = $fquery->result_array();

			//$result = $row;
			$res[$j] = $drow;
			$res[$j]['supportingfiles'] = $frows;

			$j++;

		}

		$result = $row;
		$result['budget_details'] = $res;

		//echo "<pre>"; print_r($result); die;
		
		
		return $result;

    }


	public function budget_header_update($budgetHeaderarray,$conditionHeader){
        $result=$this->db->update('budget_header', $budgetHeaderarray, $conditionHeader);
        return $result;
    }


	public function budget_details_update($budgetDetailsarray) {

        $sql = $this->db->update_batch('budget_details', $budgetDetailsarray, 'budget_details_id');

        if($sql){

			return true;

        } else {
			return false;
		}

    }

}
