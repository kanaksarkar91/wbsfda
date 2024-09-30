<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Memployee extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_non_employee_list($request_data)
    {
        $sql = "SELECT ug.*,sf.sports_facilities_name,mp.profession_name
        FROM users_gymnasium ug
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = ug.sports_facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ml.fieldunit_id
        INNER JOIN master_profession mp ON mp.profession_id = ug.profession_id
        WHERE ug.is_employee = 0";
        if (isset($request_data['sports_facilities_id']) && !empty($request_data['sports_facilities_id'])) {

            $sql .= " AND ug.sports_facilities_id='" . $request_data['sports_facilities_id'] . "'";
        }
        if (isset($request_data['location_id']) && !empty($request_data['location_id'])) {

            $sql .= " AND ml.location_id='" . $request_data['location_id'] . "'";
        }
        if (isset($request_data['fieldunit_id']) && !empty($request_data['fieldunit_id'])) {

            $sql .= " AND mf.fieldunit_id='" . $request_data['fieldunit_id'] . "'";
        }
        if (isset($request_data['daterange']) && !empty($request_data['daterange'])) {

            $daterange = explode(' - ', $request_data['daterange']);
            $from_date = date('Y-m-d', strtotime(trim($daterange[0])));
            $to_date = date('Y-m-d', strtotime(trim($daterange[1])));


            $sql .= " AND DATE(ug.created_at) BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        }
        $sql .= " order by ug.users_gymnasium_id DESC";
        //INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ug.division_id 
        //INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        //INNER JOIN users u ON u.user_id = sfb.user_id
        //echo $sql;die;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_employee_list($request_data)
    {
        //echo '<pre>'; print_r($request_data);die;
        $sql = "SELECT ug.*,sf.sports_facilities_name,mf.fieldunit_name
        FROM users_gymnasium ug
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = ug.sports_facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ug.division_id
        WHERE ug.is_employee = 1";
        if (isset($request_data['sports_facilities_id']) && !empty($request_data['sports_facilities_id'])) {

            $sql .= " AND ug.sports_facilities_id='" . $request_data['sports_facilities_id'] . "'";
        }
        if (isset($request_data['location_id']) && !empty($request_data['location_id'])) {

            $sql .= " AND ml.location_id='" . $request_data['location_id'] . "'";
        }
        if (isset($request_data['fieldunit_id']) && !empty($request_data['fieldunit_id'])) {

            $sql .= " AND mf.fieldunit_id='" . $request_data['fieldunit_id'] . "'";
        }
        if (isset($request_data['daterange']) && !empty($request_data['daterange'])) {

            $daterange = explode(' - ', $request_data['daterange']);
            $from_date = date('Y-m-d', strtotime(trim($daterange[0])));
            $to_date = date('Y-m-d', strtotime(trim($daterange[1])));


            $sql .= " AND DATE(ug.created_at) BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        }
        $sql .= " order by ug.users_gymnasium_id DESC";

        //INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        //INNER JOIN users u ON u.user_id = sfb.user_id
        //echo $sql;die;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_member_list($request_data)
    {
        $sql = "SELECT gm.*,sf.sports_facilities_name,mf.fieldunit_name,ml.location_name,ug.name as sponsored_person,ug.employee_id,ug.phone
        FROM gymnasium_member gm
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = gm.facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ml.fieldunit_id
        INNER JOIN users_gymnasium ug ON ug.user_id = gm.user_id 
        WHERE gm.gymnasium_member_id > 0";

        if (isset($request_data['sports_facilities_id']) && !empty($request_data['sports_facilities_id'])) {

            $sql .= " AND sf.sports_facilities_id='" . $request_data['sports_facilities_id'] . "'";
        }
        if (isset($request_data['location_id']) && !empty($request_data['location_id'])) {

            $sql .= " AND ml.location_id='" . $request_data['location_id'] . "'";
        }
        if (isset($request_data['fieldunit_id']) && !empty($request_data['fieldunit_id'])) {

            $sql .= " AND mf.fieldunit_id='" . $request_data['fieldunit_id'] . "'";
        }
        if (isset($request_data['daterange']) && !empty($request_data['daterange'])) {

            $daterange = explode(' - ', $request_data['daterange']);
            $from_date = date('Y-m-d', strtotime(trim($daterange[0])));
            $to_date = date('Y-m-d', strtotime(trim($daterange[1])));


            $sql .= " AND DATE(gm.created_at) BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        }
        $sql .= " order by gm.gymnasium_member_id DESC"; 

        //INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        //INNER JOIN users u ON u.user_id = sfb.user_id
        //echo $sql;die; 
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function get_payment_list($month_start_date, $month_end_date, $request_data)
    {
        $sql = "SELECT gm.*,sf.sports_facilities_name,mf.fieldunit_name,ml.location_name,ug.name as sponsored_person,ug.employee_id,ug.phone,ifnull(gs.payment_status,1) as payment_status,ifnull(gs.created_at,'') as payment_time,ifnull(gs.subscription_amount,'') as subscription_amount,(SELECT CONCAT(ifnull(gr.monthly_subscription_fee,''),'|#|',ifnull(gr.gymnasium_rate_id,''),'|#|',ifnull(gr.registration_fee,'')) FROM gymnasium_rates gr INNER JOIN master_effective_year mey ON mey.effective_year_id = gr.effective_year_id  WHERE gr.sports_facilities_id = gm.facilities_id AND gr.user_type = 'Employees' AND mey.effective_start_date <= '" . $month_start_date . "' AND '" . $month_end_date . "' <= mey.effective_end_date AND mey.status = '0' ORDER BY mey.effective_year_id DESC LIMIT 1) as monthly_subscription_fee 
        FROM gymnasium_member gm
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = gm.facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ml.fieldunit_id
        INNER JOIN users_gymnasium ug ON ug.user_id = gm.user_id
        LEFT JOIN gymnasium_schedule gs ON gs.gymnasium_member_id = gm.gymnasium_member_id AND gs.payment_status = 0 AND DATE(gs.month_year) BETWEEN '" . $month_start_date . "' AND '" . $month_end_date . "'
        WHERE gm.status = 0";
        if (isset($request_data['sports_facilities_id']) && !empty($request_data['sports_facilities_id'])) {

            $sql .= " AND sf.sports_facilities_id='" . $request_data['sports_facilities_id'] . "'";
        }
        if (isset($request_data['location_id']) && !empty($request_data['location_id'])) {

            $sql .= " AND ml.location_id='" . $request_data['location_id'] . "'";
        }
        if (isset($request_data['fieldunit_id']) && !empty($request_data['fieldunit_id'])) {

            $sql .= " AND mf.fieldunit_id='" . $request_data['fieldunit_id'] . "'";
        }
        
        
        $sql .= " order by gm.gymnasium_member_id DESC";

        //INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        //INNER JOIN users u ON u.user_id = sfb.user_id
        // echo $sql;die;
        $query = $this->db->query($sql);
        return $query->result_array();
    }







    public function get_reservation_details($booking_id)
    {
        $sql = "SELECT sfb.*,
        ifnull(ma.full_name,'') as discount_given_by,date_format(discount_given_ts,'%d-%m-%Y %H:%i:%s') as discount_given_ts,
        ifnull(ma1.full_name,'') as approved_by,date_format(approved_ts,'%d-%m-%Y %H:%i:%s') as approved_ts,date_format(approval_valid_till,'%d-%m-%Y %H:%i:%s') as approval_valid_till,
        ifnull(ma2.full_name,'') as rejected_by,date_format(rejected_ts,'%d-%m-%Y %H:%i:%s') as rejected_ts,
        sf.sports_facilities_name,oc.category_name,ml.location_name,mf.fieldunit_name,u.mobile
        FROM sports_facilities_booking sfb
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = sfb.sports_facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ml.fieldunit_id
        INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        INNER JOIN users u ON u.user_id = sfb.user_id
        LEFT JOIN master_admin ma ON ma.user_id = sfb.discount_given_by
        LEFT JOIN master_admin ma1 ON ma1.user_id = sfb.approved_by
        LEFT JOIN master_admin ma2 ON ma2.user_id = sfb.rejected_by
        WHERE sfb.booking_id = '" . $booking_id . "'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_reservation_booking_details($request_data = array())
    {
        $sql = "SELECT sfb.*,
        ifnull(ma.full_name,'') as discount_given_by,date_format(discount_given_ts,'%d-%m-%Y %H:%i:%s') as discount_given_ts,
        ifnull(ma1.full_name,'') as approved_by,date_format(approved_ts,'%d-%m-%Y %H:%i:%s') as approved_ts,date_format(approval_valid_till,'%d-%m-%Y %H:%i:%s') as approval_valid_till,
        ifnull(ma2.full_name,'') as rejected_by,date_format(rejected_ts,'%d-%m-%Y %H:%i:%s') as rejected_ts,
        sf.sports_facilities_name,oc.category_name,ml.location_name,mf.fieldunit_name,u.mobile,sfbd.start_date,sfbd.rate
        FROM sports_facilities_booking sfb
        INNER JOIN sports_facilities sf ON sf.sports_facilities_id = sfb.sports_facilities_id
        INNER JOIN master_location ml ON ml.location_id = sf.location_id
        INNER JOIN master_fieldunit mf ON mf.fieldunit_id = ml.fieldunit_id
        INNER JOIN organization_category oc ON oc.organization_category_id = sfb.organization_type
        INNER JOIN users u ON u.user_id = sfb.user_id
        LEFT JOIN master_admin ma ON ma.user_id = sfb.discount_given_by
        LEFT JOIN master_admin ma1 ON ma1.user_id = sfb.approved_by
        LEFT JOIN master_admin ma2 ON ma2.user_id = sfb.rejected_by
        INNER JOIN sports_facilities_booking_details sfbd ON sfbd.booking_id=sfb.booking_id WHERE sf.sports_facilities_id > 0";
        if (!empty($request_data['fieldunit_id'])) {
            $sql .= " AND mf.fieldunit_id ='" . $request_data['fieldunit_id'] . "'";
        }
        if (!empty($request_data['location_id'])) {
            $sql .= " AND ml.location_id ='" . $request_data['location_id'] . "'";
        }
        if (!empty($request_data['sports_facilities_id'])) {
            $sql .= " AND sf.sports_facilities_id ='" . $request_data['sports_facilities_id'] . "'";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function get_sports_facilities_booking_details($booking_id)
    {
        $sql = "SELECT *
        FROM sports_facilities_booking_details
        WHERE booking_id = '" . $booking_id . "'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }



    public function submit_fieldunit($data)
    {
        $this->db->insert('master_fieldunit', $data);
        return $this->db->insert_id();
    }

    public function edit_fieldunit($fieldunit_id)
    {
        $this->db->select('fieldunit_id,fieldunit_name,status');
        $this->db->from('master_fieldunit');
        $this->db->where('fieldunit_id', $fieldunit_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_reservation($data, $condition)
    {
        $result = $this->db->update('sports_facilities_booking', $data, $condition);
        return $result;
    }

    public function delete_fieldunit($condition, $data)
    {
        $result = $this->db->update('master_fieldunit', $data, $condition);
        return $result;
    }
}
