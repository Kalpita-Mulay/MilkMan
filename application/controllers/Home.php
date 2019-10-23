<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller {

    private $_enable_debug = false;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('language');
        $this->load->helper('custom');
        $this->load->library('session');
        $this->load->library('encryption');
        $this->load->helper('form');
        $this->load->model('common');
        $this->output->set_content_type('UTF-8');
    }

    public function index() {
        $data['data'] = $this->common->get_product_detail();
        $data['weeks'] = $this->common->weeks();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/includes/footer');
    }
}
