<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
    protected $admin_name;
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    protected function _is_logined() {
        if (!$this->admin_name) {
            $this->admin_name = $this->session->userdata('name');
        }
        return !!$this->admin_name;
    }
    protected function _go_to_login() {
        if (!$this->_is_logined() && uri_string() != 'admin/login') {
            redirect('admin/login?redirect_url=' . urlencode(current_url()));
        }
    }
}
