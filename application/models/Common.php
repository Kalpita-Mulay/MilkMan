<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Common extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('custom');
        $this->load->helper('language');
        $this->output->set_content_type('UTF-8');
        $this->load->language('english_lang', 'english');
    }

    public function get_product_detail() {
        $this->db->select('PM.*');
        $this->db->select('CONCAT("' . BASE_PATH . '",PI.path) as product_image');
        $this->db->join(TBL_PRODUCT_IMAGE . ' PI', 'PI.product_id=PM.id', 'LEFT');
        $query = $this->db->get(TBL_PRODUCT_MASTER . ' PM');
        //pre($this->db->last_query());
        if ($query->num_rows() > 0) {
            $result = $query->first_row('array');
            return $result;
        } else {
            return false;
        }
    }

    function weeks() {
        $arrWeek = array("0" => "Sunday", "1" => "Monday", "2" => "Tuesday", "3" => "Wednesday", "4" => "Thursday", "5" => "Friday", "6" => "Saturday");
        return $arrWeek;
    }

}
