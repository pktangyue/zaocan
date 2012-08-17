<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
    
    protected $admin_name;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->admin_name = $this->session->userdata('name');
    }
    
    protected function _is_logined() {
        return !!$this->admin_name;
    }
    
    protected function _check_login() {
        if (!$this->_is_logined() && uri_string() != 'admin/login') {
            redirect('admin/login?redirect_url=' . urlencode(current_url()));
        }
        return;
    }
}
